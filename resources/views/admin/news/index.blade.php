@extends('layout_parts.layoutAdmin')
@section('content')
                <div class="container-fluid">
                    @foreach( $newsAll AS $new)
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
                                                <form action="/news/{{$new->id}}/edit" method="GET">
                                                    {{csrf_field()}}
                                                    <button type="submit"  class="btn btn-primary">Редактировать</button>
                                                </form>
                                                <form action="/news/{{$new->id}}" method="POST">
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
                        <div class="col-sm-offset-6">
                            {{$newsAll->render()}}
                        </div>
                    </div>
                </div>

@endsection