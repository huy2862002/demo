<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\common\DeQuyController;
use App\Http\Controllers\Controller;
use App\Models\AttributeProductOption;
use App\Models\Category;
use App\Models\Code;
use App\Models\Order;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    //
    public function selectData(Request $request)
    {
        $new_category = new Category();
        $new_deQuy = new DeQuyController();
        $new_product = new Product();
        $get_where = $new_category->get_all();
        $data_category = $new_deQuy->data_rank_select($get_where, $request->data);
        $id_cate = [];
        foreach ($data_category as $item) {
            $id_cate[] = $item['id'];
        }
        $data_product = $new_product->get_arr_category($id_cate);
        return response()->json([
            'data' => $data_product,
            'status' => 200
        ]);
    }

    public function codeData(Request $request)
    {
        $new_order = new Order();
        $code = $new_order->discount_code($request->value);
        $discount = 0;
        $type = '';
        if ($code) {
            $discount = $code->discount;
            $type = $code->type;
        }
        return response()->json([
            'data' => $discount,
            'type'=>$type,
            'status' => 200
        ]);
    }

    public function updatePriceVariant(Request $request)
    {
        $variant = AttributeProductOption::find($request->id);
       $new_opt_product = new AttributeProductOption();
       if($request->value > 0 && $request->value){
           $value = $request->value;
       }else{
           $value = 0;
       }
       $new_opt_product->update_price($variant, $value);
        return response()->json([
            'data' => $variant,
            'status' => 200
        ]);
    }

    public function updatePriceDiscountVariant(Request $request)
    {
        $variant = AttributeProductOption::find($request->id);
        $new_opt_product = new AttributeProductOption();
        if($request->value > 0 && $request->value){
            $value = $request->value;
        }else{
            $value = 0;
        }
        $variant->price_discount = $value;
        $variant->save();
        return response()->json([
            'data' => $variant,
            'status' => 200
        ]);
    }



    public function updateAvtVariant(Request $request)
    {
        request()->validate([
            'image'  => 'required|mimes:jpg,png,jpeg|max:2048',
        ]);
        if ($files = $request->file('image')) {
            $id = $request->input('hid');
            $variant = AttributeProductOption::find($id);
            $new_opt_product = new AttributeProductOption();
            $file = $request->image->store('images/products');
            $new_opt_product->update_avt($variant, $file);
            return Response()->json([
                "success" => true,
                "file" => $files,
                "id"=>$id
            ]);
        }
    }

    public function updateInventoryVariant(Request $request){
        $variant = AttributeProductOption::find($request->id);
        $new_opt_product = new AttributeProductOption();
        if($request->value > 0 && $request->value){
            $value = $request->value;
        }else{
            $value = 0;
        }
        $new_opt_product->update_inventory($variant, $value);
        return response()->json([
            'data' => $variant,
            'status' => 200
        ]);
    }

    public function getInfoVariant(Request $request){
        $new_opt_product = new AttributeProductOption();
        $option = implode(' ', $request->value);
        $att = $new_opt_product->get_where_opt($request->id, $option);
        return response()->json([
            'data' => $att,
            'status' => 200
        ]);
    }

    public function primarySetup(Request $request){
        $variant = AttributeProductOption::find($request->id);
        $new_opt_product = new AttributeProductOption();
        $variant->status = 0;
        $variant->save();
        $new_opt_product->variant_des_primary($request->proId);
        return response()->json([
            'data' => $variant,
            'status' => 200
        ]);
    }

    public function hiddenSetup(Request $request){
        $variant = AttributeProductOption::find($request->id);
        $new_opt_product = new AttributeProductOption();
        if($variant->status == 2){
            $variant->status = 1;
        }else{
            $variant->status = 2;
        }
        $variant->save();
        return response()->json([
            'data' => $variant,
            'status' => 200
        ]);
    }


    public function loadRating(Request $request){
        $new_rating = new Rating();
        $new_rating->add_new($request);
        return response()->json([
            'data'=>$request,
            'status'=>200
        ]);
    }


}
