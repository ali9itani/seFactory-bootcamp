<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>@section('title')</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="/MyMoments/resources/assets/css/normalize.min.css">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <script src="/MyMoments/resources/assets/js/vendor/modernizr-2.8.3.min.js"></script>
        <link rel="stylesheet" href="/MyMoments/resources/assets/css/main.css">
    </head>
    <body>
        <header id="header-row">
            <div class="container">
                <div class="row" >
                    <div class="col-sm-4 col-xs-2 div-as-link"  onclick="location.href='/MyMoments/public/';">
                        <span class="glyphicon glyphicon-camera" aria-hidden="true"></span>
                        <span class="hidden-xs">| MyMoments</span>
                    </div>
                    <div class="col-sm-2 col-xs-2 div-as-link">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                    </div>
                    <div class="col-sm-2 col-xs-2 div-as-link">
                        <span class="glyphicon glyphicon-globe" aria-hidden="true"></span>
                    </div>
                    <div class="col-sm-2 col-xs-3 div-as-link">
                        <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                    </div>
                    <div class="col-sm-2 col-xs-3 div-as-link">
                        <span class="glyphicon glyphicon-user" onclick="location.href='/MyMoments/public/profile';"  aria-hidden="true"></span>
                    </div>
                </div>
            </div>
        </header>
        <div id="content">
            @yield('content')
        </div>
        <footer class="col-sm-12">
            All Rights Are Reserved.
        </footer>
    </header>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> 
        <script src="/MyMoments/resources/assets/js/main.js"></script>
    </body>
</html>