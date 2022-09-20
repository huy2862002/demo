<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\common\DeQuyController;
use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\AttributeProduct;
use App\Models\AttributeProductOption;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

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
            'data_category' => $data_category,
            'list_product' => $list_product
        ]);
    }

    public function detail(Product $product) // Chi tiết sản phẩm
    {
        if (!Cookie::get($product->id)) {
            $product->view += 1;
            $product->save();
            Cookie::queue($product->id, $product, 30);
        }
        $new_product = new Product();
        $new_att = new Attribute();
        $new_att_opt = new AttributeOption();
        $new_opt_product = new AttributeProductOption();
        $new_att_product = new AttributeProduct();
        $att_product = $new_att_product->get_where_product_id($product->id);
        $att = $new_att->get_all();
        $att_option = $new_att_opt->get_all();
        $opt_product = $new_opt_product->get_where_product_id($product->id);
        $opt = [];
        if (count($opt_product) > 0) {
            foreach ($opt_product as $item) {
                foreach (explode(' ', $item->option_id) as $option) {
                    foreach ($att_option as $val) {
                        if ($val->id == $option && !in_array($val, $opt)) {
                            $opt[] = $val;
                        }
                    }

                }
            }
        }
        $chose_option = [];
        $info_other = [];
        foreach ($att_product as $item) {
            foreach ($att as $a) {
                if ($a->type == 2 && $item->attribute_id == $a->id) {
                    $chose_option[] = $a;
                }
                if ($a->type == 1 && $item->attribute_id == $a->id || $a->type == 0 && $item->attribute_id == $a->id) {
                    $info_other[] = $a;
                }
            }
        }
        $default = $new_opt_product->get_default($product->id);
        $normal = $new_opt_product->get_normal($product->id);
        $related = $new_product->get_other($product->id, $product->category_id); // Các sản phẩm cùng danh mục
        return view('web.product.detail', [
            'product' => $product,
            'related' => $related,
            'chose_option' => $chose_option, // Thuộc tính tùy chọn theo khách hàng
            'info_other' => $info_other,
            'opt' => $opt,
            'normal' => $normal,
            'default' => $default
        ]);
    }
}
