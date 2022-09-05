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
            'order'=>$order
        ]);
    }

    public function export(Order $order){
        $new_detail = new OrderDetail();
        $order_detail = $new_detail->order_detail($order->id);
        $data = [
            'title' => 'Thank you for shopping at QWERTY Shop !',
            'info' => $order_detail ,
            'order' =>$order
        ];
        
        $pdf = PDF::loadView('server.order.exportPDF', $data);
      
    
        return $pdf->stream('hoa-don.pdf');
    }

    public function ship_list(){
        $new_ship = new Ship();
        $ship_list = $new_ship->ship_list();
        return view('server.order.ship_list',[
            'ship_list'=>$ship_list
        ]);
    }

    public function add_ship(){
        return view('server.order.add_ship');
    }

    public function import_ship(Request $request)
    {
        $path = $request->file;
        $accept = ['xlsx'];
        $fileExtension = $path->getClientOriginalExtension();
        if(!in_array($fileExtension, $accept)){
            return redirect()->route('server.ship.addForm')->with('error', 'Chỉ Chấp Nhận File Excel (.xlsx) !');
        }

        Excel::import(new ShipsImport, $path);
        return redirect()->route('server.ship.list');
    }
}
