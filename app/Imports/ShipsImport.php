<?php

namespace App\Imports;

use App\Models\Ship;
use Maatwebsite\Excel\Concerns\ToModel;

class ShipsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Ship([
            'district_id' => $row[0],
            'province_id' => $row[1],
            'weight' => $row[2],
        ]);
    }
}
