<?php

namespace App\Http\Controllers;

use App\Http\Resources\KelompokPegawaiResource;
use App\Models\KelompokPegawai;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class APIKelompokPegawaiController extends Controller
{
    /**
     *  Get all records from KelompokPegawai
     * 
     *  @return \Illuminate\Http\JsonResponse
     *  @var \App\Models\KelompokPegawai
     */
    public function getall()
    {
        try {
            // Retrieve all records from KelompokPegawai
            $kelompokPegawai = KelompokPegawai::all();

            // Check if the result is empty
            if ($kelompokPegawai->isEmpty()) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'No records found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => KelompokPegawaiResource::collection($kelompokPegawai)
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
     * Get a record from KelompokPegawai
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        try {
            // Retrieve a record from KelompokPegawai
            $kelompokPegawai = KelompokPegawai::find($id);

            // Check if the result is empty
            if ($kelompokPegawai === null) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => new KelompokPegawaiResource($kelompokPegawai)
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
     * Create a new record in KelompokPegawai
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'name' => 'required|string'
            ]);

            // Create a new record in KelompokPegawai
            $kelompokPegawai = KelompokPegawai::create($request->all());

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
     * Update a record in KelompokPegawai
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
                'name' => 'required|string'
            ]);

            // Retrieve a record from KelompokPegawai
            $kelompokPegawai = KelompokPegawai::find($id);

            // Check if the result is empty
            if ($kelompokPegawai === null) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Update the record in KelompokPegawai
            $kelompokPegawai->update([
                'name' => $request->name
            ]);

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
     * Delete a record from KelompokPegawai
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try {
            // Retrieve a record from KelompokPegawai
            $kelompokPegawai = KelompokPegawai::find($id);

            // Check if the result is empty
            if ($kelompokPegawai === null) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Delete the record from KelompokPegawai
            $kelompokPegawai->delete();

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
