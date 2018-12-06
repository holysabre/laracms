<?php
/**
 * Created by PhpStorm.
 * User: yingwenjie
 * Date: 2018/11/20
 * Time: 10:18 AM
 */

namespace App\Models\Traits;

use App\Models\Category;
use Cache;

trait CategoryTreeHelper
{

    // 缓存相关配置
    protected $cache_key;
    protected $cache_expire_in_minutes = 24 * 60;

    public function __construct()
    {
        $this->cache_key = config('static.session_key.category_list');
    }

    /**
     * @return array|\Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed
     * 缓存栏目
     */
    public function getList()
    {
         return Cache::remember($this->cache_key,$this->cache_expire_in_minutes,function (){
            $categories = Category::query()->select('*')
                ->where('status',1)
                ->orderBy('order','asc')
                ->get();
            return $categories;
        });
    }

    /**
     * @param $list
     * 加入缓存
     */
    public function cacheList($list)
    {
        Cache::put($this->cache_key,$list,$this->cache_expire_in_minutes);
    }

    /**
     * 刷新缓存
     */
    public function cacheFlush()
    {
        Cache::forget($this->cache_key);
        $this->getList();
    }

    /**
     * @return array|mixed
     * 栏目树
     */
    public function getTree()
    {
        $category_list = getSonTree($this->getList()->toArray());
        return $category_list;
    }

    /**
     * @param int $module_id 模块id
     * @param bool $first 模块id
     * @return array
     * 获取栏目select的options值
     */
    public function getOptions($module_id = 0,$first = true)
    {
        $query = Category::query()->select('id','parent_id','name')
            ->where('status','=',1);
        if($module_id){
            $query->where('module_id','=',$module_id);
        }
        $categories = $query->get()->toArray();

        $lists = getTreeByRecursion($categories, 0);

        $options = [];
        if($first){
            $options = [
                '0' => '顶级栏目',
            ];
        }

        foreach ($lists as $key=>$value){
            $options[$value['id']] = $value['text'];
        }

        return $options;
    }

    /**
     * @param $id
     * @return array
     * 获取指定id下的所有子id
     */
    public function getIds($id)
    {
        $ids = getSonIds($id,$this->getList()->toArray());
        return $ids;
    }
}