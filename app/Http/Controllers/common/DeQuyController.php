<?php

namespace App\Http\Controllers\common;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class DeQuyController extends Controller
{
    //
    public function data_rank($data, $parent_id = 0, $level = 0)
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
}
