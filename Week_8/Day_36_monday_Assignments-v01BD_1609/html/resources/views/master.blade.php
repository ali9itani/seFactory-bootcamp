<!DOCTYPE html>

<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Blog - @yield('title')</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/resources/assets/normalize.min.css">
        <link rel="stylesheet" type="text/css" href="/resources/assets/main.css">
        <link
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="under-header">
            <div id="header">
                <h1 id="header-title">My Blog</h1>
                <!-- navigation menu -->
                <ul id="header-menu">
                    <li><a href="/public/posts">POSTS</a></li>
                    <li><a href="/public/post/add">ADD POST</a></li>
                </ul>
                <!-- login/log out -->
                <h4 id="header-login"><a href="/public/log_in">
                @if (Auth::check() == Auth::user()->id )
                    {!!'logout'!!}
                @else
                    {!!'login'!!}
                @endif
                </a></h4>
            </div>
        </div>
        <div id="main-container">
            <!-- content differ from one page to another -->
            <div id="content">
                <div class="main-body">     
                    <h2 id="main-title">@yield('main-title')</h2>
                    <hr/>
                     @yield('content')
                </div>
            </div>

        </div>
    </body>
</html>
