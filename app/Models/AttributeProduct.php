<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeProduct extends Model
{
    use HasFactory;

    public $timestamps = FALSE;
    protected $table = 'attribute_product';
    protected $fillable = [
        'attribute_id',
        'product_id',
        'created_at',
        'updated_at'
    ];

    public function get_where_product_id($id)
    {
        $get_where_product_id = AttributeProduct::join('attribute', 'attribute.id', 'attribute_product.attribute_id')
            ->select('attribute_product.*', 'attribute.name as attName', 'attribute.visual as visual', 'attribute.type as type')
            ->where('product_id', '=', $id)
            ->get();
        return $get_where_product_id;
    }

    public function add_new($att_id, $product_id)
    {
        $new = new AttributeProduct();
        $new->attribute_id = $att_id;
        $new->product_id = $product_id;
        $new->created_at = strtotime(date('Y-m-d H:i:s'));
        $new->updated_at = strtotime(date('Y-m-d H:i:s'));
        $new->save();
    }

    public function get_count($id)
    {
        $count = AttributeProduct::select('attribute_product.*')
            ->where('product_id', '=', $id)
            ->count();
        return $count;
    }
}
