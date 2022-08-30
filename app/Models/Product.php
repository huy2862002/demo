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
        'avatar',
        'category_id',
        'price',
        'discount',
        'status',
        'view',
        'moTaNgan',
        'moTaSP'
    ];
    // Thêm Mới Sản Phẩm
    public function add_new($name, $price, $category_id, $moTaNgan, $moTaSP, $avatar)
    {
        $new = new Product();
        $new->name = $name;
        $new->price = $price;
        $new->category_id = $category_id;
        $new->moTaNgan = $moTaNgan;
        $new->moTaSP = $moTaSP;
        $new->discount = 0;
        $new->status = 1;
        $new->view = 0;
        $new->ngayTao = strtotime(date('Y-m-d H:i:s'));
        $new->ngayCapNhat = strtotime(date('Y-m-d H:i:s'));
        if ($avatar) {
            $avatar = $avatar;
            $avatarName = $avatar->hashName();
            $new->avatar = $avatar->storeAs('images/products', $avatarName);
        } else {
            $new->avatar = '';
        }

        $new->save();
    }
    // Cập Nhật Sản Phẩm
    public function update_product($product, $name,$price, $category_id, $moTaNgan, $moTaSP, $avatar){
        $product->name = $name;
        $product->price = $price;
        $product->category_id = $category_id;
        $product->moTaNgan = $moTaNgan;
        $product->moTaSP = $moTaSP;
        $product->discount = $product->discount;

        if ($avatar) {
            $avatar = $avatar;
            $avatarName = $avatar->hashName();
            $product->avatar = $avatar->storeAs('images/products', $avatarName);
        } else {
            $product->avatar = $product->avatar;
        }
        $product->save();
    }
    // Lấy ra tất cả
    public function get_all()
    {
        $all = Product::select('products.*')
            ->orderBy('ngayTao', 'desc')
            ->paginate(6);
        return $all;
    }
    // Tổng số sản phẩm
    public function get_count()
    {
        $all = Product::select('products.*')
            ->count();
        return $all;
    }

    // Lấy các bản ghi theo các danh mục
    public function get_arr_category($arr_category)
    {
        $all = Product::join('categories', 'categories.id', 'products.category_id')
            ->select('products.*', 'categories.name as cateName')
            ->whereIn('category_id',  $arr_category)
            ->orderBy('ngayTao', 'desc')
            ->get();
        return $all;
    }
    // Lấy các bản ghi theo 1 danh mục
    public function get_category($category_id)
    {
        $all = Product::select('products.*')
            ->where('category_id',  $category_id)
            ->orderBy('ngayTao', 'desc')
            ->paginate(6);
        return $all;
    }

    // Lấy ra 4 sản phẩm mới nhất
    public function get_latest()
    {
        $all = Product::select('products.*')
            ->orderBy('ngayTao', 'desc')
            ->limit(4)
            ->get();
        return $all;
    }
    // Lấy 4 sản phẩm có lượt xem cao nhất
    public function get_popular()
    {
        $all = Product::select('products.*')
            ->orderBy('view', 'desc')
            ->limit(4)
            ->get();
        return $all;
    }
    // Lấy các sản phẩm khác id cùng danh mục
    public function get_other($id, $category_id)
    {
        $all = Product::select('products.*')
            ->where('id', '!=', $id)
            ->where('category_id', '=', $category_id)
            ->orderBy('ngayTao', 'desc')
            ->limit(4)
            ->get();
        return $all;
    }
}
