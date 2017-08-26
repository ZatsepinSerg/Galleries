<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;
use Illuminate\Contracts\Filesystem\Factory;

class NewsController extends Controller
{
    /**
     * Index the form for index a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::orderBy('id', 'DESC')->paginate(3);

        if(Auth::check()){
            return view('admin.news.index', compact('news'));
        }else{
            return view('news.homePage', compact('news'));
        }

    }

    public function show($alias)
    {
        $fullNew = News::find($alias);

        return view('news.show', compact('fullNew'));
    }

    public function create()
    {
        if (Auth::check()) {
            return view('admin.news.create');
        } else {
            return redirect()->home();
        }
    }

    public function store(Request $request)
    {
        $time = time();
        //проверить реквест
        $this->validate(
            $request,[
                'title' =>'required|min:10|max:200',
                'body' => 'required|min:20',
                'alias' => 'required|min:5',
                'file' =>'mimes:jpeg,bmp,png'
            ]
        );
        //придумать перевод заголовка в транслит для алиаса
        $news = new News();
        $news->title =  $request->title;
        $news->body =  $request->body;
        $news->alias =  $request->alias;
        $news->img_way = "/images/news/".$time."-".$request->file('file')->getClientOriginalName();
        $request->file('file')->move(public_path().'/images/news/',$time."-".$request->file('file')->getClientOriginalName());
        $news->save();

        session()->flash('message','Новость успешно добавлена!');

        return redirect()->home();
    }

    public function edit($id)
    {
      dd('edit');
    }

    public function update(Request $request)
    {
        dd('update');
    }

    public function destroy($id)
    {
        dd('destroy');
    }
}
