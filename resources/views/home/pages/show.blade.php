@extends('home.layouts.base')

@section('title',$page->seo_title ? : $page->title)
@section('keywords',$page->seo_keywords ? : config('website.keywords'))
@section('description',$page->seo_description ? : config('website.description'))

@section('content')

    <section class="page container">
        <h3>{{ $page->title }}</h3>
        <aside class="page-content">
            {{ $page->content }}
        </aside>
    </section>

@endsection