<?php

namespace App\Http\Controllers;

use App\Http\Resources\StrukturResource;
use App\Models\Struktur;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class APIStrukturController extends Controller
{
    /**
     * Get all records from Struktur
     * 
     * @return \Illuminate\Http\JsonResponse
     * @var \App\Models\Struktur
     */

    public function getall()
    {
        try {
            // Get all records from Struktur
            $struktur = Struktur::with([
                'jabatan_struktural',
                'jabatan_fungsional',
                'grade',
                'eselon',
                'parent'
            ])->get();
            // Check if the result is empty
            if ($struktur->isEmpty()) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'No records found'
                ], Response::HTTP_NOT_FOUND);
            }
            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => StrukturResource::collection($struktur)
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
     * Get a record from Struktur
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        try {
            // Retrieve a record from Struktur
            $struktur = Struktur::with([
                'jabatan_struktural',
                'jabatan_fungsional',
                'grade',
                'eselon',
                'parent'
            ])->find($id);

            // Check if the result is empty
            if ($struktur === null) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => new StrukturResource($struktur)
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
     * Create a new record in Struktur
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'jabatan_struktural_id' => 'required|integer|exists:jabatan_struktural,id',
                'jabatan_fungsional_id' => 'required|integer|exists:jabatan_fungsional,id',
                'grade_id' => 'required|integer|exists:grades,id',
                'eselon_id' => 'required|integer|exists:eselons,id',
                'parent_id' => 'required|integer|exists:strukturs,id',
                'jv' => 'required|integer',
            ]);

            // Create a new record in Struktur
            $struktur = Struktur::create($request->all());

            // Return a 201 Created response
            return response()->json([
                'message' => 'Success',
                'data' => new StrukturResource($struktur)
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
     * Update a record in Struktur
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
                'jabatan_struktural_id' => 'required|integer|exists:jabatan_struktural,id',
                'jabatan_fungsional_id' => 'required|integer|exists:jabatan_fungsional,id',
                'grade_id' => 'required|integer|exists:grades,id',
                'eselon_id' => 'required|integer|exists:eselons,id',
                'parent_id' => 'required|integer|exists:strukturs,id',
                'jv' => 'required|integer',
            ]);

            // Find the record and update it
            $struktur = Struktur::find($id);
            $struktur->update($request->all());

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => new StrukturResource($struktur)
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
     * Delete a record from Struktur
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try {
            // Find the record
            $struktur = Struktur::find($id);

            // Check if the result is empty
            if ($struktur === null) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Delete the record
            $struktur->delete();

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

    /**
     * Get all records from Struktur by Eselon
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @var \App\Models\Struktur
     */
    public function getallbyeselon($id)
    {
        try {
            // Get all records from Struktur
            $struktur = Struktur::with([
                'jabatan_struktural',
                'jabatan_fungsional',
                'grade',
                'eselon',
                'parent'
            ])->where('eselon_id', $id)->get();
            // Check if the result is empty
            if ($struktur->isEmpty()) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'No records found'
                ], Response::HTTP_NOT_FOUND);
            }
            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => StrukturResource::collection($struktur)
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
     * Get all records from Struktur by Grade
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @var \App\Models\Struktur
     */
    public function getallbygrade($id)
    {
        try {
            // Get all records from Struktur
            $struktur = Struktur::with([
                'jabatan_struktural',
                'jabatan_fungsional',
                'grade',
                'eselon',
                'parent'
            ])->where('grade_id', $id)->get();
            // Check if the result is empty
            if ($struktur->isEmpty()) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'No records found'
                ], Response::HTTP_NOT_FOUND);
            }
            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => StrukturResource::collection($struktur)
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
     * Get all records from Struktur by Jabatan Struktural
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @var \App\Models\Struktur
     */
    public function getallbyjabatanstruktural($id)
    {
        try {
            // Get all records from Struktur
            $struktur = Struktur::with([
                'jabatan_struktural',
                'jabatan_fungsional',
                'grade',
                'eselon',
                'parent'
            ])->where('jabatan_struktural_id', $id)->get();
            // Check if the result is empty
            if ($struktur->isEmpty()) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'No records found'
                ], Response::HTTP_NOT_FOUND);
            }
            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => StrukturResource::collection($struktur)
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
     * Get all records from Struktur by Jabatan Fungsional
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @var \App\Models\Struktur
     */
    public function getallbyjabatanfungsional($id)
    {
        try {
            // Get all records from Struktur
            $struktur = Struktur::with([
                'jabatan_struktural',
                'jabatan_fungsional',
                'grade',
                'eselon',
                'parent'
            ])->where('jabatan_fungsional_id', $id)->get();
            // Check if the result is empty
            if ($struktur->isEmpty()) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'No records found'
                ], Response::HTTP_NOT_FOUND);
            }
            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => StrukturResource::collection($struktur)
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
     * Get all records from Struktur by Parent
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @var \App\Models\Struktur
     */
    public function getallbyparent($id)
    {
        try {
            // Get all records from Struktur
            $struktur = Struktur::with([
                'jabatan_struktural',
                'jabatan_fungsional',
                'grade',
                'eselon',
                'parent'
            ])->where('parent_id', $id)->get();
            // Check if the result is empty
            if ($struktur->isEmpty()) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'No records found'
                ], Response::HTTP_NOT_FOUND);
            }
            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => StrukturResource::collection($struktur)
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
