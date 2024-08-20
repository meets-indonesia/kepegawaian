<?php

namespace App\Http\Controllers;

use App\Http\Resources\GajiPokokResource;
use App\Models\GajiPokok;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class APIGajiPokokController extends Controller
{
    /**
     * Get all records from GajiPokok
     * 
     * @return \Illuminate\Http\JsonResponse
     * @var \App\Models\GajiPokok
     */
    public function getall()
    {
        try {
            // Retrieve all records from GajiPokok
            $gajiPokok = GajiPokok::all();

            // Check if the result is empty
            if ($gajiPokok->isEmpty()) {

                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'No records found'
                ], Response::HTTP_NOT_FOUND);
            }
            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => GajiPokokResource::collection($gajiPokok)
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
     * Get a record from GajiPokok
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        try {
            // Retrieve a record from GajiPokok
            $gajiPokok = GajiPokok::find($id);

            // Check if the result is empty
            if ($gajiPokok === null) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => new GajiPokokResource($gajiPokok)
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
     * Create a new record in GajiPokok
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'golongan_id' => 'required|exists:golongan,id',
                'masa_kerja' => 'required||string',
                'gaji_pokok' => 'required|numeric'
            ]);

            // Create a new record in GajiPokok
            $gajiPokok = GajiPokok::create($request->all());

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
     * Update a record in GajiPokok
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
                'golongan_id' => 'required|exists:golongan,id',
                'masa_kerja' => 'required||string',
                'gaji_pokok' => 'required|numeric'
            ]);

            // Retrieve a record from GajiPokok
            $gajiPokok = GajiPokok::find($id);

            // Check if the result is empty
            if ($gajiPokok === null) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Update the record in GajiPokok
            $gajiPokok->update($request->all());

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
     * Delete a record from GajiPokok
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try {
            // Find a record in GajiPokok
            $gajiPokok = GajiPokok::find($id);

            // Check if the result is empty
            if ($gajiPokok === null) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Delete the record from GajiPokok
            $gajiPokok->delete();

            // Return a 200 OK response
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
