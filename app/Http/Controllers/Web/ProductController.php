<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\common\DeQuyController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function list()
    {

        $new_product = new Product();
        $new_category = new Category();
        $new_deQuy = new DeQuyController();
        $list_product = $new_product->get_all();
        $list_category = $new_category->get_all();
        $data_category = $new_deQuy->data_rank($list_category, 0);
        return view('web.product.list', [
            'data_category' =>  $data_category,
            'list_product' => $list_product
        ]);
    }

    public function detail(Product $product)
    {
        $new_product = new Product();
        $related = $new_product->get_other($product->id, $product->category_id);
        return view('web.product.detail', [
            'product' =>  $product,
            'related' => $related
        ]);
    }
}
