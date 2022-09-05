<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function detail(Order $order)
    {
        $new_detail = new OrderDetail();
        $order_detail = $new_detail->order_detail($order->id);
        return view('client.order.detail', [
            'order_detail' => $order_detail,
            'order'=>$order
        ]);
    }

    public function cancelOrder(Order $order){
        $order->status = 4;
        $order->save();
        return redirect()->back();
    }
}
