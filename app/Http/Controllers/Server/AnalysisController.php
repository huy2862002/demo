<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AnalysisController extends Controller
{
    //
    public function order()
    {
        $new_order = new Order();
        $approval = $new_order->get_count_order_by_status(0);
        $prepare = $new_order->get_count_order_by_status(1);
        $delivering = $new_order->get_count_order_by_status(2);
        $success = $new_order->get_count_order_by_status(3);
        $cancel = $new_order->get_count_order_by_status(4);
        return view('server.analysis.order', [
            'approval' => $approval,
            'prepare' => $prepare,
            'delivering' => $delivering,
            'success' => $success,
            'cancel' => $cancel
        ]);
    }
}
