<?php
/**
 * Created by PhpStorm.
 * User: yingwenjie
 * Date: 2018/11/16
 * Time: 5:15 PM
 */

/**
 * @param $array
 * @param string $primary_key
 * @return array
 * 返回以$parimary_key(默认id)值为主键的数组
 */
function arrayListKey($array,$primary_key = 'id')
{
    $return  = [];
    foreach ($array as $item){
        $return[$item[$primary_key]] = $item;
    }
    return $return;
}

/**
 * @param $array
 * @param int $pid
 * @param int $level
 * @param string $pid_key
 * @return array
 * 无限级分类树
 * 递归
 */
function getTreeByRecursion($array, $pid = 0, $level = 0, $pid_key = 'parent_id')
{
    static $list = [];
    foreach ($array as $key => $value){
        //第一次遍历,找到父节点为根节点的节点 也就是pid=0的节点
        if ($value['parent_id'] == $pid){
            //父节点为根节点的节点,级别为0，也就是第一级
            $flg = str_repeat('|--',$level);
            // 更新 名称值
            $value['name'] = $flg.$value['name'];
            // 输出 名称
            echo $value['name']."<br/>";
            //把数组放到list中
            $list[] = $value;
            //把这个节点从数组中移除,减少后续递归消耗
            unset($array[$key]);
            //开始递归,查找父ID为该节点ID的节点,级别则为原级别+1
            getTreeByRecursion($array, $value['id'], $level+1);
        }else{
            // 删除数组，减少递归
            unset($array[$key]);
        }
    }
    return $list;
}

/**
 * @param $array
 * @param string $pid_key
 * @return array
 * 无限级分类树
 * 引用传值
 */
function getTreeByCite($array,$pid_key = 'parent_id')
{
    $tree = [];
    $items = arrayListKey($array);
    foreach ($items as $key => $value) {
        if (isset($items[$value[$pid_key]])) {
            $items[$value[$pid_key]]['son'][] = &$items[$key];
        } else {
            $tree[] = &$items[$key];
        }
    }
    return $tree;
}

/**
 * @param $array
 * @param $id
 * @param $value
 * @param string $pid
 * @return bool
 * 判断数组中的$pid值是否为自身$value
 */
function arrayIsSelf($array, $id, $value, $pid = 'parent_id')
{
    return $array[$id][$pid] == $value ? true : false;
}

function arrayIsChild($array, $id, $value, $pid = 'parent_id')
{

}