<!DOCTYPE html>
<html>
    <head>
        <title>Tacticode</title>

        <link rel="icon" type="image/png" href="favicon.png" />

        <!-- Lang -->
        <script src="@lang('javascript.file')"></script>

        <!-- Jquery -->
        <script src="/js/jquery-2.1.4.min.js"></script>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="/css/font-awesome.min.css">
        
        <!-- Bootstrap -->
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <script src="/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="/css/style.css">
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
                        <a class="navbar-brand" href="/">Tacticode</a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <a href="/register" class="btn btn-primary navbar-btn navbar-right">@lang('users.register')</a>
                        <form method="post" action="/login" class="navbar-form navbar-right">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <input type="text" placeholder="@lang('users.login')" class="form-control" name="login">
                            </div>
                            <div class="form-group">
                                <input type="password" placeholder="@lang('users.password')" class="form-control" name="password">
                            </div>
                            <button type="submit" class="btn btn-success">@lang('users.signIn')</button>
                            <a href="/password/email" class="btn btn-warning">@lang('users.forgotPassword')</a>
                        </form>
                    </div>
                </div>
            @show
        </nav>

        <div class="jumbotron">
            <div class="container">
                @if (isset($error))
                    <div class="alert alert-warning alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{$error}}
                    </div>
                @endif
                @yield('jumbotron')
            </div>
        </div>
     
        <div class="container">
            @yield('content')

            <footer>
                <p>&copy; Tacticode 2015</p>
            </footer>
        </div>

        <!-- Page scripts -->
        @section('page-scripts')
        @show

    </body>
</html>
