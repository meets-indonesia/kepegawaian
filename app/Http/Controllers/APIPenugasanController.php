<?php

namespace App\Http\Controllers;

use App\Http\Resources\PenugasanResource;
use App\Models\Penugasan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class APIPenugasanController extends Controller
{
    /**
     * Get all records from Penugasan
     * 
     * @return \Illuminate\Http\JsonResponse
     * @var \App\Models\Penugasan
     */

    public function getall()
    {
        try {
            // Retrieve all records from Penugasan
            $penugasan = Penugasan::with('pegawai')->get();

            // Check if the result is empty
            if ($penugasan->isEmpty()) {
                return response()->json([
                    'message' => 'No records found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => PenugasanResource::collection($penugasan)
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
     * Get a record from Penugasan
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        try {
            // Retrieve a record from Penugasan
            $penugasan = Penugasan::with('pegawai')->find($id);


            // Check if the result is empty
            if ($penugasan->isEmpty()) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => PenugasanResource::collection($penugasan)
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
     * Create a new record in Penugasan
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
                'negara' => 'required|string',
                'tahun' => 'required|year',
                'lama' => 'required|string',
                'alasan' => 'required|string',
            ]);
            // Create a new record in Penugasan
            $penugasan = Penugasan::create($request->all());

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
     * Update a record in Penugasan
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
                'negara' => 'required|string',
                'tahun' => 'required|year',
                'lama' => 'required|string',
                'alasan' => 'required|string',
            ]);

            // Find the record in Penugasan
            $penugasan = Penugasan::find($id);

            // Check if the record is empty
            if (empty($penugasan)) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Update the record in Penugasan
            $penugasan->update($request->all());

            // Return a 200 OK status
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
     * Delete a record from Penugasan
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try {
            // Find a record in Penugasan
            $penugasan = Penugasan::find($id);

            // Check if the result is empty
            if (empty($penugasan)) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Delete the record
            $penugasan->delete();

            // Return a 200 OK response
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
