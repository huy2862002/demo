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
        'user_name',
        'phone_number',
        'email',
        'region_id',
        'province_id',
        'district_id',
        'address',
        'status',
        'total_money',
        'created_at',
        'updated_at',
        'discount'

    ];

    // Thêm đon hàng
    public function add_new($user_name, $phone_number, $email, $region_id, $province_id, $district_id, $address, $total)
    {
        $new = new Order();
        $new->user_name = $user_name;
        $new->phone_number = $phone_number;
        $new->email = $email;
        $new->region_id = $region_id;
        $new->province_id = $province_id;
        $new->district_id = $district_id;
        $new->address = $address;
        $new->status = 0;
        $new->total_money = $total;
        $new->created_at = strtotime(date('Y-m-d H:i:s'));
        $new->updated_at = strtotime(date('Y-m-d H:i:s'));
        $new->save();
        return $new->id;
    }


    public function success_payment($id)
    {
        $order = Order::find($id);
        $order->status = 1;
        $order->save();
    }
    // Lấy ra thông all đơn hàng
    public function get_all()
    {
        $orders = Order::join('province', 'province.id', 'orders.province_id')
            ->join('district', 'district.id', 'orders.district_id')
            ->select('orders.*', 'district.name as districtName', 'province.name as provinceName')
            ->paginate(8);
        return $orders;
    }

    public function get_count_order_by_status($status)
    {
        $count = Order::select('order.id')->where('status', '=', $status)->count();
        return $count;
    }

    public function get_detail_by_order_id($id)
    {
        $orders = Order::join('order_details', 'order_details.order_id', 'orders.id')
            ->join('products', 'products.id', 'order_details.product_id')
            ->select('products.avatar as proAvatar', 'products.name as proName', 'products.price as proPrice', 'order_details.quantity as quantity', 'orders.id as orderId')
            ->where('order_id', '=', $id)
            ->get();
        return $orders;
    }

    public function get_order_by_gmail_delivering($gmail)
    {
        $orders = Order::join('district', 'district.id', 'orders.district_id')
            ->join('province', 'province.id', 'orders.province_id')
            ->select('orders.*', 'province.name as provinceName', 'district.name as disName')
            ->where('email', '=', $gmail)
            ->where('status', '=', 2)
            ->get();
        return $orders;
    }

    public function  get_order_by_gmail_processing($gmail)
    {
        $orders = Order::join('district', 'district.id', 'orders.district_id')
            ->join('province', 'province.id', 'orders.province_id')
            ->select('orders.*', 'province.name as provinceName', 'district.name as disName')
            ->where('email', '=', $gmail)
            ->where('status', '=', 1)
            ->get();
        return $orders;
    }
    public function  get_order_by_gmail_payment($gmail)
    {
        $orders = Order::join('district', 'district.id', 'orders.district_id')
            ->join('province', 'province.id', 'orders.province_id')
            ->select('orders.*', 'province.name as provinceName', 'district.name as disName')
            ->where('email', '=', $gmail)
            ->where('status', '=', 0)
            ->get();
        return $orders;
    }
    // Lấy những đơn hàng đã hủy
    public function  get_order_by_gmail_cancel($gmail)
    {
        $orders = Order::join('district', 'district.id', 'orders.district_id')
            ->join('province', 'province.id', 'orders.province_id')
            ->select('orders.*', 'province.name as provinceName', 'district.name as disName')
            ->where('email', '=', $gmail)
            ->where('status', '=', 4)
            ->get();
        return $orders;
    }

    public function check($id)
    {
        $order = Order::select('orders.*')
            ->where('id', '=', $id)
            ->where('status', '=', 0)
            ->exists();
        return $order;
    }

    public function  get_order_with_id($id)
    {
        $orders = Order::join('district', 'district.id', 'orders.district_id')
            ->join('province', 'province.id', 'orders.province_id')
            ->select('orders.*', 'province.name as provinceName', 'district.name as disName')
            ->where('orders.id', '=', $id)
            ->first();
        return $orders;
    }

    public function discount_code($code){
        $end = strtotime(date('d-m-Y H:i:s'));
        $start = strtotime(date('d-m-Y H:i:s'));
        $code = Code::select('discount_code.*')
            ->where('code', '=', $code)
            ->where('end', '>=' ,$end)
            ->where('start', '<=' ,$start)
            ->where('quantity', '>', 0)
            ->first();
        return $code;
    }

    public function code_list(){
        $code = Code::select('discount_code.*')
            ->paginate(12);
        return $code;
    }





}
