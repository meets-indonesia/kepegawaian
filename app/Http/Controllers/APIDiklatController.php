<?php

namespace App\Http\Controllers;

use App\Http\Resources\DiklatResource;
use App\Models\Diklat;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class APIDiklatController extends Controller
{
    /** 
     * Get all records from Diklat
     *
     * @return \Illuminate\Http\JsonResponse
     * @var \App\Models\Diklat
     */
    public function getall()
    {
        try {
            $diklat = Diklat::all();
            // Check if the result is empty
            if ($diklat->isEmpty()) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'No records found'
                ], Response::HTTP_NOT_FOUND);
            }
            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => DiklatResource::collection($diklat)
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
     * Get a record from Diklat
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        try {
            // Retrieve a record from Diklat
            $diklat = Diklat::find($id);

            // Check if the result is empty
            if ($diklat === null) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => new DiklatResource($diklat)
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
     * Create a new record in Diklat
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
                'name' => 'required|string',
                'jumlah_jam' => 'required|string',
                'tempat' => 'required|string',
                'penyelenggara' => 'required|string',
                'angkatan' => 'required|string',
                'tahun' => 'required|year',
                'nomor' => 'required|string',
                'tanggal_sttp' => 'required|date',
                'sertifikat' => 'required|string',
            ]);

            // Create a new record in Diklat
            $diklat = Diklat::create($request->all());

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
     * Update a record in Diklat
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
                'pegawai_id' => 'required|exists:pegawai,id',
                'name' => 'required|string',
                'jumlah_jam' => 'required|string',
                'tempat' => 'required|string',
                'penyelenggara' => 'required|string',
                'angkatan' => 'required|string',
                'tahun' => 'required|year',
                'nomor' => 'required|string',
                'tanggal_sttp' => 'required|date',
                'sertifikat' => 'required|string',
            ]);

            // Find a record in Diklat
            $diklat = Diklat::find($id);

            // Check if the result is empty
            if ($diklat === null) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Update the record in Diklat
            $diklat->update($request->all());

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
     * Delete a record from Diklat
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try {
            // Find a record in Diklat
            $diklat = Diklat::find($id);

            // Check if the result is empty
            if ($diklat === null) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Delete the record from Diklat
            $diklat->delete();

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
