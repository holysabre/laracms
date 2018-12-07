@extends('home.layouts.base')

@section('title',$article->seo_title)
@section('keywords',$article->seo_keywords)
@section('description',$article->seo_description)

@section('content')
{{--@php dump($category_list);@endphp--}}
<section class="article container">
    @include('home.layouts._sidebar',['current'=>Route::current()->category->id])
    <aside class="article-show">
        <div class="article-crumb">
            <a href="">网站首页</a> / <a href="">产品中心</a> / <a href="">分类一</a>
        </div>
        <div class="article-show-main">
            <h3>{{ $article->title }}</h3>
            <div class="article-show-picture">
                <img src="{{ asset('uploads').'/'.$article->picture }}" alt="">
            </div>
            @isset($article->picture_set)
            <div class="article-show-picture-set">
                <ul>
                    @foreach($article->picture_set as $item)
                        <li><img src="{{ asset('uploads').'/'.$item }}" alt=""></li>
                    @endforeach
                    <div class="clear"></div>
                </ul>
            </div>
            @endisset
            <article>
                {!! $article->content !!}
            </article>
        </div>
    </aside>
    <div class="clear"></div>

</section>

@endsection