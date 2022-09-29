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
        'type',
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

    public function code_order($id){
        $code = Code::select('discount_code.*')
            ->where('id', '=', $id)
            ->first();
        return $code;
    }

    public function add_new($request, $start, $end){
        $new = new Code();
        $new->code = $request->code;
        $new->discount = $request->discount;
        $new->quantity = $request->quantity;
        $new->type = $request->type;
        $new->start = $start;
        $new->end = $end;
        $new->save();
    }

}
