<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Galleries;
use Illuminate\Support\Facades\DB;

class Images extends Model
{
    protected $fillable=['galleries_id','way','name','trim','view','id','count'];
    
    public function galleries()
    {
        return $this->belongsTo(Galleries::class);
    }


    public function selectAllImagesFromId($id)
    {
        $allImg = Images::having('galleries_id', '=', $id)->get();
        return $allImg;
    }
    
    public function deleteImg($id)
    {
          $answer= Images::where('id', '=', $id)->delete();

        return  $answer;
    }

    public function showStoreImg($id)
    {
        $images = Images::having('galleries_id', '=', $id)->get();
        
        return $images;
    }

    public function updateImage($request)
    {
        $answer = Images::where('id', $request->id)
            ->update(['trim' => $request->trim,
                'view' => $request->view,
                'way' => $request->way,
                'galleries_id' => $request->galleries_id,
                'name' => $request->name
            ]);

        return $answer;
    }

}
