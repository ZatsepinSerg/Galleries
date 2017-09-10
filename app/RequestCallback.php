<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestCallback extends Model
{
    protected $table = 'request_callback' ;
    public $fillable =['name_clients','telephon','message','email'];
    

}
