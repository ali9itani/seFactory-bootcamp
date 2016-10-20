<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title> @yield('page-title') | .Arts</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <link rel="stylesheet" href="{{ asset('/css/normalize.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
        <script src="{{ asset('/js/vendor/modernizr-2.8.3.min.js') }}" ></script>
        @yield('header-content')
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
    <style>
    header .navbar-inverse {
      background-color:#182945
    }
    .container-fluid {
      padding-bottom: 25px;
      height: 0px;
    }
    .nav {
      background-color: #182945;
    }
    header .navbar-header a, nav navbar-nav a{
      padding: 0px;

    } 
    .nav {
      top: 4px;
    }
    header .container-fluid {
      margin: 0px;
      padding: 0px;
    }
    .container-fluid {
      padding: 0px;
    }
    .dropdown-menu > li > a {
      color: white;
    }

</style>

    <!-- header -->
      <header class="container-fluid">
        <nav class="navbar navbar-inverse">
          <div class="container">
            <div class="navbar-header">
              <a class="navbar-brand" href="{{url('/home')}}"><img id="logo" src="{{ asset('/img/logo.png') }}" /></a>
            </div>
            <ul class="nav navbar-nav">

              <li class="dropdown">
                  <a class="dropdown-toggle"  data-toggle="dropdown" role="button" area-expanded="false" href="#">EXPLORE<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                        <li><a  href="{{url('/explore/artists')}}">Artists</a></li>
                        <li><a  href="{{url('/explore/views')}}">Most Viewed</a></li>
                        <li><a  href="{{url('/explore')}}">Random Posts</a></li>
                  </ul>
              </li>   

              @if(Auth::check())
                <li>
                  <a href="{{url('/home')}}" class="header-options fix-anchor">Home</a>
                </li>
                <li>
                  <a href="{{url('/post/new')}}" class="header-options fix-anchor">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    <span class="xs-hidden">Post</span>
                  </a>
                </li>
              @endif
            </ul>

              @include('header_menu')

          </div>
        </nav>


     </header>

      <!-- body and footer -->
      <div id="content">

        <!-- body -->
        <div id="body-content-div" class="container">
          @yield('body-content')
        </div>

        <!-- footer -->
        <footer class="row">
          <p class="container-980px text-align-center">All RIGHTS ARE RESERVED</p>
        </footer>

      </div>

      <script  type="text/javascript" src="{{ asset('/js/main.js') }}"></script>
    </body>

</html>
