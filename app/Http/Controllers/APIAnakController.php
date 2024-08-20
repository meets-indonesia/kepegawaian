<?php

namespace App\Http\Controllers;

use App\Http\Resources\AnakResource;
use App\Models\Anak;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class APIAnakController extends Controller
{
    /**
     * Get all records from Anak
     *
     * @return \Illuminate\Http\JsonResponse
     * @var \App\Models\Anak
     */
    public function getall()
    {
        try {
            $anak = Anak::all();
            // Check if the result is empty
            if ($anak->isEmpty()) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'No records found'
                ], Response::HTTP_NOT_FOUND);
            }
            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' =>  AnakResource::collection($anak)
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
     * Get a record from Anak
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        try {
            // Retrieve a record from Anak
            $anak = Anak::find($id);

            // Check if the result is empty
            if ($anak === null) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => new AnakResource($anak)
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
     * Create a new record in Anak
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        try {
            // validate the request
            $request->validate([
                'pegawai_id' => 'required|exists:pegawai,id',
                'pendidikan_id' => 'required|exists:pendidikan,id',
                'name' => 'required|string',
                'jenis_kelamin' => 'required|string',
                'pekerjaan' => 'required|string',
                'tempat_tinggal' => 'required|string',
                'tanggal_lahir' => 'required|date',
                'status' => 'required|string'
            ]);
            // Create a new record in Anak
            $anak = Anak::create($request->all());

            // Return the data with a 201 Created status
            return response()->json([
                'message' => 'Success Create Record',
                'data' => new AnakResource($anak)
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
     * Update a record in Anak
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
                'pendidikan_id' => 'required|exists:pendidikan,id',
                'name' => 'required|string',
                'jenis_kelamin' => 'required|string',
                'pekerjaan' => 'required|string',
                'tempat_tinggal' => 'required|string',
                'tanggal_lahir' => 'required|date',
                'status' => 'required|string'
            ]);

            // Find the record in Anak
            $anak = Anak::find($id);

            // Check if the result is empty
            if ($anak === null) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Update the record in Anak
            $anak->update($request->all());

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success Update Record',
                'data' => new AnakResource($anak)
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
     * Delete a record from Anak
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try {
            // Retrieve a record from Anak
            $anak = Anak::find($id);

            // Check if the result is empty
            if ($anak === null) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Delete the record from Anak
            $anak->delete();

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
