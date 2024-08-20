<?php

namespace App\Http\Controllers;

use App\Http\Resources\RiwayatHukumanDisiplinResource;
use App\Models\RiwayatHukumanDisiplin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class APIRiwayatHukumanDisiplinController extends Controller
{
    /**
     * Get all records from RiwayatHukumanDisiplin
     * 
     * @return \Illuminate\Http\JsonResponse
     * @var \App\Models\RiwayatHukumanDisiplin
     */
    public function getall()
    {
        try {
            // Retrieve all records from RiwayatHukumanDisiplin
            $riwayatHukumanDisiplin = RiwayatHukumanDisiplin::all();

            // Check if the result is empty
            if ($riwayatHukumanDisiplin->isEmpty()) {
                return response()->json([
                    'message' => 'No records found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => RiwayatHukumanDisiplinResource::collection($riwayatHukumanDisiplin)
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
     * Get a record from RiwayatHukumanDisiplin
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        try {
            // Retrieve a record from RiwayatHukumanDisiplin
            $riwayatHukumanDisiplin = RiwayatHukumanDisiplin::find($id);

            // Check if the result is empty
            if ($riwayatHukumanDisiplin === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => new RiwayatHukumanDisiplinResource($riwayatHukumanDisiplin)
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
     * Create a record in RiwayatHukumanDisiplin
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'pegawai_id' => 'required|exists:pegawai,id',
                'hukuman_disiplin_id' => 'required|exists:hukuman_disiplin,id',
                'nomor_sk' => 'required|string',
                'tanggal_sk' => 'required|date',
                'tmt_hd' => 'required|date',
                'masa_tahun' => 'required|string',
                'masa_bulan' => 'required|string',
                'akhir_hukuman' => 'required|date',
                'golongan_ruang' => 'required|string',
            ]);

            // Create a new record in RiwayatHukumanDisiplin
            $riwayatHukumanDisiplin = RiwayatHukumanDisiplin::create($request->all());

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
     * Update a record in RiwayatHukumanDisiplin
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
                'hukuman_disiplin_id' => 'required|exists:hukuman_disiplin,id',
                'nomor_sk' => 'required|string',
                'tanggal_sk' => 'required|date',
                'tmt_hd' => 'required|date',
                'masa_tahun' => 'required|string',
                'masa_bulan' => 'required|string',
                'akhir_hukuman' => 'required|date',
                'golongan_ruang' => 'required|string',
            ]);

            // Find the record and update it
            $riwayatHukumanDisiplin = RiwayatHukumanDisiplin::find($id);
            $riwayatHukumanDisiplin->update($request->all());

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
     * Delete a record from RiwayatHukumanDisiplin
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try {
            // Find the record in RiwayatHukumanDisiplin
            $riwayatHukumanDisiplin = RiwayatHukumanDisiplin::find($id);

            // Check if the record is empty
            if ($riwayatHukumanDisiplin === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Delete the record from RiwayatHukumanDisiplin
            $riwayatHukumanDisiplin->delete();

            // Return a 200 OK status
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
