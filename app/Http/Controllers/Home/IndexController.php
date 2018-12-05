<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

class IndexController extends BaseController
{

    public function index()
    {

        return view('home.index');
    }

}
