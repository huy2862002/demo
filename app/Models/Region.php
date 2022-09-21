<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $table = 'region';
    protected $fillable = [
        'name',
        'created_at',
        'updated-at'
    ];

    public function get_all(){
        $all = Region::select('region.*')
            ->get();
        return $all;
    }
}
