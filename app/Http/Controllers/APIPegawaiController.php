<?php

namespace App\Http\Controllers;

use App\Http\Resources\PegawaiResource;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class APIPegawaiController extends Controller
{
    /**
     * Get all records from Pegawai
     *
     * @return \Illuminate\Http\JsonResponse
     * @var \App\Models\Pegawai
     */
    public function getall()
    {
        try {
            // Retrieve all records from Pegawai
            $pegawai = Pegawai::with([
                'unit_kerja',
                'jabatan_struktural',
                'jabatan_fungsional',
                'pendidikan',
                'grade',
                'golongan',
                'kelompok_pegawai',
                'jenis_pegawai',
                'jurusan',
                'prodi'
            ])->get();
            // Check if the result is empty
            if ($pegawai->isEmpty()) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'No records found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' =>  PegawaiResource::collection($pegawai)
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
     * Get a record from Pegawai
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @var \App\Models\Pegawai
     */
    public function get($id)
    {
        try {
            // Retrieve a record from Pegawai
            $pegawai = Pegawai::with([
                'unit_kerja',
                'jabatan_struktural',
                'jabatan_fungsional',
                'pendidikan',
                'grade',
                'golongan',
                'kelompok_pegawai',
                'jenis_pegawai',
                'jurusan',
                'prodi'
            ])->find($id);

            // Check if the result is empty
            if ($pegawai === null) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => new PegawaiResource($pegawai)
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
     * Create a record in Pegawai
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * @var \App\Models\Pegawai
     */
    public function create(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'nip' => 'required | unique:pegawai,nip',
                'name' => 'required | string',
                'email' => 'required | email',
                'tamat_cpns' => 'required | date',
                'tamat_pns' => 'required | date',
                'unit_kerja_id' => 'exists:unit_kerja,id',
                'jabatan_struktural_id' => 'exists:jabatan_struktural,id',
                'jabatan_fungsional_id' => 'exists:jabatan_fungsional,id',
                'pendidikan_id' => 'exists:pendidikan,id',
                'grade_id' => 'exists:grade,id',
                'golongan_id' => 'exists:golongan,id',
                'kelompok_pegawai_id' => 'exists:kelompok_pegawai,id',
                'jenis_pegawai_id' => 'exists:jenis_pegawai,id',
                'jurusan_id' => 'exists:jurusan,id',
                'prodi_id' => 'exists:prodi,id',
            ]);

            // Create a new record in Pegawai
            $pegawai = Pegawai::create($request->all());

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
     * Update a record in Pegawai
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @var \App\Models\Pegawai
     */
    public function update(Request $request, $id)
    {
        try {
            // Validate the request
            $request->validate([
                'nip' => 'required | unique:pegawai,nip,' . $id,
                'name' => 'required | string',
                'email' => 'required | email',
                'tamat_cpns' => 'required | date',
                'tamat_pns' => 'required | date',
                'unit_kerja_id' => 'exists:unit_kerja,id',
                'jabatan_struktural_id' => 'exists:jabatan_struktural,id',
                'jabatan_fungsional_id' => 'exists:jabatan_fungsional,id',
                'pendidikan_id' => 'exists:pendidikan,id',
                'grade_id' => 'exists:grade,id',
                'golongan_id' => 'exists:golongan,id',
                'kelompok_pegawai_id' => 'exists:kelompok_pegawai,id',
                'jenis_pegawai_id' => 'exists:jenis_pegawai,id',
                'jurusan_id' => 'exists:jurusan,id',
                'prodi_id' => 'exists:prodi,id',
            ]);

            // Retrieve a record from Pegawai
            $pegawai = Pegawai::find($id);

            // Check if the result is empty
            if ($pegawai === null) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Update the record in Pegawai
            $pegawai->update($request->all());

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
     * Delete a record from Pegawai
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @var \App\Models\Pegawai
     */
    public function delete($id)
    {
        try {
            // Retrieve a record from Pegawai
            $pegawai = Pegawai::find($id);

            // Check if the result is empty
            if ($pegawai === null) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Delete the record from Pegawai
            $pegawai->delete();

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
