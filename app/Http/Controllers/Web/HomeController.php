<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $new_product = new Product();
        $new_user = new User();
        $count_product = $new_product->get_count();
        $count_user = $new_user->get_count();
        $latest_product = $new_product->get_latest();
        $popular_product = $new_product->get_popular();
        return view('web.home.index',[
            'count_product'=>$count_product,
            'count_user'=>$count_user,
            'latest_product'=>$latest_product,
            'popular_product'=>$popular_product,
        ]);
    }
}
