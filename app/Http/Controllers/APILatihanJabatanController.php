<?php

namespace App\Http\Controllers;

use App\Http\Resources\LatihanJabatanResource;
use App\Models\LatihanJabatan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class APILatihanJabatanController extends Controller
{
    /**
     * Get all records from Jabatan
     * 
     * @return \Illuminate\Http\JsonResponse
     * @var \App\Models\LatihanJabatan
     */

    public function getall()
    {
        try {
            // Retrieve all records from Jabatan
            $jabatan = LatihanJabatan::with('pegawai')->get();

            // Check if the result is empty
            if ($jabatan->isEmpty()) {
                return response()->json([
                    'message' => 'No records found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => LatihanJabatanResource::collection($jabatan)
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
     * Get a record from Jabatan
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        try {
            // Retrieve a record from Jabatan
            $jabatan = LatihanJabatan::with('pegawai')->find($id);

            // Check if the result is empty
            if ($jabatan === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => new LatihanJabatanResource($jabatan)
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
     * Create a new record in Jabatan
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'pegawai_id' => 'required|exists:pegawai,id',
                'nama' => 'required|string',
                'tahun' => 'required|year',
                'jam' => 'required|string',
                'sertifikat' => 'required|string',
            ]);

            // Create a new record in Jabatan
            $jabatan = LatihanJabatan::create($request->all());

            // Return the data with a 201 Created status
            return response()->json([
                'message' => 'Success create record',
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
     * Update a record in Jabatan
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
                'pegawai_id' => 'required|exists:pegawai,id',
                'nama' => 'required|string',
                'tahun' => 'required|year',
                'jam' => 'required|string',
                'sertifikat' => 'required|string',
            ]);

            // Retrieve a record from Jabatan
            $jabatan = LatihanJabatan::find($id);

            // Check if the result is empty
            if ($jabatan === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Update the record
            $jabatan->update($request->all());

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
     * Delete a record from Jabatan
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try {
            // Retrieve a record from Jabatan
            $jabatan = LatihanJabatan::find($id);

            // Check if the result is empty
            if ($jabatan === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Delete the record
            $jabatan->delete();

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
