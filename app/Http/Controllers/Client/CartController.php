<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\checkOutRequest;
use App\Models\Address;
use App\Models\AttributeOption;
use App\Models\AttributeProduct;
use App\Models\AttributeProductOption;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Region;
use App\Models\Ship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
        } else {
            $variant = $product;
        }

        if($request->quantity){
            $qty = $request->quantity;
        }else{
            $qty =1;
        }
        $new_cart->addCart($variant, $qty);
        return redirect()->route('showCart')->with('success', 'The product has been added to cart !');
    }

    public function showCart()
    {
        $new_region = new Region();
        $new_address = new Address();
        $new_ship = new Ship();
        $regions = $new_region->get_all();

        if (Auth::check()) {
            $user = Auth::user();
            $address_user = $new_address->get_address_with_user($user->id);
            if($address_user){
                $address = $address_user;
                $ship_fee = $new_ship->ship_fee($address_user->district_id)->ship_fee;
            }else{
                $address = '';
                $ship_fee = '';
            }

        } else {
            $user = [];
            $address = session()->get('address') ? session()->get('address') : '';
            $ship_fee = session()->get('address') ? $new_ship->ship_fee(session()->get('address')->district_id)->ship_fee : '';
        }
        $new_cart = new Cart();
        $new_att_opt = new AttributeOption();
        $att_opt = $new_att_opt->get_all();
        $total = $new_cart->get_total(session()->get('cart'));
        return view('client.cart.show', [
            'regions' => $regions,
            'user' => $user,
            'address' => $address,
            'ship_fee' => $ship_fee,
            'total' => $total,
            'att_opt' => $att_opt,
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
}
