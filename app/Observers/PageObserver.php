<?php
/**
 * Created by PhpStorm.
 * User: yingwenjie
 * Date: 2018/11/23
 * Time: 5:30 PM
 */

namespace App\Observers;

use App\Jobs\TranslateSlug;
use App\Models\Page;

class PageObserver
{

    public function saving(Page $page)
    {
        //截取摘要
        $page->excerpt = make_excerpt($page->content);
    }

    public function saved(Page $page)
    {
        //翻译标题 并储存到slug字段
        if(empty($page->slug)){
            dispatch(new TranslateSlug($page));
        }
    }

}