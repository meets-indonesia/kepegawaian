<?php

namespace App\Http\Controllers;

use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class APIUnitKerjaController extends Controller
{
    /**
     * Get all records from UnitKerja
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getall()
    {
        try {
            // Retrieve all records from UnitKerja
            $unitKerja = UnitKerja::all();

            // Check if the result is empty
            if ($unitKerja->isEmpty()) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'No records found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => $unitKerja
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
     * Get a record from UnitKerja
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        try {
            // Retrieve a record from UnitKerja
            $unitKerja = UnitKerja::find($id);

            // Check if the result is empty
            if ($unitKerja === null) {
                // Return a 404 Not Found response
                return response()->json([
                    'message' => 'Record not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Return the data with a 200 OK status
            return response()->json([
                'message' => 'Success',
                'data' => $unitKerja
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
