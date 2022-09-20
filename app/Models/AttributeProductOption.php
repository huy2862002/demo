<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeProductOption extends Model
{
    use HasFactory;

    public $timestamps = FALSE;
    protected $table = 'attribute_product_options';
    protected $fillable = [
        'product_id',
        'option_id',
        'avatar',
        'status',
        'price',
        'created_at',
        'updated_at'
    ];

    public function add_new($product_id, $option_id)
    {
        $new = new AttributeProductOption();
        $exist = AttributeProductOption::select('attribute_product_options.*')
            ->where('option_id', '=', $option_id)
            ->where('product_id', $product_id)
            ->exists();
        if ($exist == false) {
            $new->product_id = $product_id;
            $new->option_id = $option_id;
            $new->image = '';
            $new->inventory = 0;
            $new->price = 0;
            $new->price_discount = 0;
            $new->status = 1;
            $new->created_at = strtotime(date('Y-m-d H:i:s'));
            $new->updated_at = strtotime(date('Y-m-d H:i:s'));
            $new->save();
        }
    }

    public function get_where_product_id($id)
    {
        $get_where_product_id = AttributeProductOption::select('attribute_product_options.*')
            ->where('product_id', '=', $id)
            ->get();
        return $get_where_product_id;
    }

    public function get_where_option_id($id, $option_id)
    {
        $get_where_product_id = AttributeProductOption::select('attribute_product_options.*')
            ->where('product_id', '=', $id)
            ->where('option_id', '=', $option_id)
            ->get();
        return $get_where_product_id;
    }

    public function saveVariant($variant)
    {
        $variant->price = 1;
        $variant->status = 1;
        $variant->save();
    }

    public function update_price($variant, $price)
    {
        $variant->price = $price;
        $variant->save();
    }

    public function update_avt($variant, $avatar)
    {
        $variant->image = $avatar;
        $variant->save();
    }

    public function update_inventory($variant, $inventory)
    {
        $variant->inventory = $inventory;
        $variant->save();
    }

    public function get_default($id)
    {
        $default = AttributeProductOption::select('attribute_product_options.*')
            ->where('product_id', '=', $id)
            ->where('status', '=', 0)
            ->first();
        return $default;
    }

    public function get_normal($id)
    {
        $normal = AttributeProductOption::select('attribute_product_options.*')
            ->where('product_id', '=', $id)
            ->where('status', '=', 1)
            ->get();
        return $normal;
    }

    public function get_where_opt($id, $opt)
    {
        $all = AttributeProductOption::join('products', 'products.id', 'attribute_product_options.product_id')
            ->select('attribute_product_options.*', 'products.name as name')
            ->where('product_id', '=', $id)
            ->where('option_id', '=', $opt)
            ->first();
        return $all;
    }

    public function variant_des_primary($id)
    {
        $variant = AttributeProductOption::select('attribute_product_options.*')
            ->where('product_id', '=', $id)
            ->where('status', '=', 0)
            ->first();
        $variant->status = 1;
        $variant->save();
    }

    public function get_att_product($id)
    {
        $att = AttributeProductOption::select('attribute_product_options.*')
            ->where('product_id', '=', $id)
            ->get();
        return $att;
    }
}
