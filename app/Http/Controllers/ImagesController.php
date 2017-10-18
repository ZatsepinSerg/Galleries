<?php

namespace App\Http\Controllers;

use App\Galleries;
use App\Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Query\Builder;
use Symfony\Component\HttpFoundation\File\File;
class ImagesController extends Controller
{
    public function __construct()
    {
        $this->imageObj = new Images();
        $this->galeriasObj = new Galleries();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            return view('images.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->file()) {
            foreach ($request->file() as $file) {
                foreach ($file as $f) {
                    $time = time();

                    $this->imageObj->galleries_id = $request->galleries_id;
                    $this->imageObj->way = "/images/" . $request->galleries_id . "/" . $time . $f->getClientOriginalName();
                    $this->imageObj->save();
                    $f->move("images/" . $request->galleries_id, $time . $f->getClientOriginalName());
                }
            }

            session()->flash('message', 'выберите главное изображение и дайте название!');

            $galleries_id = $request->galleries_id;

            return redirect()->action('ImagesController@show', compact('galleries_id'));
        } else {
            session()->flash('message', 'файлы не выбраны!!!');

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if ($request->galleries_id) {
            $images =   $this->imageObj->showStoreImg($request->galleries_id);
            
            session()->flash('messages', 'выберите главное изображение и дайте название!');
            
            return view('images.show', compact('images'));
        } else {
            return redirect()->home();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $answer =  $this->imageObj->updateImage($request);

        if ($request->view) {


            $answer = $this->galleriasObj->updateGalleries($request->id, $request);
        }
        if ($answer) {
            session()->flash('message', 'Запись успешно обновлена!');
        } else {
            session()->flash('message', 'Ошибка обновления записи!');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request,$id)
    {
        $file = Images::find($id);

        Storage::delete($file->way); //получение пути и удаленние  записи из папки
        Images::destroy($id);//удаление из БД

        $answer = $this->galleriasObj->updateCountGalleries($request);

        if($answer){
                session()->flash('message', 'Изображение  успешно удалено !');
            }else{
                session()->flash('message', 'Произошла ошибка!');
        }

        return redirect()->back();

    }

    public function __destruct()
    {
        $this->imageObj;
        $this->galeriasObj;
    }
}
