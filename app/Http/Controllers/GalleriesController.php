<?php

namespace App\Http\Controllers;

use App\Galleries;
use App\Images;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;
use Illuminate\Contracts\Filesystem\Factory;

class GalleriesController extends Controller
{

    /**
     * Index the form for index a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = Galleries::orderBy('time', 'DESC')->paginate(5);

        if (Auth::check()) {
            return view('admin.index' ,compact('galleries'));
        }else{
        return view('galleries.index', compact('galleries'));}
    }
    /**
     * Show the form for show a resource.
     *
     * @param  str  $alias
     * @return \Illuminate\Http\Response
     */


    public function show($alias)
    {
        $gallery=Galleries::find($alias);
        return view('galleries.show',compact('gallery'));
    }
    /**
     * Create the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        if (Auth::check()) {
            return view('galleries.create');
        } else return redirect()->home();
    }

    public function edit($id)
    {
        if (Auth::check()) {
            $galery = Galleries::where('id', $id)->first();
            return view('galleries.edit', compact('galery'));
        } else return redirect()->home();
    }
    /**
     * Store the form for storage a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
            'body' => 'required|min:10',
            'title' => 'required',
            'alias' => 'required',
            'time' => 'required|min:4'
        ]);

        Galleries::create([
            'title' => request('title'),
            'alias' => request('alias'),
            'body' => request('body'),
            'time' => request('time'),
        ]);
        $galleries_ids = Galleries::select('id')->orderBy('id', 'max')->limit(1)->get();
        session()->flash('message', 'Альбом успешно создан!загрузите фото!');
        return view('images.create', compact('galleries_ids'));
    }

    public function update($id)
    {
        $this->validate(request(), [
            'body' => 'required|min:10',
            'title' => 'required',
            'alias' => 'required'
        ]);

        Galleries::where('id', $id)
            ->update(array('title' => request('title'),
                'alias' => request('alias'),
                'body' => request('body')));

        session()->flash('message', 'Альбом успешно обновлен!');

        return redirect()->home();
    }

    public function destroy()
    {
        //получаем айдишник галлереи request('galleries_id')
        $images = Images::having('galleries_id', '=', request('id'))->get();//выборка всех файлов галереи

        foreach ($images AS $image) {
            Storage::delete($image->way); //удаление по одному из папки проекта
            Images::where('id', '=', $image->id)->delete();//удаление по одному из БД
        }

        Storage::deleteDirectory('/' . request('id')); //удаление дериктории из папки проекта
        Galleries::where('id', '=', request('id'))->delete();//удаление галереи
        session()->flash('message', 'Галерея успешно удалена !');

        return redirect()->home();
    }
}
