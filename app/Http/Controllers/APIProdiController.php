<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProdiResource;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class APIProdiController extends Controller
{
    /**
     * Get all records from Prodi
     * 
     * @return \Illuminate\Http\JsonResponse
     * @var \App\Models\Prodi
     */
    public function getall()
    {
        try {
            // Retrieve all records from Prodi
            $prodi = Prodi::all();

            // Check if the result is empty
            if ($prodi->isEmpty()) {
                return response()->json([
                    'message' => 'No records found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => ProdiResource::collection($prodi)
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
     * Get a record from Prodi
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        try {
            // Retrieve a record from Prodi
            $prodi = Prodi::find($id);

            // Check if the result is empty
            if ($prodi === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => new ProdiResource($prodi)
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
     * Create a new record in Prodi
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'name' => 'required|string',
                'jurusan_id' => 'required|exists:jurusan,id'
            ]);

            // Create a new record in Prodi
            $prodi = Prodi::create($request->all());

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
     * Update a record in Prodi
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            // Validate the incoming request
            $request->validate([
                'name' => 'required|string',
                'jurusan_id' => 'required|exists:jurusan,id'
            ]);

            // Retrieve a record from Prodi
            $prodi = Prodi::find($id);

            // Check if the result is empty
            if ($prodi === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Update the record
            $prodi->update($request->all());

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
     * Delete a record from Prodi
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try {
            // Retrieve a record from Prodi
            $prodi = Prodi::find($id);

            // Check if the result is empty
            if ($prodi === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Delete the record
            $prodi->delete();

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
