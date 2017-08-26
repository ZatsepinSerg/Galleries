@extends('layout_parts.layout')
@section('content')

    <div class="content container-fluid">
        <div class="row">
            <div class="col-md-3">
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
                    <li class="navMenuAdm"><a href="#">Главная</a></li>
                    <li class="navMenuAdm"><a href="#">Настройки</a></li>
                    <li class="navMenuAdm"><a href="#">Написать автору</a></li>

                </ul>
            </div>
            <div class="col-md-9">
                <div class="container-fluid">
                    @foreach( $news AS $new)
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-10">
                                        <div class="thumbnail">

                                            <a href="/news/{{$new->alias}}">
                                                <img class="imgStyle" alt="{{$new->title}}"
                                                     src="{{$new->img_way}}"/></a>
                                            <div class="caption">
                                                <h3>
                                                    {{$new->title}}
                                                </h3>
                                                <br>
                                                <p>
                                                    {{Carbon\Carbon::parse($new->created_at)->format('d M Y')}}
                                                </p>
                                                <br>
                                                <p>
                                                    {{$new->body}}
                                                </p>
                                                <form action="/news/{{$new->alias}}/edit" method="GET">
                                                    {{csrf_field()}}
                                                    <button type="submit" class="btn btn-primary">Редактировать</button>
                                                </form>
                                                <form action="/news/{{$new->alias}}" method="POST">
                                                    {{csrf_field()}}
                                                    {{method_field('DELETE')}}
                                                    <button type="submit" class="btn btn-danger">Удалить</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-md-10">
                        <div class="col-sm-offset-6 ">
                            {{$news->render()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection