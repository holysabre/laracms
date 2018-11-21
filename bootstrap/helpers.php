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