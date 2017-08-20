@extends('layout_parts.layout')
@section('content')



    <div class="container-fluid">
        @foreach( $news AS $new)
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <div class="thumbnail">

                            <a href="/news/{{$new->alias}}">
                                <img class="imgStyle" alt="{{$new->title}}" src="{{$new->img_way}}"/></a>
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
                                        <p>
                                            <a class="btn btn-primary" href="/news/{{$new->alias}}">Подробнее</a>
                                        </p>
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
                </div></div>
    </div>


@endsection