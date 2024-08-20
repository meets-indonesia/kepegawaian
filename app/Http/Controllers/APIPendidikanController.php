<?php

namespace App\Http\Controllers;

use App\Http\Resources\PendidikanResource;
use App\Models\Pendidikan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class APIPendidikanController extends Controller
{
    /**
     * Get all records from Pendidikan
     *
     * @return \Illuminate\Http\JsonResponse
     * @var \App\Models\Pendidikan
     */
    public function getall()
    {
        try {
            // Get all records from Pendidikan
            $pendidikan = Pendidikan::all();

            // Check if the result is empty
            if ($pendidikan->isEmpty()) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'No records found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' =>  PendidikanResource::collection($pendidikan)
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
     * Get a record from Pendidikan
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        try {
            // Retrieve a record from Pendidikan
            $pendidikan = Pendidikan::find($id);

            // Check if the result is empty
            if ($pendidikan === null) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => new PendidikanResource($pendidikan)
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
     * Create a new record in Pendidikan
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'name' => 'required|string',
            ]);

            // Create a new record in Pendidikan
            $pendidikan = new Pendidikan();
            $pendidikan->nama = $request->nama;
            $pendidikan->tingkat = $request->tingkat;
            $pendidikan->save();

            // Return the data with a 201 Created status
            return response()->json([
                'message' => 'Success Create Record',
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
     * Update a record in Pendidikan
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            // Validate the request data
            $request->validate([
                'name' => 'required|string',
            ]);

            // Find the record in Pendidikan
            $pendidikan = Pendidikan::find($id);

            // Check if the result is empty
            if ($pendidikan === null) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Update the record in Pendidikan
            $pendidikan->nama = $request->nama;
            $pendidikan->tingkat = $request->tingkat;
            $pendidikan->save();

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success Update Record',
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
     * Delete a record from Pendidikan
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try {
            // Retrieve a record from Pendidikan
            $pendidikan = Pendidikan::find($id);

            // Check if the result is empty
            if ($pendidikan === null) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Delete the record from Pendidikan
            $pendidikan->delete();

            // Return the data with a 200 OK status
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
