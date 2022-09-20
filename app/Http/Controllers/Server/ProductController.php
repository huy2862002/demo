<?php

namespace App\Http\Controllers\Server;

use App\Exports\ProductsExport;
use App\Http\Controllers\common\DeQuyController;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\AttributeProduct;
use App\Models\AttributeProductOption;
use App\Models\Category;
use App\Models\ConfigProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function list() // Danh sách sản phẩm
    {
        $new_product = new Product();
        $new_category = new Category();
        $new_deQuy = new DeQuyController();
        $list_product = $new_product->get_all();
        $list_category = $new_category->get_all();
        $data_category = $new_deQuy->data_rank($list_category, 0);
        return view('server.product.list', [
            'data_category' => $data_category,
            'list_product' => $list_product
        ]);
    }

    public function addForm() // Form thêm mới sản phẩm
    {
        $new_category = new Category();
        $new_deQuy = new DeQuyController();
        $list_category = $new_category->get_all();
        $data_category = $new_deQuy->data_rank($list_category, 0);
        return view('server.product.add', [
            'data_category' => $data_category,
        ]);
    }

    public function postAdd(Request $request) // Request form thêm mới sản phẩm
    {
        $new_product = new Product();
        $new_product->add_new($request->name, $request->slug, $request->category_id, $request->image, $request->price, $request->price_discount, $request->inventory, $request->short_description, $request->product_description);
        return redirect()->route('server.product.addForm')->with('success', 'Add Successfully !');
    }

    public function editForm(Product $product) //Form cập nhật sản phẩm
    {
        $new_category = new Category();
        $new_deQuy = new DeQuyController();
        $list_category = $new_category->get_all();
        $data_category = $new_deQuy->data_rank($list_category, 0);
        return view('server.product.edit', [
            'data_category' => $data_category,
            'product' => $product,
        ]);
    }

    public function putEdit(Product $product, Request $request)//Request form cập nhật sản phẩm
    {
        $new_product = new Product();
        $new_product->update_info($product, $request->name, $request->slug, $request->category_id, $request->image_update, $request->price, $request->price_discount, $request->inventory, $request->short_description, $request->product_description);
        return redirect()->route('server.product.editForm', $product->id)->with('success', 'Update Successfully !');
    }

    public function delete(Product $product) // Xóa sản phẩm theo id
    {
        $product->delete();
        return redirect()->route('server.product.list')->with('success', 'Delete Successfully !');
    }


    public function addAttribute(Product $product) // Thêm biến thể sản phẩm
    {
        $new_att_product = new AttributeProduct();

        $new_att = new Attribute();
        $data_att_product = $new_att_product->get_where_product_id($product->id);
        $data_att = $new_att->get_all();
        $attribute_id = [];
        if (count($data_att_product) > 0) {
            foreach ($data_att_product as $item) {
                $attribute_id[] = $item->attribute_id;
            }
            $att_other = $new_att->get_where_notin($attribute_id);
        } else {
            $att_other = $data_att;
        }
        return view('server.product.addAttribute', [
            'att_other' => $att_other,
            'data_att_product' => $data_att_product,
            'product' => $product
        ]);
    }

    public function postAddAttribute(Product $product, Request $request)
    {
        $new_att_product = new AttributeProduct();
        if ($request->att) {
            foreach ($request->att as $item) {
                $new_att_product->add_new($item, $product->id);
            }
        }
        return redirect()->route('server.product.addAttribute', $product->id)->with('success','Add Successfully !');

    }
    public function delAttribute(AttributeProduct $attributeProduct)
    {
        $attributeProduct->delete();
        return redirect()->back()->with('success','Delete Successfully !');
    }

    public function addVariant(Product $product)
    {
        $new_att_product = new AttributeProduct();
        $new_att_opt = new AttributeOption();
        $new_opt_product = new AttributeProductOption();
        $data_att_opt = $new_att_opt->get_all();
        $data_att_product = $new_att_product->get_where_product_id($product->id);
        $data_opt_product = $new_opt_product->get_where_product_id($product->id);
        return view('server.product.addVariant', [
            'product' => $product,
            'data_att_product'=>$data_att_product,
            'data_att_opt'=>$data_att_opt,
            'data_opt_product'=>$data_opt_product
        ]);
    }

    public function postAddVariant(Product $product, Request $request){
       $new_deQuy = new DeQuyController();
       $new_opt_product = new AttributeProductOption();
       $variant = $new_deQuy->data_attribute($request, $product->id);
       if($variant == false){
           return redirect()->route('server.product.addVariant', $product->id)->with('error','Mỗi thuộc tính cần chọn 1 giá trị !');
       }else{
           foreach ($variant as $item){
               $new_opt_product->add_new($product->id, $item);
           }
           return redirect()->route('server.product.addVariant', $product->id)->with('success','Tạo biến thể thành công !');
       }
    }


}
