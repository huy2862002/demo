<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $timestamps = FALSE;
    protected $table = 'products';

    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'image',
        'price',
        'price_discount',
        'inventory',
        'view',
        'short_description',
        'product_description',
        'created_at',
        'updated_at'
    ];

    public function add_new($name, $slug, $category_id, $image, $price, $price_discount, $inventory, $short_description, $product_description) // Hàm Thêm Mới Sản Phẩm
    {
        $new = new Product();
        $new->name = $name;
        $new->slug = $slug;
        $new->category_id = $category_id;
        if ($image) {
            $image = $image;
            $imageName = $image->hashName();
            $new->image = $image->storeAs('images/products', $imageName);
        } else {
            $new->image = '';
        }
        $new->price = $price;
        $new->price_discount = $price_discount;
        $new->inventory = $inventory;
        $new->view = 0;
        $new->short_description = $short_description;
        $new->product_description = $product_description;
        $new->created_at = strtotime(date('Y-m-d H:i:s'));
        $new->updated_at = strtotime(date('Y-m-d H:i:s'));
        $new->save();
    }

    public function update_info($product, $name, $slug, $category_id, $image, $price, $price_discount, $inventory, $short_description, $product_description)// Hàm Cập Nhật Sản Phẩm
    {
        $product->name = $name;
        $product->slug = $slug;
        $product->category_id = $category_id;
        if ($image) {
            $image = $image;
            $imageName = $image->hashName();
            $product->image = $image->storeAs('images/products', $imageName);
        } else {
            $product->image = $product->image;
        }
        $product->price = $price;
        $product->price_discount = $price_discount;
        $product->inventory = $inventory;
        $product->short_description = $short_description;
        $product->product_description = $product_description;
        $product->updated_at = strtotime(date('Y-m-d H:i:s'));
        $product->save();
    }

    public function get_with_category_id($category_id) // Lấy ra các sản phẩm cùng category_id
    {
        $product_with_category_id = Product::select('products.*')
            ->where('category_id','=', $category_id)
            ->get();
        return $product_with_category_id;
    }

    public function get_all() // Lấy ra tất cả
    {
        $get_all = Product::select('products.*')
            ->orderBy('created_at', 'desc')
            ->paginate(6);
        return $get_all;
    }

    public function get_count() // Tổng số sản phẩm
    {
        $get_count = Product::count();
        return $get_count;
    }


    public function get_arr_category($arr_category) // Lấy các bản ghi theo array các danh mục
    {
        $get_arr_category = Product::join('categories', 'categories.id', 'products.category_id')
            ->select('products.*', 'categories.name as cateName')
            ->whereIn('category_id', $arr_category)
            ->orderBy('created_at', 'desc')
            ->get();
        return $get_arr_category;
    }


    public function get_category($category_id)  // Lấy các bản ghi theo 1 danh mục
    {
        $get_category = Product::select('products.*')
            ->where('category_id', $category_id)
            ->orderBy('created_at', 'desc')
            ->paginate(6);
        return $get_category;
    }


    public function get_latest()  // Lấy ra 4 sản phẩm mới nhất
    {
        $get_latest = Product::select('products.*')
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();
        return $get_latest;
    }

    public function get_popular() // Lấy 4 sản phẩm có lượt xem cao nhất
    {
        $get_popular = Product::select('products.*')
            ->orderBy('view', 'desc')
            ->limit(4)
            ->get();
        return $get_popular;
    }

    // Lấy các sản phẩm khác id cùng danh mục
    public function get_other($id, $category_id)
    {
        $all = Product::select('products.*')
            ->where('id', '!=', $id)
            ->where('category_id', '=', $category_id)
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();
        return $all;
    }
}
