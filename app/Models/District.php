<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'district';
    protected $fillable = [
        'name',
        'type',
        'latlng',
        'province_id',
        'id_temp',
    ];

    // Lấy các bản ghi cùng miền
    public function get_with_province($province)
    {
        $all = District::select('district.*')
        ->where('province_id', '=', $province)
        ->get();
        return $all;
    }

    public function get_with_id($id)
    {
        $all = District::select('district.name')
        ->where('id', '=', $id)
        ->first();
        return $all;
    }


    public function get_all()// Lấy ra tất cả District
    {
        $all = District::select('district.*')
            ->get();
        return $all;
    }
}
