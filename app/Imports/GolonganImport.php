<?php

namespace App\Imports;

use App\Models\Golongan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GolonganImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Golongan([
            'name' => $row['name'],
            'golongan' => $row['golongan'],
        ]);
    }
}
