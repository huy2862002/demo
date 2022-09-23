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
    public function add_new($user_name, $phone_number, $email, $address, $total)
    {
        $new = new Order();
        $new->user_name = $user_name;
        $new->phone_number = $phone_number;
        $new->email = $email;
        $new->region_id = $address['region_id'];
        $new->province_id = $address['province_id'];
        $new->district_id = $address['district_id'];
        $new->address = $address['address'];
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
        dd($order);
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


    public function get_with_gmail($gmail)
    {
        $orders = Order::join('district', 'district.id', 'orders.district_id')
            ->join('province', 'province.id', 'orders.province_id')
            ->select('orders.*', 'province.name as provinceName', 'district.name as disName')
            ->where('email', '=', $gmail)
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

    public function  get_with_id($id)
    {
        $orders = Order::join('district', 'district.id', 'orders.district_id')
            ->join('province', 'province.id', 'orders.province_id')
            ->select('orders.*', 'province.name as provinceName', 'district.name as disName', 'district.type as districtType', 'province.type as provinceType')
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
