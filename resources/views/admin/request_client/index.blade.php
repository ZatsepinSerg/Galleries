@extends('layout_parts.layoutAdmin')

@section('content')

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
                    <td><div class="col-md-6"><a href="/admin/request-clients/{{$showRequest->id}}">
                            <button type="button" class="btn btn-default">Подробнее</button>
                        </a> </div><div class="col-md-6"> <form method="post" action="/admin/request-clients/{{$showRequest->id}}">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <input type="submit" class="btn btn-primary" value="Удалить">
                        </form></div></td>
                </tr>
            @else
                <tr class=" btn-danger">
                    <th scope="row">{{$showRequest->id}}</th>
                    <td>{{$showRequest->name_clients}}</td>
                    <td>{{$showRequest->telephon}}</td>
                    <td>{{$showRequest->email}}</td>
                    <td><div class="col-md-6"><a href="/admin/request-clients/{{$showRequest->id}}">
                            <button type="button" class="btn btn-default">Подробнее</button>
                        </a> </div>
                        <div class="col-md-6"> <form method="post" action="/admin/request-clients/{{$showRequest->id}}">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <input type="submit" class="btn btn-primary" value="Удалить">
                        </form> </div></td>
                </tr>
            @endif
        @endforeach

        </tbody>
    </table>
    {{$showClientsRequest->render()}}
@endsection