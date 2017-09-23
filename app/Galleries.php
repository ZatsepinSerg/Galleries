<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Images;
use Illuminate\Support\Facades\DB;

class Galleries extends Model
{
    public $fillable=['name','time','body','alias','title','view'];

    public function getQualifiedKeyName()
    {
        return 'alias';
    }
    
    public function images()
    {
        return $this->hasMany(Images::Class);
    }
    
    public function showAllGalleries()
    {
        $galleries = Galleries::orderBy('time','DESC')->paginate(6);
        
        return  $galleries;
    }
    
    public function showOneGalleries($alias)
    {
        $gallery = Galleries::find($alias);

        return $gallery;
    }

    public function select($id)
    {
          $item = Galleries::where('id', $id)->first();

        return  $item;
    }
    
    public function createNewGalleries($request)
    {
        $data = Galleries::create([
            'title' => $request->title,
            'alias' => $request->alias,
            'body' => $request->body,
            'time' => $request->time,
        ]);

        $lastInsertedId = $data->id;
        
        return $lastInsertedId;
    }
    
    public function updateGalleries($id,$request)
    {

        if (isset($request->way) && !empty($request->way)) {
            $answer = Galleries::where('id',$request->galleries_id)
                ->update([
                    'view' => $request->way,
                    'count' => $request->count
                ]);
        } else {
            $answer = Galleries::where('id', $id)
                ->update([
                    'title' => $request->title,
                    'alias' => $request->alias,
                    'body' => $request->body]);
        }

        return $answer;
    }
    
    public function deleteGalleri($id)
    {
        $answer = Galleries::where('id', '=',$id)->delete();

        return $answer;
    }

    public function updateCountGalleries($request){

        $answer = Galleries::where('id',$request->galleries_id)
            ->update(array(
                'count' => $request->count-1
            ));

        return $answer;
    }
    
}
