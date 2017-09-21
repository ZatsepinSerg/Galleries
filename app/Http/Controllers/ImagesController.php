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


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
            return view('images.create');
        } else return redirect()->home();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->file()){
        foreach ($request->file() as $file) {
            foreach ($file as $f) {
                $fil = new Images();
                $time = time();
                $fil->galleries_id = request('galleries_id');
                $fil->way = "/images/".request('galleries_id')."/".$time.$f->getClientOriginalName();
                $fil->save();
                $f->move("images/".request('galleries_id'),$time.$f->getClientOriginalName());
            }
        }
        session()->flash('message', 'выберите главное изображение и дайте название!');
        $galleries_id = request('galleries_id');
        return redirect()->action('ImagesController@show', compact('galleries_id'));}
        else{
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
    public function show()
    {
        if (request('galleries_id')) {
            $images = Images::having('galleries_id', '=', request('galleries_id'))
                ->get();
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
    public function update()
    {
        Images::where('id', request('id'))
            ->update(array('trim' => request('trim'),
                'view' => request('view'),
                'way' => request('way'),
                'galleries_id' => request('galleries_id'),
                'name' => request('name')
            ));
        if (request('view')) {
            Galleries::where('id', request('galleries_id'))
                ->update(array(
                    'view' => request('way'),
                    'count' => request('count'),
                ));;
        }
        session()->flash('message', 'Запись успешно обновлена!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $file = Images::find($id);
        Storage::delete($file->way); //получение пути и удаленние  записи из папки
        Images::destroy($id);//удаление из БД

        Galleries::where('id', request('galleries_id'))
            ->update(array(
                'count' => request('count')-1
            ));
        session()->flash('message', 'изображение  успешно удалено !');
        return redirect()->back();

    }
}
