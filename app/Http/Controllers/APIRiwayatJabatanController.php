<?php

namespace App\Http\Controllers;

use App\Http\Resources\RiwayatJabatanResource;
use App\Models\RiwayatJabatan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class APIRiwayatJabatanController extends Controller
{
    /**
     * Get all records from RiwayatJabatan
     * 
     * @return \Illuminate\Http\JsonResponse
     * @var \App\Models\RiwayatJabatan
     */

    public function getall()
    {
        try {
            // Retrieve all records from RiwayatJabatan
            $riwayatJabatan = RiwayatJabatan::all();

            // Check if the result is empty
            if ($riwayatJabatan->isEmpty()) {
                return response()->json([
                    'message' => 'No records found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => RiwayatJabatanResource::collection($riwayatJabatan)
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
     * Get a record from RiwayatJabatan
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        try {
            // Retrieve a record from RiwayatJabatan
            $riwayatJabatan = RiwayatJabatan::find($id);

            // Check if the result is empty
            if ($riwayatJabatan === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => new RiwayatJabatanResource($riwayatJabatan)
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
     * Create a new record in RiwayatJabatan
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
                'unit_kerja_id' => 'required|exists:unit_kerja,id',
                'eselon_id' => 'required|exists:eselon,id',
                'jabatan_struktural_id' => 'required|exists:jabatan_struktural,id',
                'jabatan_fungsional_id' => 'required|exists:jabatan_fungsional,id',
                'satuan_kerja' => 'required|string',
                'jenis' => 'required|string',
                'tmt_js' => 'required|date',
                'akhir_eselon' => 'required|date',
                'tmt_jf' => 'required|date',
                'nomor_sk' => 'required|string',
                'tanggal_sk' => 'required|date',
            ]);

            // Create a new record in RiwayatJabatan
            $riwayatJabatan = RiwayatJabatan::create($request->all());

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
     * Update a record in RiwayatJabatan
     * 
     * @param \Illuminate\Http\Request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            // Validate the request
            $request->validate([
                'pegawai_id' => 'required|exists:pegawai,id',
                'unit_kerja_id' => 'required|exists:unit_kerja,id',
                'eselon_id' => 'required|exists:eselon,id',
                'jabatan_struktural_id' => 'required|exists:jabatan_struktural,id',
                'jabatan_fungsional_id' => 'required|exists:jabatan_fungsional,id',
                'satuan_kerja' => 'required|string',
                'jenis' => 'required|string',
                'tmt_js' => 'required|date',
                'akhir_eselon' => 'required|date',
                'tmt_jf' => 'required|date',
                'nomor_sk' => 'required|string',
                'tanggal_sk' => 'required|date',
            ]);

            // Find a record in RiwayatJabatan
            $riwayatJabatan = RiwayatJabatan::find($id);

            // Check if the result is empty
            if ($riwayatJabatan === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Update the record in RiwayatJabatan
            $riwayatJabatan->update($request->all());

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
     * Delete a record from RiwayatJabatan
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try {
            // Find a record in RiwayatJabatan
            $riwayatJabatan = RiwayatJabatan::find($id);

            // Check if the result is empty
            if ($riwayatJabatan === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Delete the record from RiwayatJabatan
            $riwayatJabatan->delete();

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
