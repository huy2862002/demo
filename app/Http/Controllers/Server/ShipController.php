<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use App\Imports\ShipsImport;
use App\Models\Ship;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ShipController extends Controller
{
    //
    public function list()
    {
        $new_ship = new Ship();
        $ship_list = $new_ship->list();
        return view('server.shipfee.list', [
            'ship_list' => $ship_list
        ]);
    }

    public function addForm()
    {
        return view('server.shipfee.add');
    }

    public function import(Request $request)
    {
        $path = $request->file;
        $accept = ['xlsx'];
        $fileExtension = $path->getClientOriginalExtension();
        if (!in_array($fileExtension, $accept)) {
            return redirect()->route('server.ship.addForm')->with('error', 'Chỉ chấp nhận file excel (.xlsx) !');
        }
        Excel::import(new ShipsImport, $path);
        return redirect()->route('server.ship.list')->with('success', 'Thêm mới thành công !');
    }
}
