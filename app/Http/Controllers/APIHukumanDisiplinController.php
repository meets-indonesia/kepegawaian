<?php

namespace App\Http\Controllers;

use App\Http\Resources\HukumanDisiplinResource;
use App\Models\HukumanDisiplin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class APIHukumanDisiplinController extends Controller
{
    /**
     * Get all records from HukumanDisiplin
     * 
     * @return \Illuminate\Http\JsonResponse
     * @var \App\Models\HukumanDisiplin
     */

    public function getall()
    {
        try {
            // Retrieve all records from HukumanDisiplin
            $hukumanDisiplin = HukumanDisiplin::all();

            // Check if the result is empty
            if ($hukumanDisiplin->isEmpty()) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'No records found'
                ], Response::HTTP_NOT_FOUND);
            }
            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => HukumanDisiplinResource::collection($hukumanDisiplin)
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
     * Get a record from HukumanDisiplin
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        try {
            // Retrieve a record from HukumanDisiplin
            $hukumanDisiplin = HukumanDisiplin::find($id);

            // Check if the result is empty
            if ($hukumanDisiplin === null) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }
            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => new HukumanDisiplinResource($hukumanDisiplin)
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
     * Create a new record in HukumanDisiplin
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
            ]);

            // Create a new record in HukumanDisiplin
            $hukumanDisiplin = HukumanDisiplin::create($request->all());

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
     * Update a record in HukumanDisiplin
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

            // Retrieve a record from HukumanDisiplin
            $hukumanDisiplin = HukumanDisiplin::find($id);

            // Check if the result is empty
            if ($hukumanDisiplin === null) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Update the record in HukumanDisiplin
            $hukumanDisiplin->update($request->all());

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
     * Delete a record from HukumanDisiplin
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try {
            // Find a record in HukumanDisiplin
            $hukumanDisiplin = HukumanDisiplin::find($id);

            // Check if the result is empty
            if ($hukumanDisiplin === null) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Delete the record from HukumanDisiplin
            $hukumanDisiplin->delete();

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success delete record',
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
