<!DOCTYPE html>
<html>
    <head>
        <title>Tacticode</title>

        <!-- Jquery -->
        <script src="/js/jquery-2.1.4.min.js"></script>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <script src="/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="/css/welcome.css">
    </head>

    <body>

        <nav class="navbar navbar-inverse navbar-fixed-top">
            @section('navbar')
                <div class="container">
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
                        <form class="navbar-form navbar-right">
                            <div class="form-group">
                                <input type="text" placeholder="Email" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="password" placeholder="Password" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-success">Sign in</button>
                        </form>
                    </div>
                </div>
            @show
        </nav>

        <div class="jumbotron">
            @yield('jumbotron')
        </div>
     
        <div class="container">
            @yield('content')
        </div>

    </body>
</html>
