<div class="container-fluid">
    <div class="row">

            <nav class="navbar navbar-default navbar-static-top navbar-inverse" role="navigation">


                    <div class="navbar-header">

                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                    </button> <a class="navbar-brand" href="/"><div style="color: #000080;
  font-size: 200%;
  font-family:'Alex Brush', cursive;
  color: #FFD700;
  text-align: center;">GOLD ANVIL</div></a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="/">Новости</a>
                        </li>
                        <li >
                            <a href="/galleries">Галерея</a>
                        </li>
                        @if(Auth::check())
                            <li><a href="/admin" rel="nofollow">Панель управления</a></li>
                            <li ><a  rel="nofollow">{{Auth::User()->name}}
                                </a></li>
                            <li><a href="/logout" rel="nofollow">Выйти</a></li>
                        @else

                            <li><a href="/login" rel="nofollow"> Авторизация </a>
                            </li>
                            <li><a href="/register" rel="nofollow">Регистрация</a></li>
                        @endif
                    </ul>
                </div>
            </nav>
            </nav>
        </div>
    </div>
