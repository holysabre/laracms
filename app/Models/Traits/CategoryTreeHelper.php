<?php
/**
 * Created by PhpStorm.
 * User: yingwenjie
 * Date: 2018/11/20
 * Time: 10:18 AM
 */

namespace App\Models\Traits;

use App\Models\Category;

trait CategoryTreeHelper
{

    public function __construct()
    {

    }

    public function getCategoryOptions()
    {
        $categories = Category::query()->select('id', 'name as text')
            ->where('status','=',1)
            ->get();

        $lists = [];

        foreach ($categories as $category) {
            $lists[$category->id] = $category->text;
        }

        $this->categories = $lists;

        return $lists;
    }

//    public function isSelf($id)
//    {
//        $categoies = listKey(Category::all()->toArray());
//        return $categoies;
//    }

}