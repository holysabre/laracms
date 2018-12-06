@extends('home.layouts.base')

@section('title',$category->seo_title ? : $category->name)
@section('keywords',$category->seo_keywords ? : config('website.keywords'))
@section('description',$category->seo_description ? : config('website.description'))

@section('content')
{{--@php dump($category_list);@endphp--}}
<section class="article container">
    @include('home.layouts._sidebar',['current'=>Route::current()->category->id])
    <aside class="article-list">
        <div class="article-crumb">
            <a href="">网站首页</a> / <a href="">产品中心</a> / <a href="">分类一</a>
        </div>
        @empty($lists)
            <p>无数据</p>
        @else
            <ul>
                @foreach($lists as $item)
                    <li>
                        <a href="">
                            <figure>
                                <img src="{{ asset('uploads').'/'.$item->picture }}" alt="{{ $item->title }}">
                                <figcaption>{{ $item->title }}</figcaption>
                            </figure>
                        </a>
                    </li>
                @endforeach
                <div class="clear"></div>
            </ul>
        @endempty
    </aside>
    <div class="clear"></div>
</section>

@endsection