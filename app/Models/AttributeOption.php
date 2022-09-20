<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeOption extends Model
{
    use HasFactory;

    public $timestamps = FALSE;
    protected $table = 'attribute_options';
    protected $fillable = [
        'attribute_id',
        'label',
        'value',
        'created_at',
        'updated_at'
    ];

    public function get_with_attribute_id($id) // Lấy option theo id thuộc tính
    {
        $opt = AttributeOption::select('attribute_options.*')
            ->where('attribute_id', '=', $id)
            ->get();
        return $opt;
    }


    public function add_new($att_id, $label, $value) // Thêm mới option thuộc tính
    {
        $new = new AttributeOption();
        $new->attribute_id = $att_id;
        $new->label = $label;
        $new->value = $value;
        $new->created_at = strtotime(date('Y-m-d H:i:s'));
        $new->updated_at = strtotime(date('Y-m-d H:i:s'));
        $new->save();
        return $new;
    }

    public function get_all() // Lấy ra tất cả giá trị thuộc tính
    {
        $opt = AttributeOption::select('attribute_options.*')
            ->get();
        return $opt;
    }

    public function att_product($id)
    {
        $att = AttributeProduct::join('attribute', 'attribute.id', 'attribute_product.attribute_id')
            ->select('attribute.name as attName', 'attribute_product.*')
            ->where('product_id', '=', $id)
            ->get();
        return $att;
    }
}
