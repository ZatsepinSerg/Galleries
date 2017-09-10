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
                    <li class="navMenuAdm"><a href="/admin/create">Создать галерею</a></li>
                    <li class="navMenuAdm"><a href="/news/create">Добавить новость</a></li>
                    <li class="navMenuAdm"><a href="/">Редактировать новости</a></li>
                    <li class="navMenuAdm"><a href="/admin/request-clients">Заявки</a></li>
                    <li class="navMenuAdm"><a href="#">Настройки</a></li>
                    <li class="navMenuAdm"><a href="#">Написать автору</a></li>

                </ul>
            </div>
            <div class="col-md-9">
                @foreach ($galleries AS $gallery)
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <a  href="/galleries/{{$gallery->alias}}" title="{{$gallery->title}}">
                            <img class="thumbnail img-responsive" style="width: 400px ;height: 270px ;" src="{{$gallery->view}}" alt="" /></a>
                        <div class="thumbnail img-responsive ">
                            <div  style="text-align:  center;">
                                <a  href="/galleries/{{$gallery->alias}}">{{$gallery->title}} </a>
                                Загружено:{{$gallery->count}}</div>
                            @if(Auth::check())
                                <form  class="col-lg-6" action="/admin/deleteGalleries" method="post">
                                    {{csrf_field()}}
                                    <input value="{{$gallery->id}}"  type="hidden" name="id" >
                                    <input class="btn btn-default" type="submit" value="удалить альбом">
                                </form>

                                <form  action="/admin/edit/{{$gallery->id}}" method="get">
                                    {{csrf_field()}}
                                    <input class="btn btn-default" type="submit" value="редактировать ">
                                </form>
                            @else
                            @endif
                        </div></div>
                @endforeach
                <div class="col-md-10">
                    <div class="col-sm-offset-5 ">
                        {{ $galleries ->render()}}
                    </div></div>
            </div>
            </div>
        </div>

@endsection