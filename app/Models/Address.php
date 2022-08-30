<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'address';
    protected $fillable = [
        'user_id',
        'address',
    ];
    // Lấy ra thông tin địa chỉ user
    public function get_address($user_id)
    {
        $address = Address::join('province', 'province.id', 'address.province_id')
            ->join('district', 'district.id', 'address.district_id')
            ->select('address.*', 'province.name as provinceName', 'district.name as districtName')
            ->where('user_id', '=', $user_id)
            ->first();
        return $address;
    }
    // Lấy ra province 
    public function get_province()
    {
        $province = Province::select('province.*')->get();
        return $province;
    }
    // Lấy ra District
    public function get_district()
    {
        $district = District::select('district.*')->get();
        return $district;
    }
}
