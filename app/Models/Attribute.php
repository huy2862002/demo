<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    public $timestamps = FALSE;
    protected $table = 'attribute';
    protected $fillable = [
        'name',
        'visual',
        'type',
        'created_at',
        'updated_at'
    ];

    public function get_all()// Lấy tất các thuộc tính
    {
        $att = Attribute::select('attribute.*')
            ->paginate(12);
        return $att;
    }
    public function get_where_notin($att_id)// Lấy tất các thuộc tính khác attribute_id
    {
        $get_where_notin = Attribute::select('attribute.*')
            ->whereNotIn('id', $att_id)
            ->get();
        return $get_where_notin;
    }
    public function add_new($name, $visual, $type)//Thêm mới thuộc tính
    {
        $new = new Attribute();
        $new->name = $name;
        $new->visual = $visual;
        $new->type = $type;
        $new->created_at = strtotime(date('Y-m-d H:i:s'));
        $new->updated_at = strtotime(date('Y-m-d H:i:s'));
        $new->save();
    }

    public function update_info($att,$name, $visual, $type)//Thêm mới thuộc tính
    {
        $att->name = $name;
        $att->visual = $visual;
        $att->type = $type;
        $att->updated_at = strtotime(date('Y-m-d H:i:s'));
        $att->save();
    }
}
