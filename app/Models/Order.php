<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'status',
    ];

    // Thêm đon hàng
    public function add_new($user_name, $phone_number, $region_id, $province_id, $district_id, $address,)
    {
        $new = new Order();
        $new_cart = new Cart();
        $new->user_name = $user_name;
        $new->phone_number = $phone_number;
        $new->region_id = $region_id;
        $new->province_id = $province_id;
        $new->district_id = $district_id;
        $new->address = $address;
        $new->status = 0;
        $new->total_money = $new_cart->get_total();
        $new->ngayTao = strtotime(date('Y-m-d H:i:s'));
        $new->ngayCapNhat = strtotime(date('Y-m-d H:i:s'));
        $new->save();
        return $new->id;
    }

    // Lấy ra thông tin đơn hàng theo số điện thoại
    public function order_detail($id){
        $details = Order::join('order_details', 'order_details.order_id', 'orders.id')
        ->join('products', 'products.id', 'order_details.product_id')
        ->select('products.name as proName', 'order_details.quantity as quantity', 'orders.total_money as $total')
        ->whereIn('orders.id', '=', $id)
        ->get();
    }
}
