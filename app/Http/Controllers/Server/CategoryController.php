<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\common\DeQuyController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list()
    {
        $new_category = new Category();
        $new_deQuy = new DeQuyController();
        $all = $new_category->get_all();
        $list_category = $new_deQuy->data_rank($all, 0, 0);
        return view('server.category.list', [
            'list_category' => $list_category
        ]);
    }

    public function delete(Category $category)
    {
        $new_product = new Product();
        $new_category = new Category();
        $category_with_parent_id = $new_category->get_where_parent_id($category->id);
        if (count($category_with_parent_id) > 0) {
            foreach ($category_with_parent_id as $item) {
                $item->parent_id = 0;
                $item->save();
            }
        }
        $product_with_category_id = $new_product->get_with_category_id($category->id);
        if (count($product_with_category_id) > 0) {
            foreach ($product_with_category_id as $item) {
                $item->delete();
            }
        }
        $category->delete();
        return redirect()->route('server.category.list')->with('success', 'Delete Successfully !');
    }

    public function addForm()
    {
        $new_category = new Category();
        $new_deQuy = new DeQuyController();
        $all = $new_category->get_all();
        $list_category = $new_deQuy->data_rank($all, 0, 0);
        return view('server.category.add', [
            'list_category' => $list_category
        ]);
    }

    public function postAdd(Request $request)
    {
        $new_category = new Category();
        $new_category->add_new($request->name, $request->parent_id);
        return redirect()->route('server.category.list')->with('success', 'Add Successfully !');
    }

    public function editForm(Category $category)
    {
        $new_category = new Category();
        $new_deQuy = new DeQuyController();
        $category_other = $new_category->get_other($category->id);
        $list_category = $new_deQuy->data_rank($category_other, 0);
        return view('server.category.edit', [
            'data_category' => $list_category,
            'category' => $category,
        ]);
    }

    public function putEdit(Category $category, Request $request)
    {
        $new_category = new Category();
        $new_category->update_category($category, $request->name, $request->parent_id);
        return redirect()->route('server.category.list')->with('success', 'Update Successfully !');
    }
}
