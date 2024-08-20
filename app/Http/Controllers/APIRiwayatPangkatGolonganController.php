<?php

namespace App\Http\Controllers;

use App\Http\Resources\RiwayatPangkatGolonganResource;
use App\Models\RiwayatPangkatGolongan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class APIRiwayatPangkatGolonganController extends Controller
{
    /**
     * Get all records from RiwayatPangkatGolongan.
     * 
     * @return \Illuminate\Http\JsonResponse
     * @var \App\Models\RiwayatPangkatGolongan
     */

    public function getall()
    {
        try {
            // Retrieve all records from RiwayatPangkatGolongan
            $riwayatPangkatGolongan = RiwayatPangkatGolongan::with(['pegawai'])->get();

            // Check if the result is empty
            if ($riwayatPangkatGolongan->isEmpty()) {
                return response()->json([
                    'message' => 'No records found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => RiwayatPangkatGolonganResource::collection($riwayatPangkatGolongan)
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
     * Get a record from RiwayatPangkatGolongan.
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        try {
            // Retrieve a record from RiwayatPangkatGolongan
            $riwayatPangkatGolongan = RiwayatPangkatGolongan::with(['pegawai'])->find($id);

            // Check if the result is empty
            if ($riwayatPangkatGolongan === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => new RiwayatPangkatGolonganResource($riwayatPangkatGolongan)
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
     * Create a new record in RiwayatPangkatGolongan.
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
                'lokasi_kerja_id' => 'required|exists:lokasi_kerja,id',
                'golongan_ruang' => 'required|string',
                'tmt_golongan' => 'required|date',
                'tanggal_sk' => 'required|date',
                'nomor_sk' => 'required|string',
            ]);
            // Create a new record in RiwayatPangkatGolongan
            $riwayatPangkatGolongan = RiwayatPangkatGolongan::create($request->all());
            // Return a 201 Created response
            return response()->json([
                'message' => 'Success',
                'data' => new RiwayatPangkatGolonganResource($riwayatPangkatGolongan)
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
     * Update a record in RiwayatPangkatGolongan.
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
                'lokasi_kerja_id' => 'required|exists:lokasi_kerja,id',
                'golongan_ruang' => 'required|string',
                'tmt_golongan' => 'required|date',
                'tanggal_sk' => 'required|date',
                'nomor_sk' => 'required|string',
            ]);
            // Find the record
            $riwayatPangkatGolongan = RiwayatPangkatGolongan::find($id);
            // Check if the record is not found
            if ($riwayatPangkatGolongan === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }
            // Update the record
            $riwayatPangkatGolongan->update($request->all());
            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => new RiwayatPangkatGolonganResource($riwayatPangkatGolongan)
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
     * Delete a record from RiwayatPangkatGolongan.
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try {
            // Find the record
            $riwayatPangkatGolongan = RiwayatPangkatGolongan::find($id);
            // Check if the record is not found
            if ($riwayatPangkatGolongan === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }
            // Delete the record
            $riwayatPangkatGolongan->delete();
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
