<!doctype html>
<html lang="en">
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
    <script src="/js/bootstrap.js"></script>
    <script src="/js/ga.js"></script>
    <script src="/js/bootstrap-datetimepicker.min.js"></script>

</head>
<body>
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