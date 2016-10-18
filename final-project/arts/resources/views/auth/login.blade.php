@extends('layouts.app')

@section('content')
<style type="text/css">
    body {
        background-repeat: no-repeat;
        background-size: cover;
        background-image: linear-gradient(to bottom, rgba(133,80,133, 0.5), rgba(0, 0, 0, 0.5)), url('img/background.jpg');
    }
    footer {
        color: white;
    }
    header .navbar-inverse {
      background-color: rgba( 24, 41, 69, 0.5);
    }   
</style>
<div class="">
    <div class="">
        <div class="">
            <div class="">
                <div class="row">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                        <h1>Login</h1>
                        <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-xs-10 col-xs-offset-1">
                                <input id="email" type="email" placeholder="email" class="form-control auth-input" name="email" value="{{ old('email') }}" required autofocus>
                            </div>
                        </div>
                        <div class="{{ $errors->has('password') ? ' has-error' : '' }}">

                            <div class="col-xs-10 col-xs-offset-1">
                                <input id="password" placeholder="password" type="password" class="form-control auth-input" name="password" required>
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block col-xs-10 col-xs-offset-1">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            @if ($errors->has('password'))
                                <span class="help-block col-xs-10 col-xs-offset-1">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-0">
                                <div class="checkbox">
                                    <label>Remember Me
                                        <input type="checkbox" style="margin:3px;" name="remember"> 
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-xs-10 col-xs-offset-1">
                                <button type="submit"  class="btn btn-primary">
                                    Login
                                </button>
                                <!-- 
                                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    Forgot Your Password?
                                </a> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
