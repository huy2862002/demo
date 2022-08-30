<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'province';
    protected $fillable = [
        'name',
        'type',
        'latlng',
        'region',
        'order',
        'country_id',
    ];

    // Lấy các bản ghi cùng miền
    public function get_with_region($region)
    {
        $all = Province::select('province.*')
        ->where('region', '=', $region)
        ->get();
        return $all;
    }

    public function get_with_id($id)
    {
        $all = Province::select('province.name')
        ->where('id', '=', $id)
        ->first();
        return $all;
    }
}
