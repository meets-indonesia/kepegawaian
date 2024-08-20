<?php

namespace App\Http\Controllers;

use App\Http\Resources\JenisPegawaiResource;
use App\Models\JenisPegawai;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class APIJenisPegawaiController extends Controller
{
    /**
     * Get all records from JenisPegawai
     * 
     * @return \Illuminate\Http\JsonResponse
     * @var \App\Models\JenisPegawai
     */

    public function getall()
    {
        try {
            // Retrieve all records from JenisPegawai
            $jenisPegawai = JenisPegawai::all();

            // Check if the result is empty
            if ($jenisPegawai->isEmpty()) {
                return response()->json([
                    'message' => 'No records found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => JenisPegawaiResource::collection($jenisPegawai)
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
     * Get a record from JenisPegawai
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        try {
            // Retrieve a record from JenisPegawai
            $jenisPegawai = JenisPegawai::find($id);

            // Check if the result is empty
            if ($jenisPegawai === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => new JenisPegawaiResource($jenisPegawai)
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
     * Create a new record in JenisPegawai
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

            // Create a new record
            $jenisPegawai = JenisPegawai::create($request->all());

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
     * Update a record in JenisPegawai
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

            // Retrieve a record from JabatanStruktural
            $jenisPegawai = JenisPegawai::find($id);

            // Check if the result is empty
            if ($jenisPegawai === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Update the record
            $jenisPegawai->update($request->all());

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
     * Delete a record from JenisPegawai
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try {
            // Find the record in JenisPegawai
            $jenisPegawai = JenisPegawai::find($id);

            // Check if the record is empty
            if ($jenisPegawai === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Delete the record
            $jenisPegawai->delete();

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
