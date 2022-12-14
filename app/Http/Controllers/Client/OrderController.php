<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\AttributeOption;
use App\Models\AttributeProductOption;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Ship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class OrderController extends Controller
{
    //
    public function checkout(Request $request)
    {
        $new_address = new Address();
        $new_order = new Order();
        $new_detail = new OrderDetail();
        if ($request->address_id) {
            $old_address = $new_address->get_address_with_id($request->address_id);
            $address = $old_address;
        } else {
            $address = [
                'region_id' => $request->region_id,
                'province_id' => $request->province_id,
                'district_id' => $request->district_id,
                'address' => $request->address
            ];
            if (Auth::check()) {
                $user_id = Auth::user()->id;
                $old_address = $new_address->get_address_with_user($user_id);
                if(!$old_address){
                    $new_address->add_new($user_id, $address);
                }else{
                    $new_address->update_address($old_address, $address);
                }
            }
        }
        $total_money = $request->total;
        $id = $new_order->add_new($request->user_name, $request->phone_number, $request->email, $address, $total_money);

        foreach (session('cart') as $item) {
            $new_detail->add_new($id, $item['id'], $item['quantity']);
        }
        return redirect()->route('payment', $id);
    }


    public function payment(Order $order)
    {
        $new_order = new Order();
        $new_detail = new OrderDetail();
        $address = $new_order->get_with_id($order->id);
        $detail = $new_detail->order_detail($order->id);
        return view('client.order.payment',[
            'detail'=>$detail,
            'order'=>$order,
            'address'=>$address
        ]);
    }

    public function list()
    {
        $new_order = new Order();
        if(Auth::check()){
            $list_order = $new_order->get_with_gmail(Auth::user()->email);
        }else{
            $list_order = null;
        }
        return view('client.order.list', [
            'list_order'=>$list_order,
        ]);
    }

    public function cancel(Order $order){
        $order->status = 4;
        $order->save();
        return redirect()->back();
    }

    public function detail(Order $order){
        $new_detail = new OrderDetail();
        $detail = $new_detail->order_detail($order->id);
        $new_att_opt = new AttributeOption();
        $att_opt = $new_att_opt->get_all();
       return view('client.order.detail',[
           'detail'=>$detail,
           'att_opt'=>$att_opt
       ]);
    }
}
