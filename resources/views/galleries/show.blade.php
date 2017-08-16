@extends('layout_parts.layout')

@section('content')

            <div class="container">
                <div class="row">
                    <div class="col-sm-offset-5"> <h1>{{$gallery->title}}</h1></div><hr>
                    <div class="col-sm-2"> {{$gallery->created_at->toFormattedDateString()}}</div>
                    @if(Auth::check())
                        <div class="col-sm-2">
                        <form action="/admin/imageCreate" method="get">
                   <input value="{{$gallery->id}}"  type="hidden" name="galleries_id" >
                            <input  class="btn btn-default" type="submit" value="добавить изображения">
                        </form>
                        </div>
                        <div class="col-sm-4">
                        <form action="/admin/show" method="get">
                            {{csrf_field()}}
                            <input value="{{$gallery->id}}"  type="hidden" name="galleries_id" >
                            <input  class="btn btn-default" type="submit" value="Редактировать">
                        </form></div>
                    @else
                    @endif
                    <div class="col-sm-12"> <h4>{{$gallery->body}}</h4><hr></div>
                    @foreach($gallery->images AS $image)
                        <div class=" col-lg-3 col-sm-4 col-xs-6" style="height: 200px; width: 25%;"><a title="{{$image->name}}"  href="#"  >
                        <img class="thumbnail img-responsive center-block" style="width: 100%; height: 100%; " src="{{$image->way}}"></a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div tabindex="-1" class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button class="close" type="button" data-dismiss="modal">×</button>
                            <h2>{{$gallery->title}}</h2>
                        </div>
                        <div class="modal-body">
                        </div>
                        <div class="modal-footer">
                            <div class="col-sm-2">
                            <h3 class="modal-title">Heading</h3></div><div class="col-sm-10">
                            <button class="btn btn-default" data-dismiss="modal">Close</button></div>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">

                $(document).ready(function() {
                    $('.thumbnail').click(function(){
                        $('.modal-body').empty();
                        var title = $(this).parent('a').attr("title");
                        $('.modal-title').html(title);
                        $($(this).parents('div').html()).appendTo('.modal-body');
                        $('#myModal').modal({show:true});
                    });
                });</script>

@endsection