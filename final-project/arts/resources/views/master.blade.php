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
    </head>
    <body>
    <!-- header -->
      <header id="page-header">
        <div class="container-980px">

          <div id="logo-section" class="display-inline-block">
            <a href="{{url('/home')}}"><img id="logo" src="{{ asset('/img/logo.png') }}" /></a>

              <nav class="nav">
                <li><a id="header-explore-a" href="{{url('/explore')}}" class="header-options fix-anchor">EXPLORE</a>
                    <ul class="subs">
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
                  <a href="{{url('/post/new')}}" class="fa fa-plus header-options fix-anchor">Post</a>
                </li>
                @endif
              </nav>

          </div>
          <div class="display-inline-block float-right">
            @include('header_menu')
          </div>
        </div>
      </header>

      <!-- body and footer -->
      <div id="content">

        <!-- body -->
        <div id="body-content-div">
          @yield('body-content')
        </div>

        <!-- footer -->
        <footer>
          <p class="container-980px text-align-center">All RIGHTS ARE RESERVED</p>
        </footer>

      </div>

      <script  type="text/javascript" src="{{ asset('/js/main.js') }}"></script>
    </body>

</html>
