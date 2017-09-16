@extends('layout_parts.layoutAdmin')
@section('content')
    <div class="col-lg-2 "></div>
    <div class="col-lg-8 ">
        <form action='/admin/galleries_update/{{$galery->id}}' method='post' enctype='multipart/form-data'>
            {{csrf_field()}}
            <div class="form-group">
                <input name="title"  class="form-control" type="text" placeholder="{{$galery->title}}">
            </div>

            <div class="form-group">
                <label for="alias">alias</label>
                <input type="text" class="form-control" name="alias" placeholder="{{$galery->alias}}">
            </div>
            <div class="form-group">
                <label for="body">Описание</label>
                <textarea class="form-control " rows="3" name="body" placeholder="{{$galery->body}}"></textarea>
                <button type="submit" class="btn btn-primary"> редактировать  альбом </button>
            </div>
        </form>
    </div>
    <div class="col-lg-2 "></div>

@endsection