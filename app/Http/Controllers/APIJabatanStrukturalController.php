<?php

namespace App\Http\Controllers;

use App\Http\Resources\JabatanStrukturalResource;
use App\Models\JabatanStruktural;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class APIJabatanStrukturalController extends Controller
{
    /**
     * Get all records from JabatanStruktural
     * 
     * @return \Illuminate\Http\JsonResponse
     * @var \App\Models\JabatanStruktural
     */
    public function getall()
    {
        try {
            // Retrieve all records from JabatanStruktural
            $jabatanStruktural = JabatanStruktural::with(['eselon'])->get();

            // Check if the result is empty
            if ($jabatanStruktural->isEmpty()) {
                return response()->json([
                    'message' => 'No records found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => JabatanStrukturalResource::collection($jabatanStruktural)
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
     * Get a record from JabatanStruktural
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        try {
            // Retrieve a record from JabatanStruktural
            $jabatanStruktural = JabatanStruktural::with(['eselon'])->find($id);

            // Check if the result is empty
            if ($jabatanStruktural === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => new JabatanStrukturalResource($jabatanStruktural)
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
     * Create a new record in JabatanStruktural
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
                'masa' => 'required|numeric',
                'eselon_id' => 'required|exists:eselon,id',
            ]);

            // Create a new record in JabatanStruktural
            $jabatanStruktural = JabatanStruktural::create($request->all());

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
     * Update a record in JabatanStruktural
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
                'eselon_id' => 'required|exists:eselon,id',
            ]);

            // Retrieve a record from JabatanStruktural
            $jabatanStruktural = JabatanStruktural::find($id);

            // Check if the result is empty
            if ($jabatanStruktural === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Update the record
            $jabatanStruktural->update($request->all());

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
     * Delete a record from JabatanStruktural
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try {
            // Find a record in JabatanStruktural
            $jabatanStruktural = JabatanStruktural::find($id);

            // Check if the result is empty
            if ($jabatanStruktural === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Delete the record
            $jabatanStruktural->delete();

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
