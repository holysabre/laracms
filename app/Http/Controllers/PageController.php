<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Handlers\TranslateHandler;

class PageController extends Controller
{

    public function index()
    {
        echo 11;
    }

    public function show(Page $page)
    {
        $slug = app(TranslateHandler::class)->translate($page->title);
        echo $slug;
        return view('home.pages.show',compact('page'));
    }
}
