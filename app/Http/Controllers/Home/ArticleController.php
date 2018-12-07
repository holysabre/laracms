<?php

namespace App\Http\Controllers\Home;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends BaseController
{

    public function __construct()
    {

    }

    public function index(Request $request,Article $article, Category $category)
    {
        $model_category = new Category();
        $category_ids = $model_category->getIds($category->id);
        $lists = $article->withOrder($request->order)
            ->whereIn('category_id',$category_ids)
            ->paginate(1);
        dump($lists);
        return view('home.articles.article',compact('lists','category'));
    }

    public function show(Request $request, Category $category, Article $article)
    {

        if(empty($article->seo_title)){
            $article->seo_title = $article->title;
        }
        if(empty($article->seo_keywords)){
            if(empty($category->seo_keywords)){
                $article->seo_keywords = config('website.keywords');
            }else{
                $article->seo_keywords = $category->seo_keywords;
            }
        }
        if(empty($article->seo_description)){
            if(empty($category->seo_description)){
                $article->seo_description = config('website.description');
            }else{
                $article->seo_description = $category->seo_description;
            }
        }

        return view('home.articles.show', compact('article','category'));
    }
}
