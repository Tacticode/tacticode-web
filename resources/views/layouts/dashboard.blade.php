<!DOCTYPE html>
<html>
    <head>
        <title>Tacticode</title>

        <!-- Jquery -->
        <script src="/js/jquery-2.1.4.min.js"></script>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <script src="/js/bootstrap.min.js"></script>

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
                            <li><a href="#">Help</a></li>
                            <li><a href="#">Chat</a></li>
                            <li><a href="#">Forum</a></li>
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
                            <li class="active"><a href="#">Dashboard <span class="sr-only">(current)</span></a></li>
                            <li><a href="#">Script Editor</a></li>
                            <li><a href="#">Characters</a></li>
                            <li><a href="#">Arena</a></li>
                            <li><a href="#">Leaderboard</a></li>
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
