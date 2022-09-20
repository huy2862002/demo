<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeOption;
use Illuminate\Http\Request;

class AttributeController extends Controller
{

    public function delValueAtt(Request $request)
    {
        $att_opt = AttributeOption::find($request->id);
        $att_opt->delete();
        return response()->json([
            'data' => $att_opt,
            'status' => 200
        ]);
    }
    public function addOption(Request $request){
        $new_att_opt = new AttributeOption();
        if($request->value_color){
            $value = $request->value_color;
        }
        if($request->value_text){
            $value = $request->value_text;
        }
        if($request->value_image){
            request()->validate([
                'value_image'  => 'required|mimes:jpg,png,jpeg|max:2048',
            ]);
            $file = $request->value_image->store('images/products');
            $value = $file;
        }
        $new = $new_att_opt->add_new($request->att_id, $request->label_add, $value);
        return response()->json([
            'data'=>$new,
            'status'=>200
        ]);
    }
}
