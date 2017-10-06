@extends('layout_parts.layout')
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-md-9 col-md-offset-2">
                <div class="container-fluid">
                        <div class="row">
                                <div class="row">
                                    <div class="col-md-2"></div>

                                        <div class="thumbnail">
                                            <a href="/news/{{$fullNew->alias}}">
                                                <img class="imgStyle" alt="{{$fullNew->title}}"
                                                     src="{{$fullNew->img_way}}"/></a>
                                            <div class="caption">
                                                <h3>
                                                    {{$fullNew->title}}
                                                </h3>
                                                <br>
                                                <p>
                                                    {{Carbon\Carbon::parse($fullNew->created_at)->format('d M Y')}}
                                                </p>
                                                <br>
                                                <div class="row"><p>
                                                        {{$fullNew->body}}
                                                    </p></div>
                                            </div>
                                        </div>
                                </div>

                        </div>
                </div>
            </div>
        </div>
    </div>

@endsection
