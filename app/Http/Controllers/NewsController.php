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

    public function __construct()
    {
        $this->newsObj = new News();
    }

    public function index()
    {
        $newsAll = $this->newsObj->selectAll();

        if(Auth::check()){
            return view('admin.news.index', compact('newsAll'));
        }else{
            return view('news.homePage', compact('newsAll'));
        }
    }

    public function show($alias)
    {
        $fullNew = $this->newsObj->showOneNews($alias);

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
                'file' =>'required|mimes:jpeg,bmp,png'
            ]
        );
        //придумать перевод заголовка в транслит для алиаса

        $this->newsObj->title = $request->title;
        $this->newsObj->body = $request->body;
        $this->newsObj->alias = $request->alias;
        $this->newsObj->img_way = "/images/news/" . $time . "-" . $request->file('file')->getClientOriginalName();
        $request->file('file')->move(public_path() . '/images/news/', $time . "-" .
                                                                  $request->file('file')->getClientOriginalName());
        $this->newsObj->save();

        session()->flash('message','Новость успешно добавлена!');

        return redirect()->home();
    }

    public function edit($id)
    {


        $newsEdit = $this->newsObj->showOnEdit($id);
        
        return view('admin.news.edit',compact('newsEdit'));
    }

    public function update(Request $request ,$id)
    {

        $time = time();
        
        $this->Validate($request, [
            'title' => 'required|min:5|max:150',
            'body' => 'required|min:20',
            'alias' => 'required|min:5',
            'file' => 'mimes:jpeg,bmp,png'
        ]);

        if (!empty($request->file('file'))) {
            $oldImageWay = $this->newsObj->imageWay($id);
            Storage::delete($oldImageWay);

            $imgWay = "/images/news/".$time. "-".$request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path().'/images/news/', $time."-".$request->file('file')->getClientOriginalName());

            $answer = $this->newsObj->updateNews($id,$request,$imgWay);
        }else {
            $answer = $this->newsObj->updateNews($id,$request);
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
        $imgWay = $this->newsObj->imageWay($id);

        Storage::delete($imgWay);

        $answer = $this->newsObj->deleteNews($id);

        if ($answer) {
            session()->flash('message', 'Новость удалена!');
        } else {
            session()->flash('message', 'Упссс,что-то пошла не так!');
        }

        return redirect()->back();
    }

    public function __destruct()
    {
        $this->newsObj;
    }
}
