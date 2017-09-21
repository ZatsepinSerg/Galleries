@extends('layout_parts.layoutAdmin')
@section('content')

<div class="form-horizontal col-sm-offset-3">

        @if(request('galleries_id'))

            <form action='/admin/imageStore' method='post' enctype='multipart/form-data'>
                {{csrf_field()}}
                <input type="hidden" name="galleries_id" value="{{request('galleries_id')}}">
                <input  name='file[]' type='file' multiple='true' />
                <input type='submit' class="btn btn-default" value='Загрузить'/>
            </form>
        @else()
        <form action='/admin/imageStore' method='post' enctype='multipart/form-data'>
            {{csrf_field()}}
            <input type="hidden" name="galleries_id" value="{{$galleries_ids}}">
            <input  name='file[]' type='file' multiple='true' />
            <input type='submit' class="btn btn-default" value='Загрузить'/>
        </form>
        @endif

</div>
@endsection