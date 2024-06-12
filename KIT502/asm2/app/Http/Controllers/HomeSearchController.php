<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeSearch;

class HomeSearchController extends Controller
{
    public function search()
    {
        $search_text = $_GET['query'];
        $search_text = strtolower($search_text);
        if(preg_match("/^zone..?$/",$search_text))
        {
            $search_text = substr($search_text, -1);
            $home_searches=HomeSearch::where('zone', 'LIKE', '%'.$search_text.'%')->get();
        }
        else {
        $home_searches=HomeSearch::where('type', 'LIKE', '%'.$search_text.'%')->get();
        }
        return view('start.home-trading', ['home_searches'=>$home_searches]);
    }
    public function trading()
    {
        $home_searches=HomeSearch::all();
        return view('start.home-trading', ['home_searches'=>$home_searches]);
    }
}
