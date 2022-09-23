<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    use HasFactory;
    public $timestamps = FALSE;

    protected $table = 'ships';

    protected $fillable = [
        'province_id',
        'district_id',
        'ship_fee'
    ];

    public function ship_fee($district_id){
        $feeShip = Ship::select('ships.*')
        ->where('district_id', '=', $district_id)
        ->first();
        return $feeShip;
    }

    public function list(){
        $list = Ship::join('province','province.id','ships.province_id')
        ->join('district','district.id','ships.district_id')
        ->select('ships.*','ships.id as shipId', 'province.name as provinceName', 'district.name as districtName')
        ->paginate(20);
        return $list;
    }


}
