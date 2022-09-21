<?php

namespace App\Http\Controllers\common;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\AttributeProduct;
use App\Models\Category;
use Illuminate\Http\Request;

class DeQuyController extends Controller
{
    //
    public function data_rank($data, $parent_id = 0, $level = 0) //
    {
        $result = [];
        foreach ($data as $item) {
            if ($item['parent_id'] == $parent_id) {
                $result[] = $item;
                $item['level'] = $level;
                $child = $this->data_rank($data, $item['id'], $level + 1);
                $result = array_merge($result, $child);
            }
        }
        return $result;
    }

    public function data_rank_select($data, $parent_id = 0, $level = 0)
    {
        $result = [];
        foreach ($data as $item) {
            if ($item['id'] == $parent_id) {
                $result[] = $item;
                $item['level'] = $level;
            }
            if ($item['parent_id'] == $parent_id) {
                $child = $this->data_rank_select($data, $item['id'], $level + 1);
                $result = array_merge($result, $child);
            }
        }
        return $result;
    }

    public function data_attribute($input, $id)
    {
        $new_att_product = new AttributeProduct();
        $att = $new_att_product->get_where_product_id($id); // Lấy ra toàn bộ thuộc tính

        foreach ($att as $item) {
            $name = $item->attName;
                if($input->$name && $input->$name != null){
                    $opt[] = $input->$name;
                }else{
                    return false;
                }
        }
        $count_att = $new_att_product->get_count($id);
        $count = count($opt);
        $i = 0;
        if($count == 1){
            foreach ($opt[$i] as $item) {
                $result[] = $item.'';
            }
        }
        if($count == 2){
            foreach ($opt[$i] as $item1) {
                foreach ($opt[$i + 1] as $item2) {
                            $result[] = $item1 . ' ' . $item2;
                    }
                }
            }
        if($count == 3){
            foreach ($opt[$i] as $item1) {
                foreach ($opt[$i + 1] as $item2) {
                    foreach ($opt[$i + 2] as $item3) {
                        if ($item1 != $item2 && $item2 != $item3 && $item3 != $item1) {
                            $result[] = $item1 . ' ' . $item2 . ' ' . $item3;
                        }
                    }
                }
            }
        }
      return $result;
    }
}
