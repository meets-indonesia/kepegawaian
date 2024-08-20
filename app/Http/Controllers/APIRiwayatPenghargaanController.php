<?php

namespace App\Http\Controllers;

use App\Http\Resources\RiwayatPenghargaanResource;
use App\Models\RiwayatPenghargaan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class APIRiwayatPenghargaanController extends Controller
{
    /**
     * Get all records from RiwayatPenghargaan.
     * 
     * @return \Illuminate\Http\JsonResponse
     * @var \App\Models\RiwayatPenghargaan
     */

    public function getall()
    {
        try {
            // Retrieve all records from RiwayatPenghargaan
            $riwayatPenghargaan = RiwayatPenghargaan::with(['pegawai'])->get();

            // Check if the result is empty
            if ($riwayatPenghargaan->isEmpty()) {
                return response()->json([
                    'message' => 'No records found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => RiwayatPenghargaanResource::collection($riwayatPenghargaan)
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            // Return a 500 Internal Server Error response
            return response()->json([
                'message' => 'Internal Server Error',
                'error' => $th->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get a record from RiwayatPenghargaan.
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        try {
            // Retrieve a record from RiwayatPenghargaan
            $riwayatPenghargaan = RiwayatPenghargaan::with(['pegawai'])->find($id);

            // Check if the result is empty
            if ($riwayatPenghargaan === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => new RiwayatPenghargaanResource($riwayatPenghargaan)
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            // Return a 500 Internal Server Error response
            return response()->json([
                'message' => 'Internal Server Error',
                'error' => $th->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a record to RiwayatPenghargaan.
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'pegawai_id' => 'required|exists:pegawai,id',
                'nama' => 'required|string',
                'tanggal' => 'required|date',
                'pemberi' => 'required|string',
            ]);

            // Create a new record
            $riwayatPenghargaan = RiwayatPenghargaan::create($request->all());

            // Return a 201 Created response
            return response()->json([
                'message' => 'Success create new record',
            ], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            // Return a 500 Internal Server Error response
            return response()->json([
                'message' => 'Internal Server Error',
                'error' => $th->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update a record in RiwayatPenghargaan.
     * 
     * @param \Illuminate\Http\Request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            // Validate the request
            $request->validate([
                'pegawai_id' => 'required|exists:pegawai,id',
                'nama' => 'required|string',
                'tanggal' => 'required|date',
                'pemberi' => 'required|string',
            ]);

            // Retrieve a record from RiwayatPenghargaan
            $riwayatPenghargaan = RiwayatPenghargaan::find($id);

            // Check if the result is empty
            if ($riwayatPenghargaan === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Update the record
            $riwayatPenghargaan->update($request->all());

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success update record',
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            // Return a 500 Internal Server Error response
            return response()->json([
                'message' => 'Internal Server Error',
                'error' => $th->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Delete a record from RiwayatPenghargaan.
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try {
            // Retrieve a record from RiwayatPenghargaan
            $riwayatPenghargaan = RiwayatPenghargaan::find($id);

            // Check if the result is empty
            if ($riwayatPenghargaan === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Delete the record
            $riwayatPenghargaan->delete();

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success delete record'
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            // Return a 500 Internal Server Error response
            return response()->json([
                'message' => 'Internal Server Error',
                'error' => $th->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
