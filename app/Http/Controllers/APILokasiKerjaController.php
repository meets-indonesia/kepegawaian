<?php

namespace App\Http\Controllers;

use App\Http\Resources\LokasiKerjaResource;
use App\Models\LokasiKerja;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class APILokasiKerjaController extends Controller
{
    /**
     * Get all records from LokasiKerja
     * 
     * @return \Illuminate\Http\JsonResponse
     * @var \App\Models\LokasiKerja
     */
    public function getall()
    {
        try {
            // Retrieve all records from LokasiKerja
            $lokasiKerja = LokasiKerja::all();

            // Check if the result is empty
            if ($lokasiKerja->isEmpty()) {
                return response()->json([
                    'message' => 'No records found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => LokasiKerjaResource::collection($lokasiKerja)
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
     * Get a record from LokasiKerja
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        try {
            // Retrieve a record from LokasiKerja
            $lokasiKerja = LokasiKerja::find($id);

            // Check if the result is empty
            if ($lokasiKerja === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => new LokasiKerjaResource($lokasiKerja)
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
     * Create a record in LokasiKerja
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'name' => 'required|string',
            ]);

            // Create a new record in LokasiKerja
            $lokasiKerja = LokasiKerja::create($request->all());

            // Return the data with a 201 Created status
            return response()->json([
                'message' => 'Success',
                'data' => new LokasiKerjaResource($lokasiKerja)
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
     * Update a record in LokasiKerja
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
                'name' => 'required|string',
            ]);

            // Retrieve a record from LokasiKerja
            $lokasiKerja = LokasiKerja::find($id);

            // Check if the result is empty
            if ($lokasiKerja === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Update the record
            $lokasiKerja->update($request->all());

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => new LokasiKerjaResource($lokasiKerja)
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
     * Delete a record from LokasiKerja
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try {
            // Retrieve a record from LokasiKerja
            $lokasiKerja = LokasiKerja::find($id);

            // Check if the result is empty
            if ($lokasiKerja === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Delete the record
            $lokasiKerja->delete();

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success'
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
