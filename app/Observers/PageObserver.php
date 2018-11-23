<?php
/**
 * Created by PhpStorm.
 * User: yingwenjie
 * Date: 2018/11/23
 * Time: 5:30 PM
 */

namespace App\Observers;


use App\Handlers\TranslateHandler;
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
        if(empty($page->slug)){
            $page->slug = app(TranslateHandler::class)->translate($page->title);
            $page->save();
        }
    }

}