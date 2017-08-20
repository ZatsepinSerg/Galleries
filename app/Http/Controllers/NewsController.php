<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;

class NewsController extends Controller
{
    /**
     * Index the form for index a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news=News::orderBy('id','DESC')->paginate(1);

        return view('homePage',compact('news'));
    }

    public function show(){
        
    }
}
