<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class IndexController extends Controller
{
    public function index()
    {
        $categories = Category::query()->select('id','parent_id','name')->get()->toArray();
//        $arr = arrayListKey($categories);
//        $children = getSonTree($arr);
//        $is_child = arrayIsChild($children,4);
        $ids = getSonIds(4,$categories);
        dump($ids);
    }
}
