<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Province;
use App\Models\Ship;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    //
    public function provinceData(Request $request)
    {
        $new_province = new Province();
        $data_province = $new_province->get_with_region($request->data);
        return response()->json([
            'data' => $data_province,
            'status' => 200
        ]);
    }
    public function districtData(Request $request)
    {
        $new_district = new District();
        $data_district = $new_district->get_with_province($request->data);
        return response()->json([
            'data' => $data_district,
            'status' => 200
        ]);
    }
    public function shipData(Request $request)
    {
        $new_ship = new Ship();
        $ship_fee = $new_ship->ship_fee($request->data);
        return response()->json([
            'data' => $ship_fee,
            'status' => 200
        ]);
    }
}
