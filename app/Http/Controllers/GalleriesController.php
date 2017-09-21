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
        $gallery = new Galleries();

        $galleries = $gallery->showAllGalleries();

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
        $galleries = new Galleries();

        $gallery =  $galleries->showOneGalleries($alias);

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
        $galleries = new Galleries();

        if (Auth::check())
        {
            $galery = $galleries->select($id);

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
        $galleries = new Galleries();

        $this->validate($request, [
            'body' => 'required|min:10',
            'title' => 'required',
            'alias' => 'required',
            'time' => 'required|min:4'
        ]);

        $galleries->createNewGalleries($request);
        
        $galleries_ids = $galleries->selectIdNewGalleri();

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
        $galleries = new Galleries();
        
        $this->validate($request, [
            'body' => 'required|min:10',
            'title' => 'required',
            'alias' => 'required'
        ]);
        $answer = $galleries->updateGalleries($id,$request);

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
        $galleries = new Galleries();
        $imgObj = new Images();

        $id = $request->id;
        //получаем айдишник галлереи request('galleries_id')
        $images = $imgObj->selectAllImagesFromId($id);//выборка всех файлов галереи

        foreach ($images AS $image) {
            Storage::delete($image->way); //удаление по одному из папки проекта
            $imgObj->deleteImg($image->id);//удаление по одному из БД
        }

        Storage::deleteDirectory('/' .$id); //удаление дериктории из папки проекта
        $galleries->deleteGalleri($id);//удаление галереи
        
        session()->flash('message', 'Галерея успешно удалена !');

        return redirect()->home();
    }
}
