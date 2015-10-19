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
        </nav>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                    <ul class="nav nav-sidebar">
                        <li class="active"><a href="#">Dashboard <span class="sr-only">(current)</span></a></li>
                        <li><a href="#">Script Editor</a></li>
                        <li><a href="#">Characters</a></li>
                        <li><a href="#">Arena</a></li>
                        <li><a href="#">Leaderboard</a></li>
                    </ul>
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <h1 class="page-header">Dashboard</h1>

                    <div class="row placeholders">
                        <div class="col-xs-6 col-sm-3 placeholder">
                            <h4>Character 1</h4>
                            <span class="text-muted"><a href="#">See more</a></span>
                        </div>
                        <div class="col-xs-6 col-sm-3 placeholder">
                            <h4>Character 2</h4>
                            <span class="text-muted"><a href="#">See more</a></span>
                        </div>
                    </div>

                    <h2 class="sub-header">Fighting history</h2>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Character</th>
                                    <th>Enemy</th>
                                    <th>Victory</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2015-06-27 18:28</td>
                                    <td>Character 1</td>
                                    <td>Bob</td>
                                    <td><span class="glyphicon glyphicon-check" aria-hidden="true"></span></td>
                                </tr>
                                <tr>
                                    <td>2015-06-26 15:32</td>
                                    <td>Character 2</td>
                                    <td>Patrick</td>
                                    <td><span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span></td>
                                </tr>
                                <tr>
                                    <td>2015-06-25 12:42</td>
                                    <td>Character 1</td>
                                    <td>Sebastien</td>
                                    <td><span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
