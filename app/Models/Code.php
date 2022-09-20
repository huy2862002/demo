<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'discount_code';
    protected $fillable = [
        'discount',
        'code',
        'quantity',
        'start',
        'end'
    ];

    public function check_code($code){
        $code = Code::select('discount_code.*')
            ->where('code', '=', $code)
            ->first();
        return $code;
    }

    public function add_new($code, $discount,$quantity, $start, $end){
        $new = new Code();
        $new->code = $code;
        $new->discount = $discount;
        $new->quantity = $quantity;
        $new->start = $start;
        $new->end = $end;
        $new->save();
    }
}
