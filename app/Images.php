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

}
