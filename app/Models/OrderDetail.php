<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    public $timestamps = FALSE;
    protected $table = 'order_details';
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'created_at',
        'updated_at'
    ];

    // Thêm chi tiết Đơn Hàng
    public function add_new($order_id, $product_id, $quantity)
    {
        $new = new OrderDetail();
        $new->order_id = $order_id;
        $new->product_id = $product_id;
        $new->quantity = $quantity;
        $new->created_at = strtotime(date('Y-m-d H:i:s'));
        $new->updated_at = strtotime(date('Y-m-d H:i:s'));
        $new->save();
    }

// Hiển Thị Chi Tiết Đơn Hàng
    public function order_detail($order_id)
    {
        $detail = OrderDetail::join('orders', 'orders.id', 'order_details.order_id')
            ->join('attribute_product_options', 'attribute_product_options.id', 'order_details.product_id')
            ->join('products', 'products.id', 'attribute_product_options.product_id')
            ->select('orders.*', 'order_details.*', 'attribute_product_options.*', 'products.name as productName')
            ->where('order_id', '=', $order_id)
            ->get();
        return $detail;
    }

    public function get_all()
    {
        $detail = OrderDetail::join('orders', 'orders.id', 'order_details.order_id')
            ->join('attribute_product_options', 'attribute_product_options.id', 'order_details.product_id')
            ->select('orders.*', 'order_details.*', 'attribute_product_options.*')
            ->get();
        return $detail;
    }

    public function get_with_order_id($order_id){
        $detail = OrderDetail::select('order_details.*')
            ->where('order_id', '=', $order_id)
            ->get();
        return $detail;
    }
}
