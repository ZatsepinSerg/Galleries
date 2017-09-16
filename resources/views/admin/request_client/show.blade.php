@extends('layout_parts.layoutAdmin')

@section('content')
    <div class="row">
        <div class="col-md-12 col-md-push-3 page-header"><h1>Заявка № {{$clientRequest->id}}</h1></div>
        <div class="col-md-5"><h3>Заказчик: {{$clientRequest->name_clients}}</h3></div>
        <div class="col-md-7"><h3>Телефон: {{$clientRequest->telephon}}</h3></div>
        <div class="col-md-5"><h3>Емеил: {{$clientRequest->email}}</h3></div>
        <div class="col-md-7"></div>
        <div class="col-md-12"> {{$clientRequest->message}}</div>
    </div>
    <div class="col-md-9">
        <form method="post" action="/admin/request-clients/{{$clientRequest->id}}">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <input type="text" class="hidden" name="status" value="{{$clientRequest->status}}">
            @if($clientRequest->status === 0)
                <input type="submit" class="btn btn-primary" value="Отметить как прочитанное ">
            @else
                <input type="submit" class="btn btn-primary" value="Отметить как непрочитанное ">
            @endif
        </form>
    </div>
    <div class="col-md-3">
        <form method="post" action="/admin/request-clients/{{$clientRequest->id}}">
            {{csrf_field()}}
            {{method_field('DELETE')}}
            <input type="submit" class="btn btn-danger" value="Удалить">
        </form>
    </div></div>
@endsection