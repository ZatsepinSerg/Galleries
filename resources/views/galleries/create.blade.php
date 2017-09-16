@extends('layout_parts.layoutAdmin')

@section('content')
    <div class="col-lg-2 "></div>
    <div class="col-lg-8 ">
        <form action='/admin/store' method='post' enctype='multipart/form-data'>
              {{csrf_field()}}
            <div class="form-group">
                <label for="title">Название альбома</label>
                <input name="title"  class="form-control" type="text">
            </div>
            <div class="form-group">
                <label for="time">Дата создания</label>
                <div class='input-group date' id='datetimepicker1'>
                    <input name="time" type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="alias">alias</label>
                <input type="text" class="form-control" name="alias" placeholder="alias">
            </div>
            <div class="form-group">
            <label for="body">Описание</label>
            <textarea class="form-control " rows="3" name="body"></textarea>
                            <button type="submit" class="btn btn-primary"> Добавить альбом </button>
                        </div>
            </form>
    </div>
    <div class="col-lg-2 "></div>
    <script type="text/javascript">
        $(function () {
            $('#datetimepicker1').datetimepicker();
        });
    </script>
@endsection
