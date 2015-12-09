@if (!isset($nav))
    {{--*/ $nav = null /*--}}
@endif

<!DOCTYPE html>
<html>
    <head>
        <title>Tacticode</title>

        <!-- Jquery -->
        <script src="/js/jquery-2.1.4.min.js"></script>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="/css/font-awesome.min.css">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <script src="/js/bootstrap.min.js"></script>

        <!-- Page scripts -->
        @section('page-scripts')
        @show

        <link rel="stylesheet" href="/css/dashboard.css">
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
                            <li class="@if ($nav == 'logout') active @endif"><a href="/logout">Logout</a></li>
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
                            <li class="@if ($nav == 'dashboard') active @endif"><a href="/dashboard">Dashboard <span class="sr-only">(current)</span></a></li>
                            <li class="@if ($nav == 'script') active @endif"><a href="#">Script Editor</a></li>
                            <li class="@if ($nav == 'characters') active @endif"><a href="#">Characters</a></li>
                            <li class="@if ($nav == 'arena') active @endif"><a href="#">Arena</a></li>
                            <li class="@if ($nav == 'leaderboard') active @endif"><a href="#">Leaderboard</a></li>
                        </ul>
                    @show
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    @yield('content')
                </div>
            </div>
        </div>

    </body>
</html>
