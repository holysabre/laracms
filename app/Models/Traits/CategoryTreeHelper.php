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

    public static function getCategoryTree()
    {
        $category_list = session('category_list');

        if(!$category_list){
            $categories = Category::query()->select('*')
                ->where('status',1)
                ->orderBy('order','asc')
                ->get()->toArray();

            $category_list = getSonTree($categories);
            session('category_list',$category_list);
        }

        return $category_list;
    }

    /**
     * @param int $module_id 模块id
     * @return array
     * 获取分类树
     */
    public function getCategoryOptionsTree($module_id = 0)
    {
        $query = Category::query()->select('id','parent_id','name')
            ->where('status','=',1);
        if($module_id){
            $query->where('module_id','=',$module_id);
        }
        $categories = $query->get()->toArray();

        $lists = getTreeByRecursion($categories, 0);

        $options = [
            '0' => '顶级栏目',
        ];

        foreach ($lists as $key=>$value){
            $options[$value['id']] = $value['text'];
        }

        return $options;
    }

    public static function getIds($id)
    {
        $categories = Category::query()->select('id','parent_id')
            ->where('status',1)
            ->get()->toArray();
        $ids = getSonIds($id,$categories);
        return $ids;
    }
}