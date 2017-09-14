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
                    <li class="navMenuAdm" ><a href="/admin/request-clients" id="countMessage">Заявки</a></li>
                    <li class="navMenuAdm"><a href="#">Настройки</a></li>
                    <li class="navMenuAdm"><a href="#">Написать автору</a></li>

                </ul>
            </div>
            <div class="col-md-9">
    <table  class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Имя клиента</th>
            <th>Телефон</th>
            <th>Email</th>
        </tr>

        </thead>
        <tbody>
        @foreach($showClientsRequest as $showRequest)
            @if($showRequest->status)
                <tr class="btn-success">
                    <th scope="row">{{$showRequest->id}}</th>
                    <td>{{$showRequest->name_clients}}</td>
                    <td>{{$showRequest->telephon}}</td>
                    <td>{{$showRequest->email}}</td>
                    <td><a href="/admin/request-clients/{{$showRequest->id}}">
                            <button type="button" class="btn btn-default">Подробнее</button>
                        </a></td>
                </tr>
            @else
                <tr class=" btn-danger">
                    <th scope="row">{{$showRequest->id}}</th>
                    <td>{{$showRequest->name_clients}}</td>
                    <td>{{$showRequest->telephon}}</td>
                    <td>{{$showRequest->email}}</td>
                    <td><a href="/admin/request-clients/{{$showRequest->id}}">
                            <button type="button" class="btn btn-default">Подробнее</button>
                        </a></td>
                </tr>
            @endif
        @endforeach

        </tbody>
    </table>
    </div>
    </div>
    </div>
    {{$showClientsRequest->render()}}
@endsection