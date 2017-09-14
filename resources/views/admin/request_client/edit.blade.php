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
                    <li class="navMenuAdm"><a href="/admin/request-clients" id="countMessage">Заявки</a></li>
                    <li class="navMenuAdm"><a href="#">Настройки</a></li>
                    <li class="navMenuAdm"><a href="#">Написать автору</a></li>
                </ul>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12 col-md-push-3 page-header"><h1>Заявка № {{$showEditClientRequest->id}}</h1></div>
                    <div class="col-md-5"><h3>Заказчик: {{$showEditClientRequest->name_clients}}</h3></div>
                    <div class="col-md-7"><h3>Телефон: {{$showEditClientRequest->telephon}}</h3></div>
                    <div class="col-md-5"><h3>Емеил: {{$showEditClientRequest->email}}</h3></div><div class="col-md-7"></div>
                    <div class="col-md-12"> {{$showEditClientRequest->message}}</div>
                </div>
                <div class="col-md-9">
                    <form method="post" action="/admin/request-clients/{{$showEditClientRequest->id}}">
                        {{csrf_field()}}
                        {{method_field('PUT')}}
                        <input type="submit" class="btn btn-primary" value="Сохранить">
                    </form></div>
                <div class="col-md-3">
                    <form method="post" action="/admin/request-clients/{{$showEditClientRequest->id}}">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <input type="submit" class="btn btn-danger" value="Удалить">
                    </form></div>
            </div>
        </div>
    </div>
@endsection