@extends('layout_parts.layout')
@section('content')


    <div class="container">

                <div class="row">
                    <h1 class="h2 text-center content-title">Авторизация</h1>
                    <form action="/login" method="post" enctype="multipart/form-data" class="col-sm-12 form-horizontal" role="form">
                        <fieldset>
                            {{csrf_field()}}
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-email">E-Mail</label>
                                <div class="col-lg-8 col-sm-10">
                                    <input name="email" placeholder="E-Mail" id="input-email" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-password">Пароль</label>
                                <div class="col-lg-8 col-sm-10">
                                    <input name="password" value="" placeholder="Пароль" id="input-password" class="form-control" type="password">

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12 text-center">
                                    <input value="Войти" class="btn btn-primary" type="submit">
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <br>
                <div class="row">
                    <fieldset class="col-sm-12">
                        <p class="text-center"><a class="btn btn-sm btn-default" href="/register">Регистрация</a></p>
                    </fieldset>
                </div>
            </div>

        </div>
    </div>
@endsection