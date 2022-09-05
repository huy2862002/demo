<?php

namespace App\Imports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;

class CategoriesImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Category([
            'name' => $row[0],
            'parent_id' => $row[1],
            'ngayTao' => strtotime(date('Y-m-d H:i:s')),
            'ngayCapNhat' => strtotime(date('Y-m-d H:i:s')),
        ]);
    }
}
