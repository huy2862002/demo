<?php

namespace App\Http\Controllers\Server;

use App\Exports\ProductsExport;
use App\Http\Controllers\common\DeQuyController;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function list()
    {
        $new_product = new Product();
        $new_category = new Category();
        $new_deQuy = new DeQuyController();
        $list_product = $new_product->get_all();
        $list_category = $new_category->get_all();
        $data_category = $new_deQuy->data_rank($list_category, 0);
        return view('server.product.list', [
            'data_category' =>  $data_category,
            'list_product' => $list_product
        ]);
    }

    public function addForm()
    {
        $new_category = new Category();
        $new_deQuy = new DeQuyController();
        $list_category = $new_category->get_all();
        $data_category = $new_deQuy->data_rank($list_category, 0);
        return view('server.product.add', [
            'data_category' =>  $data_category
        ]);
    }

    public function postAdd(ProductRequest $productRequest)
    {
        $new_product = new Product();
        $new_product->add_new($productRequest->name, $productRequest->price, $productRequest->category_id, $productRequest->moTaNgan, $productRequest->moTaSP, $productRequest->avatar);
        return redirect()->route('server.product.list')->with('success', 'Thêm Mới Thành Công !');
    }

    public function editForm(Product $product)
    {
        $new_category = new Category();
        $new_deQuy = new DeQuyController();
        $list_category = $new_category->get_all();
        $data_category = $new_deQuy->data_rank($list_category, 0);
        return view('server.product.edit', [
            'data_category' =>  $data_category,
            'product' => $product,
        ]);
    }

    public function putEdit(Product $product, ProductRequest $productRequest)
    {
        $new_product = new Product();
        $new_product->update_product($product, $productRequest->name,$productRequest->price, $productRequest->category_id, $productRequest->moTaNgan, $productRequest->moTaSP, $productRequest->avatar);
        return redirect()->route('server.product.list')->with('success', 'Cập Nhật Thành Công !');
    }

    public function delete(Product $product)
    {
        $product->delete();
        return redirect()->route('server.product.list')->with('success', 'Xóa Thành Công !');
    }

    public function export()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }
}
