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
        $news = new News();

        $newsAll = $news->selectAll();

        if(Auth::check()){
            return view('admin.news.index', compact('newsAll'));
        }else{
            return view('news.homePage', compact('newsAll'));
        }
    }

    public function show($alias)
    {
        $news = new News();

        $fullNew = $news->showOneNews($alias);

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
        $this->validate(
            $request,[
                'title' =>'required|min:5|max:150',
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
        $news = new News();

        $newsEdit = $news->showOnEdit($id);
        
        return view('admin.news.edit',compact('newsEdit'));
    }

    public function update(Request $request ,$id)
    {
        $news = new News();
        $time = time();
        
        $this->Validate($request, [
            'title' => 'required|min:5|max:150',
            'body' => 'required|min:20',
            'alias' => 'required|min:5',
            'file' => 'mimes:jpeg,bmp,png'
        ]);

        if (!empty($request->file('file'))) {
            $oldImageWay = $news->imageWay($id);
            Storage::delete($oldImageWay);

            $imgWay = "/images/news/".$time. "-".$request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path().'/images/news/', $time."-".$request->file('file')->getClientOriginalName());

            $answer = $news->updateNews($id,$request,$imgWay);
        }else {
            $answer = $news->updateNews($id,$request);
        }

        if ($answer) {
            session()->flash('message', 'Запсь успешно обновлена!');
        } else {
            session()->flash('message', 'Ошибка,запись не обновлена!');
        }

        return redirect()->back();
    }

    public function destroy($id)
    {
        $news = new News();

        $imgWay = $news->imageWay($id);

        Storage::delete($imgWay);

        $answer = $news->deleteNews($id);

        if ($answer) {
            session()->flash('message', 'Новость удалена!');
        } else {
            session()->flash('message', 'Упссс,что-то пошла не так!');
        }

        return redirect()->back();
    }
}
