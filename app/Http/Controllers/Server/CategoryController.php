<?php

namespace App\Http\Controllers\Server;

use App\Exports\CategoriesExport;
use App\Http\Controllers\common\DeQuyController;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Imports\CategoriesImport;
use App\Models\Category;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{
    //
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
        $new_category = new Category();
        $new_category->delete_category($category);
        return redirect()->route('server.category.list')->with('success', 'Xóa Thành Công !');
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

    public function postAdd(CategoryRequest $request)
    {
        $new_category = new Category();
        $new_category->add_new($request->name, $request->parent_id);
        return redirect()->route('server.category.list')->with('success', 'Thêm Mới Thành Công !');
    }

    public function editForm(Category $category)
    {
        $new_category = new Category();
        $new_deQuy = new DeQuyController();
        $category_other = $new_category->get_other($category->id);
        $list_category = $new_deQuy->data_rank($category_other, 0);
        return view('server.category.edit', [
            'data_category' =>  $list_category,
            'category' => $category,
        ]);
    }

    public function putEdit(Category $category, CategoryRequest $request)
    {
        $new_category = new Category();
        $new_category->update_category($category, $request->name, $request->parent_id);
        return redirect()->route('server.category.list')->with('success', 'Cập Nhật Thành Công !');
    }
    public function export() 
    {
        return Excel::download(new CategoriesExport, 'categories.xlsx');
    }
    public function import(Request $request) 
    {
        $path = $request->file;
        Excel::import(new CategoriesImport, $path);
        return redirect()->route('server.category.list');
    }
}
