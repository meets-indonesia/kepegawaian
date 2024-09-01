<?php

namespace App\Imports;

use App\Models\JabatanFungsional;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JabatanFungsionalImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new JabatanFungsional([
            'name' => $row['name'],
            'masa' => $row['masa'],
        ]);
    }
}
