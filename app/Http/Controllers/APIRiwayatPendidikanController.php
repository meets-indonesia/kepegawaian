<?php

namespace App\Http\Controllers;

use App\Http\Resources\RiwayatPendidikanResource;
use App\Models\RiwayatPendidikan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class APIRiwayatPendidikanController extends Controller
{
    /**
     * Get all records from RiwayatPendidikan.
     * 
     * @return \Illuminate\Http\JsonResponse
     * @var \App\Models\RiwayatPendidikan
     */

    public function getall()
    {
        try {
            // Retrieve all records from RiwayatPendidikan
            $riwayatPendidikan = RiwayatPendidikan::with([
                'pegawai',
                'pendidikan',
                'jurusan'
            ])->get();

            // Check if the result is empty
            if ($riwayatPendidikan->isEmpty()) {
                return response()->json([
                    'message' => 'No records found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => RiwayatPendidikanResource::collection($riwayatPendidikan)
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
     * Get a record from RiwayatPendidikan.
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        try {
            // Retrieve a record from RiwayatPendidikan
            $riwayatPendidikan = RiwayatPendidikan::with([
                'pegawai',
                'pendidikan',
                'jurusan'
            ])->find($id);

            // Check if the result is empty
            if ($riwayatPendidikan === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => new RiwayatPendidikanResource($riwayatPendidikan)
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
     * Create a new record in RiwayatPendidikan.
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
                'pendidikan_id' => 'required|exists:pendidikan,id',
                'jurusan_id' => 'required|exists:jurusan,id',
                'tanggal_lulus' => 'required|date',
                'nama_sekolah' => 'required|string',
                'gelar_depan' => 'required|string',
                'gelar_belakang ' => 'required|string',
            ]);

            // Create a new record in RiwayatPendidikan
            $riwayatPendidikan = RiwayatPendidikan::create($request->all());

            // Save the record
            $riwayatPendidikan->save();

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
     * Update a record in RiwayatPendidikan.
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
                'pendidikan_id' => 'required|exists:pendidikan,id',
                'jurusan_id' => 'required|exists:jurusan,id',
                'tanggal_lulus' => 'required|date',
                'nama_sekolah' => 'required|string',
                'gelar_depan' => 'required|string',
                'gelar_belakang ' => 'required|string',
            ]);

            // Find the record
            $riwayatPendidikan = RiwayatPendidikan::find($id);

            // Check if the record exists
            if ($riwayatPendidikan === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Update the record
            $riwayatPendidikan->update($request->all());

            // Save the record
            $riwayatPendidikan->save();

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
     * Delete a record from RiwayatPendidikan.
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try {
            // Find the record
            $riwayatPendidikan = RiwayatPendidikan::find($id);

            // Check if the record is not found
            if ($riwayatPendidikan === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Delete the record
            $riwayatPendidikan->delete();

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
