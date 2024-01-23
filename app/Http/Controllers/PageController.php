<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function notfound()
    {
        return view('error.404');
    }
}
