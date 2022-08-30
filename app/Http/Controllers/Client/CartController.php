<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

// use Session;

class CartController extends Controller
{
    //
    public function addToCart(Product $product, Request $request)
    {
        if ($request->quantity) {
            $quantity = $request->quantity;
        } else {
            $quantity = 1;
        }
        $new_cart = new Cart();
        $new_cart->addCart($product, $quantity);

        return redirect()->route('showCart');
    }

    public function showCart()
    {
        $new_cart = new Cart();

        $total = $new_cart->get_total();
        return view('client.cart.show', [
            'total' => $total,

        ]);
    }

    public function delCart(OrderDetail $orderDetail)
    {
    }

    public function checkOut()
    {
        $new_cart = new Cart();
        $new_address = new Address();

        if (Auth::check()) {
            $address = $new_address->get_address(Auth::user()->id);
        } else {
            $address = [];
        }
        $provinces = $new_address->get_province();
        $districts = $new_address->get_district();

        $total = $new_cart->get_total();
        return view('client.cart.checkOut', [
            'total' => $total,
            'address' => $address,
            'provinces' => $provinces,
            'districts' => $districts
        ]);
    }

    public function payment(Request $request)
    {
        $new_order = new Order();
        $new_detail = new OrderDetail();
        $id = $new_order->add_new($request->user_name, $request->phone_number, $request->region_id, $request->province_id, $request->district_id, $request->address);
        foreach (session()->get('cart') as $item) {
            $new_detail->add_new($id, $item['id'], $item['quantity']);
        }
        return redirect()->route('order');
    }

    public function order()
    {
        return view('client.order.list');
    }
}
