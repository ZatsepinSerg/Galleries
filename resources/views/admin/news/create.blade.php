@extends('layout_parts.layoutAdmin')
@section('content')

                <div class="col-md-7">
                <form method="POST" action="/news" enctype='multipart/form-data'>
                    {{csrf_field()}}

                    <div class="form-group">
                        <label for="exampleInputEmail1">Заголовок</label>
                        <input type="text" class="form-control" name="title" placeholder="title">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Заголовок</label>
                        <input type="text" class="form-control" name="alias" placeholder="alias">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Текст статьи</label>
                        <textarea type="text" rows="3" name="body" class="form-control" placeholder="Содержание статьи" ></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">добавте файл</label>
                        <input  name='file' type='file' />
                        <p class="help-block">Изображение соответствующее статье</p>
                    </div>
                    <button type="submit" class="btn btn-default">Опубликовать</button>
                </form>
               </div>
@endsection