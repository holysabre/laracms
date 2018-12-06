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
            ->paginate(10);
//        dump($lists);
        return view('home.articles.article',compact('lists','category'));
    }

    public function show(Article $article)
    {

    }
}
