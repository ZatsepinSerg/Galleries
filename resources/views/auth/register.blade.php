@extends('layout_parts.layout')
@section('content')
    <div class="container">
        <div class="row">

                <form action="/register" method="post"  class="form-horizontal">
                    {{csrf_field()}}
                    <fieldset>
                        <legend>Основные данные</legend>

                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-firstname">Имя</label>
                            <div class="col-sm-10">
                                <input name="name" placeholder="Имя" id="input-firstname" class="form-control"
                                       type="text">
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-email">E-Mail</label>
                            <div class="col-sm-10">
                                <input name="email" placeholder="E-Mail" id="input-email" class="form-control"
                                       type="email">
                            </div>
                        </div>
                        <legend>Ваш пароль</legend>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-password">Пароль</label>
                            <div class="col-sm-10">
                                <input name="password" value="" placeholder="Пароль" id="input-password"
                                       class="form-control" type="password">
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-confirm">Подтверждение пароля</label>
                            <div class="col-sm-10">
                                <input name="password_confirmation" value="" placeholder="Подтверждение пароля" id="input-confirm"
                                       class="form-control" type="password">
                            </div>
                        </div>

                    <div class="form-group required">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="buttons">
                                <div>
                                    <input value="Продолжить" class="btn btn-primary" type="submit">
                                </div>
                            </div>
                        </div>
                    </div>
                        </fieldset>
                </form>



        </div>
    </div>


@endsection