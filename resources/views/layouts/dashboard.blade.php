@if (!isset($nav))
    {{--*/ $nav = null /*--}}
@endif

<!DOCTYPE html>
<html>
    <head>
        <title>Tacticode</title>

        <link rel="icon" type="image/png" href="/favicon.png" />

        <!-- Lang -->
        <script src="@lang('javascript.file')"></script>

        <!-- Jquery -->
        <link rel="stylesheet" href="/css/jquery-ui.min.css">
        <link rel="stylesheet" href="/css/jquery-ui.structure.min.css">
        <link rel="stylesheet" href="/css/jquery-ui.theme.min.css">
        <script src="/js/jquery-2.1.4.min.js"></script>

        <!-- Jquery UI -->
        <script src="/js/jquery-ui.min.js"></script>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="/css/font-awesome.min.css">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <script src="/js/bootstrap.min.js"></script>

        <!-- jQuery Growl -->
        <link rel="stylesheet" href="/css/jquery.growl.css">
        <script src="/js/jquery.growl.js"></script>
        
        <!-- Page styles -->
        @section('page-styles')
        @show

        <link rel="stylesheet" href="/css/dashboard.css">
        <link rel="stylesheet" href="/css/style.css">

        <script src="/js/token.js"></script>
        <script src="/js/notification.js"></script>
    </head>

    <body>

        <?php
            $encrypter = app('Illuminate\Encryption\Encrypter');
            $encrypted_token = $encrypter->encrypt(csrf_token()) 
        ?>
        <input id="token" type="hidden" value="{{$encrypted_token}}">

        <?php $nb_new_notifications = 0; ?>
        @foreach (Auth::User()->notification as $notification)
            @if ($notification->seen == 0)
                <?php ++$nb_new_notifications; ?>
            @endif
        @endforeach

        <?php $nb_new_message = 0; ?>
        @foreach (Auth::User()->message as $message)
            @if ($message->pivot->seen == 0)
                <?php ++$nb_new_message; ?>
            @endif
        @endforeach

        <nav class="navbar navbar-inverse navbar-fixed-top">
            @section('navbar')
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Tacticode</a>
                        @if (Session::get('loggedFrom', -1) > -1)
                            <a class="btn btn-primary" href="/administration/logback">@lang('administration.logBack')</a>
                        @endif
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li id="notifications" class="dropdown">
                                <a class="dropdown-toggle clickable" data-toggle="dropdown">
                                    <i class="fa fa-bell"></i>
                                    @if ($nb_new_notifications > 0)
                                        <span class="badge">{{$nb_new_notifications}}</span>
                                    @endif
                                </a>
                                <ul class="dropdown-menu">
                                    @foreach (Auth::User()->notification as $notification)
                                        <li>
                                            <i class="date">{{$notification->date}}</i>
                                            <h3>{{$notification->title}}</h3>
                                            <p>{{$notification->content}}</p>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="@if ($nav == 'user') active @endif"><a href="/user">{{ucfirst(Auth::user()->login)}}</a></li>
                            <li class="@if ($nav == 'messages') active @endif"><a href="/messages">
                                @lang('menu.messages')
                                @if ($nb_new_message > 0)
                                    <span class="badge">{{$nb_new_message}}</span>
                                @endif
                            </a></li>
                            @if (Auth::user()->group->name == 'ADMIN')
                                <li class="@if ($nav == 'help') active @endif"><a href="#">@lang('menu.help')</a></li>
                                <li class="@if ($nav == 'chat') active @endif"><a href="#">@lang('menu.chat')</a></li>
                                <li class="@if ($nav == 'forum') active @endif"><a href="#">@lang('menu.forum')</a></li>
                            @endif
                            <li><a href="/logout" class="logout">@lang('menu.logout')</a></li>
                        </ul>
                    </div>
                </div>
            @show
        </nav>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                    @section('sidebar')
                        <ul class="nav nav-sidebar">
                            <li class="@if ($nav == 'dashboard') active @endif"><a href="/dashboard">
                                <span class="fa fa-tachometer"></span>@lang('menu.dashboard')
                            </a></li>
                            <li class="@if ($nav == 'scripts') active @endif"><a href="/scripts">
                                <span class="fa fa-file-o"></span>@lang('menu.scriptsEditor')
                            </a></li>
                            <li class="@if ($nav == 'characters') active @endif"><a href="/characters">
                                <span class="fa fa-user"></span>@lang('menu.characters')
                            </a></li>
                            <li class="@if ($nav == 'teams') active @endif"><a href="/teams">
                                <span class="fa fa-users"></span>@lang('menu.teams')
                            </a></li>
                            <li class="@if ($nav == 'arena') active @endif"><a href="/arena">
                                <span class="fa fa-gavel"></span>@lang('menu.arena')
                            </a></li>
                            @if (Auth::user()->group->name == 'ADMIN')
                                <li class="@if ($nav == 'adventure') active @endif"><a href="/adventure">
                                    <span class="fa fa-key"></span>@lang('menu.adventure')
                                </a></li>
                            @endif
                            <li class="@if ($nav == 'leaderboard') active @endif"><a href="/leaderboard">
                                <span class="fa fa-line-chart"></span>@lang('menu.leaderboard')
                            </a></li>
                            @if (Auth::user()->group->name == 'ADMIN')
                                <li class="@if ($nav == 'admin') active @endif"><a href="/administration">
                                    <span class="fa fa-eye"></span>@lang('menu.administration')
                                </a></li>
                            @endif
                        </ul>
                    @show
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    @yield('content')
                </div>
            </div>
        </div>

        <!-- Page scripts -->
        @section('page-scripts')
        @show

    </body>
</html>
