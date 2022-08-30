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
                'avatar' => $product->avatar,
                'price' => $product->price,
                'quantity' => $quantity,
            ];
        }
        session()->put('cart', $cart);
    }

    public function get_total()
    {
        $totalMoney = 0;
        if (session()->get('cart') != null) {
            foreach (session()->get('cart') as $item) {
                $totalMoney += $item['price'] * $item['quantity'];
            };
        }
        return $totalMoney;
    }
}