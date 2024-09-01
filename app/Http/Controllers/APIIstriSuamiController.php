<?php

namespace App\Http\Controllers;

use App\Http\Resources\IstriSuamiResource;
use App\Models\IstriSuami;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class APIIstriSuamiController extends Controller
{
    /**
     * Get all records from IstriSuami
     * 
     * @return \Illuminate\Http\JsonResponse
     * @var \App\Models\IstriSuami
     */

    public function getall()
    {
        try {
            // Retrieve all records from IstriSuami
            $istriSuami = IstriSuami::with([
                'pegawai',
                'pendidikan'
            ])->get();

            // Check if the result is empty
            if ($istriSuami->isEmpty()) {
                return response()->json([
                    'message' => 'No records found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => IstriSuamiResource::collection($istriSuami)
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
     * Get a record from IstriSuami
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        try {
            // Retrieve a record from IstriSuami
            $istriSuami = IstriSuami::with([
                'pegawai',
                'pendidikan'
            ])->find($id);

            // Check if the result is empty
            if ($istriSuami === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => new IstriSuamiResource($istriSuami)
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
     * Create a new record in IstriSuami
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
                'pendidikan_id' => 'required|exists:pendidikans,id',
                'nama' => 'required|string',
                'tanggal_lahir' => 'required|date',
                'tanggal_nikah' => 'required|date',
                'pekerjaan' => 'required|string',
                'tempat_tinggal' => 'required|string',
                'status' => 'required|string',
            ]);

            // Create a new record in IstriSuami
            $istriSuami = IstriSuami::create($request->all());

            // Return the data with a 201 Created status
            return response()->json([
                'message' => 'Success Create New Record',
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
     * Update a record in IstriSuami
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
                'pendidikan_id' => 'required|exists:pendidikans,id',
                'nama' => 'required|string',
                'tanggal_lahir' => 'required|date',
                'tanggal_nikah' => 'required|date',
                'pekerjaan' => 'required|string',
                'tempat_tinggal' => 'required|string',
                'status' => 'required|string',
            ]);

            // Find the record and update it
            $istriSuami = IstriSuami::find($id);
            $istriSuami->update($request->all());

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
     * Delete a record from IstriSuami
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try {
            // Find the record in IstriSuami
            $istriSuami = IstriSuami::find($id);

            // Check if the result is empty
            if ($istriSuami === null) {
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Delete the record
            $istriSuami->delete();

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
