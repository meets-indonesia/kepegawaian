<?php

namespace App\Http\Controllers;

use App\Http\Resources\RiwayatPangkatResource;
use App\Models\RiwayatPangkat;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class APIRiwayatPangkatController extends Controller
{


    /**
     * Get all records from RiwayatPangkat.
     * 
     * @return \Illuminate\Http\JsonResponse
     * @var \App\Models\RiwayatPangkat
     */
    public function getall()
    {
        try {
            // Retrieve all records from RiwayatPangkat
            $riwayatPangkat = RiwayatPangkat::with(['pegawai', 'jabatanStruktural'])->get();

            // Check if the result is empty
            if ($riwayatPangkat->isEmpty()) {
                return response()->json([
                    'message' => 'No records found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => RiwayatPangkatResource::collection($riwayatPangkat)
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
     * Get a record from RiwayatPangkat.
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        try {
            // Retrieve a record from RiwayatPangkat
            $riwayatPangkat = RiwayatPangkat::with(['pegawai', 'jabatanStruktural'])->find($id);

            // Check if the result is empty
            if ($riwayatPangkat === null) {
                return response()->json([
                    'message' => 'No record found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => new RiwayatPangkatResource($riwayatPangkat)
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
     * Create a new record in RiwayatPangkat.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'pegawai_id' => 'required|integer',
                'jabatan_struktural_id' => 'required|integer',
                'tahun_mulai' => 'required|date',
                'tahun_selesai' => 'required|date',
            ]);

            // Create a new record in RiwayatPangkat
            $riwayatPangkat = RiwayatPangkat::create($request->all());

            // Return the data with a 201 Created status
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
     * Update a record in RiwayatPangkat.
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            // Validate the request
            $request->validate([
                'pegawai_id' => 'required|integer',
                'jabatan_struktural_id' => 'required|integer',
                'tahun_mulai' => 'required|date',
                'tahun_selesai' => 'required|date',
            ]);

            // Find the record in RiwayatPangkat
            $riwayatPangkat = RiwayatPangkat::find($id);

            // Check if the record is empty
            if ($riwayatPangkat === null) {
                return response()->json([
                    'message' => 'No record found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Update the record in RiwayatPangkat
            $riwayatPangkat->update($request->all());

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
     * Delete a record from RiwayatPangkat.
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try {
            // Find the record in RiwayatPangkat
            $riwayatPangkat = RiwayatPangkat::find($id);

            // Check if the record is empty
            if ($riwayatPangkat === null) {
                return response()->json([
                    'message' => 'No record found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Delete the record in RiwayatPangkat
            $riwayatPangkat->delete();

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
