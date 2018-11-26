<?php
/**
 * Created by PhpStorm.
 * User: yingwenjie
 * Date: 2018/11/26
 * Time: 3:45 PM
 */

namespace App\Observers;

use App\Jobs\TranslateSlug;
use App\Models\Article;

class ArticleObserver
{

    public function saving(Article $article)
    {
        //截取摘要
        $article->excerpt = make_excerpt($article->content);
    }

    public function saved(Article $article)
    {
        //翻译标题 并储存到slug字段
        if(empty($article->slug)){
            dispatch(new TranslateSlug('article',$article->id,'articles'));
        }
    }

}