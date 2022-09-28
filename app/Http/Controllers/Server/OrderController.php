<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use App\Imports\ShipsImport;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Ship;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class OrderController extends Controller
{
    //


    public function list()
    {
        $new_order = new Order();
        $list_order = $new_order->get_all();
        return view('server.order.list', [
            'list_order' => $list_order
        ]);
    }

    public function detail(Order $order)
    {
        $new_detail = new OrderDetail();
        $order_detail = $new_detail->order_detail($order->id);
        return view('server.order.detail', [
            'order_detail' => $order_detail,
            'order' => $order
        ]);
    }

    public function delivering(Order $order)
    {
        $order->status = 2;
        $order->save();
        return redirect()->back();
    }
    public function reject(Order $order)
    {
        $order->status = 5;
        $order->save();
        return redirect()->back();
    }
    public function success(Order $order)
    {
        $order->status = 3;
        $order->save();
        return redirect()->back();
    }



}
