<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartApiController extends Controller
{
    //
    public function updateQtyCart(Request $request)
    {
        $oldCart = session()->get('cart');
        foreach (session()->get('cart') as $item){
            $a = $item;
        }
        return response()->json([
            'data' => $a ,
            'status' => 200
        ]);
    }
}
