<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Rating extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'ratings';
    protected $fillable = [
        'user_name',
        'product_id',
        'phone_number',
        'star',
        'content',
        'created_at',
        'updated_at',
    ];

    public function add_new($request)
    {
        $new = new Rating();
        $new->product_id = $request->product_id;
        $new->user_name = $request->name;
        $new->phone_number = $request->phone;
        $new->star = $request->star;
        $new->content = $request->content;
        $new->created_at = strtotime(date('Y-m-d H:i:s'));
        $new->updated_at = strtotime(date('Y-m-d H:i:s'));
        $new->save();
    }

    public function get_w_product_id($product_id){
        $data = Rating::select('ratings.*')->where('product_id', $product_id)
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();
        return $data;
    }

    public function get_count($product_id){
        $data = Rating::where('product_id', $product_id)
            ->count();
        return $data;
    }

    public function sum_star($product_id){
        $data = DB::table('ratings')
                ->select( DB::raw('SUM(star) as total_star'))
                ->first();
        return $data;
    }
}
