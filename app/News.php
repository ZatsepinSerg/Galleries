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

    public function selectAll()
    {
        $newsAll = News::orderBy('id', 'DESC')->paginate(3);

        return $newsAll;
    }

    public function showOneNews($alias)
    {
        $newsAll =  News::find($alias);

        return $newsAll;
    }

    public function showOnEdit($id){
        $newsEdit = News::where('id','=',$id)->first();
    
        return $newsEdit ;
    }

    public function imageWay($id){
        $way = News::where('id',$id)->pluck('img_way')->first();

        return $way;
    }
    
    public function updateNews($id,$request,$imgWay = ''){
        if (!empty($imgWay)) {
            $answer = News::where('id', '=', $id)->update([
                'title' => $request->title,
                'body' => $request->body,
                'alias' => $request->alias,
                'img_way' => $imgWay
            ]);
        }else{
            $answer = News::where('id', '=', $id)->update([
                'title' => $request->title,
                'body' => $request->body,
                'alias' => $request->alias,
            ]);
        }
        return  $answer;
    }

    public function deleteNews($id){

        $answer = News::where('id', '=', $id)->delete();

        return  $answer;
    }
}
