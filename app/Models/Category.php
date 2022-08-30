<?php

namespace App\Models;

use App\Http\Controllers\common\DeQuyController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = FALSE;
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'parent_id',
        'ngaytao',
        'ngayCapNhat'
    ];
    // Thêm Mới Danh Mục
    public function add_new($name, $parent_id)
    {
        $new = new Category();
        $new->name = $name;
        $new->parent_id = $parent_id;
        $new->ngayTao = strtotime(date('Y-m-d H:i:s'));
        $new->ngayCapNhat = strtotime(date('Y-m-d H:i:s'));
        $new->save();
    }
    // Update Danh Mục
    public function update_category($category, $name, $parent_id)
    {
        $category->name = $name;
        $category->parent_id = $parent_id;
        $category->ngayCapNhat = strtotime(date('Y-m-d H:i:s'));
        $category->save();
    }

    // Xóa Danh Mục
    public function delete_category($category)
    {
        $new_deQuy = new DeQuyController();
        $get_where = $this->get_all();
        $data_rank = $new_deQuy->data_rank_select($get_where, $category->id);
        foreach ($data_rank as $item) {
            $item->delete();
        }
    }
    // Lấy ra tất cả
    public function get_all()
    {
        $all = Category::select('categories.*')->get();
        return $all;
    }
    // Lấy ra danh sách có chung parent_id
    public function get_where_parent_id($parent_id)
    {
        $all = Category::select('categories.*')
            ->where('parent_id', '=', $parent_id)
            ->get();
        return $all;
    }
    // Lấy ra danh sách danh mục khác 1 id
    public function get_other($category_id)
    {
        $all = Category::select('categories.*')
            ->where('id', '!=', $category_id)
            ->get();
        return $all;
    }
    // Xóa các bản ghi
    public function del_arr($category_id)
    {
        $all = Category::select('categories.*')
            ->whereIn('id', '=', $category_id)
            ->delete();
        return $all;
    }

    public function select_id_or_parent($id)
    {
        $all = Category::select('categories.*')
            ->where('id', '=', $id)
            ->orWhere('parent_id', '=', $id)
            ->get();
        return $all;
    }
}
