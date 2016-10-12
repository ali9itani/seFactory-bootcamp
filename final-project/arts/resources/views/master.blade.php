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
            <a href="#"><img id="logo" src="{{ asset('/img/logo.png') }}" /></a>
            <a id="header-explore-a" href="explore" class="fix-anchor">EXPLORE</a>
          </div>
          <div class="display-inline-block float-right">
            @include('header_menu')
          </div>
        </div>
      </header>
        <!-- body -->
    <div id="body-content-div">
      @yield('body-content')
      </div>
      <!-- footer -->
      <footer>
        <p class="container-980px text-align-center">All RIGHTS ARE RESERVED</p>
      </footer>
      <script  type="text/javascript" src="{{ asset('/js/main.js') }}"></script>
    </body>
</html>
