<?php

namespace App\Http\Controllers;

use App\Http\Resources\JabatanFungsionalResource;
use App\Models\JabatanFungsional;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class APIJabatanFungsionalController extends Controller
{
    /**
     * Get all records from JabatanFungsional
     * 
     * @return \Illuminate\Http\JsonResponse
     * @var \App\Models\JabatanFungsional
     */

    public function getall()
    {
        try {
            // Retrieve all records from JabatanFungsional
            $jabatanFungsional = JabatanFungsional::all();

            // Check if the result is empty
            if ($jabatanFungsional->isEmpty()) {
                return response()->json([
                    'message' => 'No records found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => JabatanFungsionalResource::collection($jabatanFungsional)
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
     * Get a record from JabatanFungsional
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        try {
            // Retrieve a record from JabatanFungsional
            $jabatanFungsional = JabatanFungsional::find($id);

            // Check if the result is empty
            if ($jabatanFungsional === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => new JabatanFungsionalResource($jabatanFungsional)
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
     * Create a new record in JabatanFungsional
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
                'masa' => 'required|numeric',
            ]);

            // Create a new record in JabatanFungsional
            $jabatanFungsional = JabatanFungsional::create($request->all());

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
     * Update a record in JabatanFungsional
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
                'masa' => 'required|numeric',
            ]);

            // Find the record in JabatanFungsional
            $jabatanFungsional = JabatanFungsional::find($id);

            // Check if the record is empty
            if ($jabatanFungsional === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Update the record
            $jabatanFungsional->update($request->all());

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
     * Delete a record from JabatanFungsional
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try {
            // Find a record in JabatanFungsional
            $jabatanFungsional = JabatanFungsional::find($id);

            // Check if the result is empty
            if ($jabatanFungsional === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Delete the record
            $jabatanFungsional->delete();

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
