<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\common\DeQuyController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    //
    public function selectData(Request $request)
    {
        $new_category = new Category();
        $new_deQuy = new DeQuyController();
        $get_where = $new_category->get_all();
        $data_rank = $new_deQuy->data_rank_select($get_where, $request->data);
        return response()->json([
            'data' => $data_rank,
            'status' => 200
        ]);
    }
}
