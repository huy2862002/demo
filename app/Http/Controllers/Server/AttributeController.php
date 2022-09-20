<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\AttributeProductOption;
use App\Models\Product;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function list()// Danh sách thuộc tính
    {
        $new_att = new Attribute();
        $list_att = $new_att->get_all();
        return view('server.att.list', [
            'list_att' => $list_att
        ]);
    }

    public function delete(Attribute $att) //Xóa Thuộc tính
    {
        if ($att) {
            $att->delete();
            return redirect()->route('server.att.list')->with('success', 'Delete Successfully !');
        }
    }

    public function addForm() //Trả về giao diện thêm mới thuộc tính
    {
        return view('server.att.add');
    }

    public function postAdd(Request $request) //Nhận và xử lý form thêm mới thộc tính
    {
        $new_att = new Attribute();
        $new_att->add_new($request->att_name, $request->visual, $request->type);
        return redirect()->route('server.att.addForm')->with('success', 'Add Successfully !');
    }

    public function editForm(Attribute $att) //Nhận và xử lý form thêm mới thộc tính
    {
        return view('server.att.edit', [
            'att' => $att
        ]);
    }

    public function putEdit(Attribute $att, Request $request) //Nhận và xử lý form cập nhật thộc tính
    {
        $new_att = new Attribute();
        if ($att) {
            $new_att->update_info($att, $request->att_name, $request->visual, $request->type);
            return redirect()->route('server.att.editForm', $att->id)->with('success', 'Update Successfully !');
        }
    }

    public function option(Attribute $att)// Danh sách giá trị attribute
    {
        $new_att_opt = new AttributeOption();
        $att_opt = $new_att_opt->get_with_attribute_id($att->id);
        return view('server.att.option', [
            'opt' => $att_opt,
            'att' => $att
        ]);
    }

    public function delOption(AttributeOption $option) // Xóa giá trị attribute
    {
        if ($option) {
            $option->delete();
            return redirect()->route('server.att.option', $option->attribute_id)->with('success', 'Delete Successfully !');
        }
    }


}
