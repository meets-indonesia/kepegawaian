<?php

namespace App\Http\Controllers;

use App\Http\Resources\RiwayatMutasiResource;
use App\Models\RiwayatMutasi;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class APIRiwayatMutasiController extends Controller
{
    /**
     * Get all records from RiwayatMutasi.
     * 
     * @return \Illuminate\Http\JsonResponse
     * @var \App\Models\RiwayatMutasi
     */

    public function getall()
    {
        try {
            // Retrieve all records from RiwayatMutasi
            $riwayatMutasi = RiwayatMutasi::with(['pegawai'])->get();

            // Check if the result is empty
            if ($riwayatMutasi->isEmpty()) {
                return response()->json([
                    'message' => 'No records found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => RiwayatMutasiResource::collection($riwayatMutasi)
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
     * Get a record from RiwayatMutasi.
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        try {
            // Retrieve a record from RiwayatMutasi
            $riwayatMutasi = RiwayatMutasi::with(['pegawai'])->find($id);

            // Check if the result is empty
            if ($riwayatMutasi === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => new RiwayatMutasiResource($riwayatMutasi)
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
     * Create a new record in RiwayatMutasi.
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'pegawai_id' => 'required|exists:pegawai,id',
                'no_sk' => 'required|string',
                'jenis' => 'required|string',
                'tanggal_sk' => 'required|date',
            ]);

            // Create a new record in RiwayatMutasi
            $riwayatMutasi = RiwayatMutasi::create($request->all());

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
     * Update a record in RiwayatMutasi.
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
                'no_sk' => 'required|string',
                'jenis' => 'required|string',
                'tanggal_sk' => 'required|date',
            ]);

            // Find the record in RiwayatMutasi
            $riwayatMutasi = RiwayatMutasi::find($id);

            // Check if the record is not found
            if ($riwayatMutasi === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Update the record in RiwayatMutasi
            $riwayatMutasi->update($request->all());

            // Return a 200 OK response
            return response()->json([
                'message' => 'Success update record'
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
     * Delete a record from RiwayatMutasi.
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try {
            // Find the record in RiwayatMutasi
            $riwayatMutasi = RiwayatMutasi::find($id);

            // Check if the record is not found
            if ($riwayatMutasi === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Delete the record from RiwayatMutasi
            $riwayatMutasi->delete();

            // Return a 200 OK response
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
