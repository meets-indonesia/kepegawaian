<?php

namespace App\Http\Controllers;

use App\Http\Resources\FakultasResource;
use App\Models\Fakultas;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class APIFakultasController extends Controller
{
    /**
     * Get all records from Fakultas
     * 
     * @return \Illuminate\Http\JsonResponse
     * @var \App\Models\Fakultas
     */

    public function getall()
    {
        try {
            $fakultas = Fakultas::all();
            // Check if the result is empty
            if ($fakultas->isEmpty()) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'No records found'
                ], Response::HTTP_NOT_FOUND);
            }
            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => FakultasResource::collection($fakultas)
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
     * Get a record from Fakultas
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        try {
            // Retrieve a record from Fakultas
            $fakultas = Fakultas::find($id);

            // Check if the result is empty
            if ($fakultas === null) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }
            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => new FakultasResource($fakultas)
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
     * Create a new record in Fakultas
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        try {
            // validate the incoming request
            $request->validate([
                'name' => 'required|string'
            ]);

            // Create a new record in Fakultas
            $fakultas = Fakultas::create($request->all());

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
     * Update a record in Fakultas
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
                'name' => 'required|string'
            ]);

            // Retrieve a record from Fakultas
            $fakultas = Fakultas::find($id);

            // Check if the result is empty
            if ($fakultas === null) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Update the record in Fakultas
            $fakultas->update($request->all());

            // Return the data with a 200 OK status
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
     * Delete a record from Fakultas
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try {
            // Find a record in Fakultas
            $fakultas = Fakultas::find($id);

            // Check if the result is empty
            if ($fakultas === null) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Delete the record from Fakultas
            $fakultas->delete();

            // Return a 200 OK response
            return response()->json([
                'message' => 'Success Delete Record',
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
