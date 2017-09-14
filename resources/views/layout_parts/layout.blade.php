<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Document</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Alex+Brush" rel="stylesheet">
    <!-- Latest compiled and minified JavaScript -->
    <script src="/js/jquery-1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="/js/ga.js"></script>
    <script src="/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/js/ajax/messageCount.js"></script>
    <script src="/js/ajax/callBackForm.js"></script>
    {{--<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>--}}

</head>
<body>
<div class="application">
    <form class="my-form hide" method="post"  id="callMasters" >
        <div class="row callForm">
            {{csrf_field()}}
            {{method_field('POST')}}
            <div class="col-md-12">
                <div class="form-group">
                    <label for="name">Введите имя:</label>
                    <input id="name" name="userName" type="text" placeholder="Введите имя" class="form-control" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="userTelephon">Номер телефона</label>
                    <input name="userTelephon" id="telephon" type="text" placeholder="номер телефона" class="form-control" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="userEmail">Ваш Email</label>
                    <input name="userEmail" id="Email" type="text" placeholder="Ваш емейл" class="form-control" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="userTelephon">Ваше сообщение</label>
                    <textarea name="messageText" cols="5" rows="5" class="form-control" placeholder="Сообщение не мение 30 символовв"/></textarea>
                </div>
            </div>
        </div>
        <input class="btn btn-success pull-right" type="submit" id="send" value="отправить">
        <input class="btn btn-warning " type="reset" id="cancel" value="отмена">
    </form>
    <div class="" id="show-form">
    <img class="applications" src="/obrat.jpg">
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        @include('layout_parts.navBar')
        @include('layout_parts.errors')
        @if($flash = session('message'))
            <div class="alert alert-success col-lg-8 col-lg-offset-2">
                {{$flash}}
            </div>
        @elseif($flash = session('messages'))
        @endif
        @yield('content')

    </div>
</div>

</body>
<footer>
    <div class="col-md-12 row-fluid">

        <br>
        <br>
        <br>

    </div>
</footer>
</html>