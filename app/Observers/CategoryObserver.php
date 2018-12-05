<?php
/**
 * Created by PhpStorm.
 * User: yingwenjie
 * Date: 2018/11/20
 * Time: 3:03 PM
 */
namespace App\Observers;

use App\Models\Category;

class CategoryObserver
{

    public function saved(Category $category)
    {
        if(empty($category->index_template) && empty($category->detail_template)){
            $category->index_template = $category->module->index_template;
            $category->detail_template = $category->module->detail_tempalte;
            $category->save();
        }
//        logger('===CategoryObserver--saved--category==='.print_r($category->module,1));
    }

}