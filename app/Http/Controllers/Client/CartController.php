<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\checkOutRequest;
use App\Models\Address;
use App\Models\AttributeOption;
use App\Models\AttributeProduct;
use App\Models\AttributeProductOption;
use App\Models\Cart;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Province;
use App\Models\Region;
use App\Models\Ship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public function addToCart(Product $product, Request $request)
    {
        $new_att_product = new AttributeProduct();
        $new_opt_product = new AttributeProductOption();
        $new_cart = new Cart();
        $att_product = $new_att_product->get_where_product_id($product->id);
        $option_id = [];
        if (count($att_product) > 0) {
            foreach ($att_product as $item) {
                $name = $item->attName;
                if ($request->$name) {
                    $option_id[] = $request->$name;
                }
            }
        }
        if (count($option_id) > 0) {
            $variant = $new_opt_product->get_where_opt($product->id, implode(' ', $option_id));

        }else{
            $variant = $product;
        }

        $new_cart->addCart($variant, $request->quantity);
        return redirect()->route('showCart')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng');
    }

    public function showCart()
    {
        $new_region = new Region();
        $new_province = new  Province();
        $new_district = new District();
        $new_address = new Address();

        $regions = $new_region->get_all();
        $provinces = $new_province->get_all();
        $districts = $new_district->get_all();

        if(Ath::check()){
            $full_name = Auth::user()->name;
            $phone_number = Auth::user()->phone_number;
        }else{
            $full_name = '';
            $phone_number = '';
        }
        $new_cart = new Cart();

        $new_att_opt = new AttributeOption();

        $att_opt = $new_att_opt->get_all();
        $new_ship = new Ship();


        $total = $new_cart->get_total(session()->get('cart'));
        return view('client.cart.show', [
            'regions' => $regions,
            'provinces' => $provinces,
            'districts' => $districts,

            'total' => $total,
            'att_opt'=>$att_opt,

        ]);
    }

    public function delCart($id)
    {
        $oldCart = session()->get('cart') ? session()->get('cart') : null;
        $new_cart = [];
        if (!session()->get('cart')) {
            return redirect()->route('home');
        }
        foreach ($oldCart as $item) {
            if ($item['id'] != $id) {
                $cart = $item;
                $new_cart[$item['id']] = $cart;
            }
            session()->forget('cart');
        }
        session()->put('cart', $new_cart);
        return redirect()->back();
    }

    public function checkout(Request $request)
    {
        $new_address = new Address();
        $new_order = new Order();
        $new_cart = new Cart();
        $new_ship = new Ship();
        $new_detail = new OrderDetail();
        if ($request->address_id) {
            $old_address = $new_address->get_address_with_id($request->address_id);
            $region_id = $old_address->region_id;
            $province_id = $old_address->province_id;
            $district_id = $old_address->district_id;
            $address = $old_address->address;
        } else {
            $region_id = $request->region_id;
            $province_id = $request->province_id;
            $district_id = $request->district_id;
            $address = $request->address;
            if (Auth::check()) {
                $user_id = Auth::user()->id;
                $new_address->add_new($user_id, $region_id, $province_id, $district_id, $address);
            }
        }

        $total = $new_cart->get_total(session()->get('cart'));
        $ship = 20000;
        $total_money = $total + $ship;
        $id = $new_order->add_new($request->user_name, $request->phone_number, $request->email, $region_id, $province_id, $district_id, $address, $total_money);

        foreach (session('cart') as $item) {
            $new_detail->add_new($id, $item['id'], $item['quantity']);
        }

        Cookie::queue('total', $total_money, 20);

        return redirect()->route('payment', $id);
    }

    public function payment($id)
    {
        $new_order = new Order();
        $order = Order::find($id);
        $new_ship = new Ship();
        $address = $new_order->get_order_with_id($id);
        $ship = 20000000;
        $detail = $new_order->get_detail_by_order_id($id);
        return view('client.order.payment', [
            'detail' => $detail,
            'ship' => $ship,
            'address' => $address,
            'order' => $order
        ]);
    }

    public function order()
    {
        if (Auth::check()) {
            $gmail = Auth::user()->email;
        } else {
            $gmail = '';
        }
        $new_order = new Order();
        $delivering = $new_order->get_order_by_gmail_delivering($gmail);
        $processing = $new_order->get_order_by_gmail_processing($gmail);
        $payment = $new_order->get_order_by_gmail_payment($gmail);
        $cancel = $new_order->get_order_by_gmail_cancel($gmail);
        return view('client.order.list', [
            'delivering' => $delivering,
            'processing' => $processing,
            'payment' => $payment,
            'cancel' => $cancel
        ]);
    }


}
