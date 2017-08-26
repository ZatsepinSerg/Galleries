<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    public $fillable =['title','body','img_way','alias'];
    
    public function getQualifiedKeyName()
    {
       return 'alias';
    }
}
