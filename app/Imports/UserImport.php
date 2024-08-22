<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImport implements ToModel, WithHeadingRow, WithChunkReading
{
    public function model(array $row)
    {
        return new User([
            'username' => $row['username'],
            'email' => $row['email'],
            'password' => Hash::make($row['password']),
            'role_id' => $row['role_id'],
        ]);
    }

    public function chunkSize(): int
    {
        return 50; // Process 100 rows at a time
    }
}
