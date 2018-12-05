<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends BaseController
{
    public function index()
    {

    }

    public function show(Page $page)
    {
//        dd($page);
        return view('home.pages.show', compact('page'));
    }
}
