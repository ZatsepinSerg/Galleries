@extends('layout_parts.layout')
@section('content')

        <div class="col-md-12">
        @php  echo "<h2>Загружено фото:".count($images)."</h2><hr>" @endphp
            </div>
        @foreach ($images AS $image)
            <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="thumbnail img-responsive">
                            <img class="thumbnail img-responsive" style="width: 100%; height: 100%;" src="{{$image->way}}" alt="" />
                        <form action="/admin/images/{{$image->id}}" method="post">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <input type="hidden" value="{{$image->id}}" name="id">
                            <input type="hidden" value="{{$image->galleries_id}}" name="galleries_id">
                            <input type="hidden" value="{{count($images)}}" name="count">
                            <input type='submit' class="col-md-12 btn btn-danger" value='удалить'/>
                        </form>
                        <form action="/admin/update" method="post" name="{{$image->id}}">
                            {{csrf_field()}}
                            <input type="hidden" value="{{$image->galleries_id}}" name="galleries_id">
                            <input type="hidden" value="{{$image->id}}" name="id">
                            <input type="hidden" value="{{$image->way}}" name="way">
                            <input type="hidden" value="{{count($images)}}" name="count">
                            <div class="col-md-3">
                                <div class="radio">
                                    <select name="view">
                                        <option selected="selected" value="0"> ----</option>
                                        <option value="1">сделать обложкой</option>
                                    </select>
                                </div>
                            </div>
                                <div class="col-md-3"></div>
                            <div class="col-md-4">
                                <input class="form-control" name="trim" type="text" placeholder="{{$image->trim}}">
                            </div>
                            <input type='submit' class=" col-md-12  btn btn-default" value='обновить'/>
                            <input class="form-control" name="name" type="text" placeholder="{{$image->name}}">
                        </form>
        </div></div>
            @endforeach
@endsection