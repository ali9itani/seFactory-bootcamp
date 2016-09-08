<!DOCTYPE html>

<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Blog - @yield('title')</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/resources/assets/normalize.min.css">
        <link rel="stylesheet" href="/resources/assets/main.css">
        <link rel="stylesheet" type="text/css" href="/resources/assets/main.css">
        <link
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="container">
            <div id="header">
                <h1 id="header-title">My Blog</h1>
                <!-- login/log out -->
                <h4 id="header-login"><a href="#">login</a></h4>
                <!-- navigation menu -->
                <ul id="header-menu">
                    <li><a href="posts">POSTS</a></li>
                    <li><a href="addpost">ADD POST</a></li>
                </ul>
            </div>
            <!-- content differ from one page to another -->
            <div id="content">
                @yield('content')
            </div>

        </div>
    </body>
</html>
