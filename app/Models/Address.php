<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Address extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'address';
    protected $fillable = [
        'user_id',
        'address',
        'created_at',
        'updated_at'
    ];
    // Lấy ra thông tin địa chỉ user
    public function get_address($user_id)
    {
        $address = Address::join('province', 'province.id', 'address.province_id')
            ->join('district', 'district.id', 'address.district_id')
            ->select('address.*', 'province.name as provinceName', 'district.name as districtName', 'district.type as districtType', 'province.type as provinceType')
            ->where('user_id', '=', $user_id)
            ->first();
        return $address;
    }
    public function get_address_session($province_id,$district_id)
    {
        $address = Province::join('district', 'district.id', 'province.district_id')
            ->select('province.name as provinceName', 'district.name as districtName', 'district.type as districtType', 'province.type as provinceType', 'province.region as region_id')
            ->where('province_id', '=', $province_id)
            ->where('district_id', '=', $district_id)
            ->first();
        return $address;
    }
    public function update_address($address_update, $region_id, $province_id, $district_id, $address){
        $address_update->region_id = $region_id;
        $address_update->province_id = $province_id;
        $address_update->district_id = $district_id;
        $address_update->address = $address;
        $address->created_at = strtotime(date('Y-m-d H:i:s'));
        $address_update->save();
    }
    // Thêm Mới địa chỉ
    public function add_new($user_id, $region_id, $province_id, $district_id, $address){
        $new_address = new Address();
        $new_address->user_id = $user_id;
        $new_address->region_id = $region_id;
        $new_address->province_id = $province_id;
        $new_address->district_id = $district_id;
        $new_address->address = $address;
        $new_address->created_at = strtotime(date('Y-m-d H:i:s'));
        $new_address->updated_at = strtotime(date('Y-m-d H:i:s'));
        $new_address->save();
    }

    public function  get_address_with_id($id){
        $address = Address::select('address.*')
            ->where('id', '=', $id)
            ->first();
        return $address;
    }

}
