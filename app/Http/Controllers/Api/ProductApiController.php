<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\common\DeQuyController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    //
    public function selectData(Request $request)
    {
        $new_category = new Category();
        $new_deQuy = new DeQuyController();
        $new_product = new Product();
        $list_category = $new_category->select_id_or_parent($request->data);
        $data_category = $new_deQuy->data_rank_select($list_category, $request->data);
        $id_cate = [];
        foreach ($data_category as $item) {
            $id_cate[] =  $item['id'];
        }
        $data_product = $new_product->get_arr_category($id_cate);
        return response()->json([
            'data' => $data_product,
            'status' => 200
        ]);
    }
}
