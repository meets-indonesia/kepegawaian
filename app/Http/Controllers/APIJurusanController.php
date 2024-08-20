<?php

namespace App\Http\Controllers;

use App\Http\Resources\JurusanResource;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class APIJurusanController extends Controller
{
    /**
     * Get all records from Jurusan
     * 
     * @return \Illuminate\Http\JsonResponse
     * @var \App\Models\Jurusan
     */

    public function getall()
    {
        try {
            // Retrieve all records from Jurusan
            $jurusan = Jurusan::all();

            // Check if the result is empty
            if ($jurusan->isEmpty()) {
                return response()->json([
                    'message' => 'No records found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => JurusanResource::collection($jurusan)
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
     * Get a record from Jurusan
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        try {
            // Retrieve a record from Jurusan
            $jurusan = Jurusan::find($id);

            // Check if the result is empty
            if ($jurusan === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => new JurusanResource($jurusan)
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
     * Create a new record in Jurusan
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
                'fakultas_id' => 'required|exists:fakultas,id'
            ]);

            // Create a new record in Jurusan
            $jurusan = Jurusan::create($request->all());

            // Return the data with a 201 Created status
            return response()->json([
                'message' => 'Success create a new record',
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
     * Update a record in Jurusan
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
                'name' => 'required|string',
                'fakultas_id' => 'required|exists:fakultas,id'
            ]);

            // Retrieve a record from Jurusan
            $jurusan = Jurusan::find($id);

            // Check if the result is empty
            if ($jurusan === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Update the record in Jurusan
            $jurusan->update($request->all());

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => new JurusanResource($jurusan)
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
     * Delete a record from Jurusan
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try {
            // Retrieve a record from Jurusan
            $jurusan = Jurusan::find($id);

            // Check if the result is empty
            if ($jurusan === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Delete the record from Jurusan
            $jurusan->delete();

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
