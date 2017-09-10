@extends('layout_parts.layout')
@section('content')
    <div class="content container-fluid">
        <div class="row">

            <div class="col-md-3" >
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Панель управления
                        </h3>
                    </div>
                </div>
                <ul class="nav">
                    <li class="navMenuAdm">
                        <a  href="/admin/create">Создать галерею</a>
                    </li>
                    <li class="navMenuAdm"><a href="/news/create">Добавить новость</a></li>
                    <li class="navMenuAdm"><a href="/">Редактировать новости</a></li>
                    <li  class="navMenuAdm"><a href="/admin/request-clients">Заявки</a></li>
                    <li  class="navMenuAdm"><a href="#">Настройки</a></li>
                    <li  class="navMenuAdm"><a href="#">Написать автору</a></li>

                </ul>
            </div>

            <div class="col-md-9">
                <div class="container">
                <div class="col-md-8">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                    <img class="imgStyle" alt="{{$newsEdit->title}}"
                         src="{{$newsEdit->img_way}}"/></div>
                    <form action="/news/{{$newsEdit->id}}"  method="POST" enctype='multipart/form-data'>
                        {{csrf_field()}}
                        {{method_field('PUT')}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Заголовок</label>
                            <input type="text" class="form-control" name="title" placeholder="{{$newsEdit->title}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Алиас</label>
                            <input type="text" class="form-control" name="alias" placeholder="{{$newsEdit->alias}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Текст статьи</label>
                            <textarea type="text" rows="6" name="body" class="form-control" placeholder="{{$newsEdit->body}}" ></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">добавте файл</label>
                            <input  name='file' type='file' />
                            <p class="help-block">Изображение соответствующее статье</p>
                        </div>
                        <button type="submit" class="btn btn-default">Опубликовать</button>
                    </form>

                </div>
            </div>
            </div>
        </div>
    </div>
@endsection