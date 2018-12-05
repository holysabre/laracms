@extends('home.layouts.base')

@section('title',$category->seo_title ? : $category->name)
@section('keywords',$category->seo_keywords ? : config('website.keywords'))
@section('description',$category->seo_description ? : config('website.description'))

@section('content')
{{--@php dump() @endphp--}}
<section class="article container">
    <nav class="sidebar">
        <span class="sidebar-theme">产品中心</span>
        <ul>
            <li class="sub-menu">
                <a href="">111</a>
                <ul>
                    <li class="sub-menu">
                        <a href="">1-111</a>
                        <ul>
                            <li>
                                <a href="">2-111</a>
                            </li>
                            <li>
                                <a href="">2-222</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="">1-222</a>
                        <ul>
                            <li>
                                <a href="">2-111</a>
                            </li>
                            <li>
                                <a href="">2-222</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="">222</a>
            </li>
            <li>
                <a href="">333</a>
            </li>
        </ul>
    </nav>
    <aside class="article-list">
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