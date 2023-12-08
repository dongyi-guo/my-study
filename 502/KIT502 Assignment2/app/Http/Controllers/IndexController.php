<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    // View Index page
    public function view()
    {
        return view('index');
    }
}
