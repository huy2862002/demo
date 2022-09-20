<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class Cart extends Model
{
    use HasFactory;

    public function addCart($product, $quantity)
    {
        $cart = [];
        $cart = session()->get('cart');
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'image' => $product->image,
                'price' => $product->price,
                'price_discount' => $product->price_discount,
                'quantity' => $quantity,
                'option_id'=>$product->option_id
            ];
        }
        session()->put('cart', $cart);
    }

    public function get_total($session)
    {
        $totalMoney = 0;
        if ($session != null) {
            foreach ($session as $item) {
                $totalMoney += $item['price_discount'] * $item['quantity'];
            };
        }
        return $totalMoney;
    }

    public function save_order($avatar, $name, $price, $quantity, $id)
    {
        $order = [];
        $order =  session()->get('order');
        $info = [
            'avatar' => $avatar,
            'name' => $name,
            'price' => $price,
            'quantity' => $quantity,
        ];
        $order[$id] = $info;
        session()->put('order', $order);
    }
}
