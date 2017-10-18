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

    public function __construct()
    {
        $this->galleryObj = new Galleries();
        $this->imgObj = new Images();
    }

    /**
     * Index the form for index a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = $this->galleryObj->showAllGalleries();

        if (Auth::check())
        {
            return view('admin.index' ,compact('galleries'));
        }else {
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
        $gallery =  $this->galleryObj->showOneGalleries($alias);

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
        if (Auth::check())
        {
            $galery = $this->galleryObj->select($id);

            return view('galleries.edit', compact('galery'));
        } else return redirect()->home();
    }
    /**
     * Store the form for storage a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required|min:10',
            'title' => 'required',
            'alias' => 'required',
            'time' => 'required|min:4'
        ]);

        $galleries_ids = $this->galleryObj->createNewGalleries($request);
        
           if($galleries_ids)
           {
               session()->flash('message', 'Альбом успешно создан!загрузите фото!');

               return view('images.create', compact('galleries_ids'));
           }else{
               session()->flash('message', 'ошибка при создании альбома!');

               return redirect()->home();
           }

    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'body' => 'required|min:10',
            'title' => 'required',
            'alias' => 'required'
        ]);
        
        $answer = $this->galleryObj->updateGalleries($id,$request);

        if($answer)
        {
            session()->flash('message', 'Альбом успешно обновлен!');
        }else{
            session()->flash('message', 'Ошибка при обновлении альбома!');
        }
        return redirect()->home();
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        //получаем айдишник галлереи request('galleries_id')
        $images = $this->imgObj->selectAllImagesFromId($id);//выборка всех файлов галереи

        foreach ($images AS $image) {
            Storage::delete($image->way); //удаление по одному из папки проекта
            $this->imgObj->deleteImg($image->id);//удаление по одному из БД
        }

        Storage::deleteDirectory('/' .$id); //удаление дериктории из папки проекта
        $this->galleryObj->deleteGalleri($id);//удаление галереи
        
        session()->flash('message', 'Галерея успешно удалена !');

        return redirect()->home();
    }

    public function __destruct()
    {
        $this->galleryObj;
        $this->imgObj ;
    }
}
