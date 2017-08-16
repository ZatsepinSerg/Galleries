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
}
