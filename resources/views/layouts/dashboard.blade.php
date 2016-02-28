@if (!isset($nav))
    {{--*/ $nav = null /*--}}
@endif

<!DOCTYPE html>
<html>
    <head>
        <title>Tacticode</title>

        <link rel="icon" type="image/png" href="favicon.png" />

        <!-- Jquery -->
        <script src="/js/jquery-2.1.4.min.js"></script>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="/css/font-awesome.min.css">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <script src="/js/bootstrap.min.js"></script>

        <!-- Page styles -->
        @section('page-styles')
        @show

        <link rel="stylesheet" href="/css/dashboard.css">
        <link rel="stylesheet" href="/css/style.css">
    </head>

    <body>

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
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="@if ($nav == 'user') active @endif"><a href="/user">{{ucfirst(Auth::user()->login)}}</a></li>
                            <li class="@if ($nav == 'help') active @endif"><a href="#">Help</a></li>
                            <li class="@if ($nav == 'chat') active @endif"><a href="#">Chat</a></li>
                            <li class="@if ($nav == 'forum') active @endif"><a href="#">Forum</a></li>
                            <li><a href="/logout" class="logout">Logout</a></li>
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
                                <span class="fa fa-tachometer"></span>Dashboard <span class="sr-only">(current)</span>
                            </a></li>
                            <li class="@if ($nav == 'scripts') active @endif"><a href="/scripts">
                                <span class="fa fa-file-o"></span>Scripts Editor
                            </a></li>
                            <li class="@if ($nav == 'characters') active @endif"><a href="/characters">
                                <span class="fa fa-user"></span>Characters
                            </a></li>
                            <li class="@if ($nav == 'teams') active @endif"><a href="/teams">
                                <span class="fa fa-users"></span>Teams
                            </a></li>
                            <li class="@if ($nav == 'arena') active @endif"><a href="/arena">
                                <span class="fa fa-gavel"></span>Arena
                            </a></li>
                            <li class="@if ($nav == 'leaderboard') active @endif"><a href="/leaderboard">
                                <span class="fa fa-line-chart"></span>Leaderboard
                            </a></li>
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
