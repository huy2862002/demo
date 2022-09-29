<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use App\Models\Code;
use App\Models\Order;
use Illuminate\Http\Request;

class CodeController extends Controller
{
    //
    public function list()
    {
        $new_Order = new Order();
        $code_list = $new_Order->code_list();
        return view('server.code.list', [
            'code_list' => $code_list
        ]);
    }

    public function addForm()
    {
        return view('server.code.add');
    }

    public function postAdd(Request $request){
        $new_code = new Code();
        $check = $new_code->check_code($request->code);
        if($check){
            return redirect()->route('server.code.addForm')->with('error', 'Mã Code Đã Tồn Tại');
        }
        $start =  strtotime($request->start);
        $end =   strtotime($request->end);

       $new_code->add_new($request, $start, $end);
        return redirect()->route('server.code.addForm')->with('success', 'Add Successfully !');
    }

    public function delete(Code $code){
        $code->delete();
        return redirect()->back()->with('success', 'Delete Successfully !');
    }
}
