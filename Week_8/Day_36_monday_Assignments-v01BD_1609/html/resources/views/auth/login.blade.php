@extends('master')
@section('title','login')
@section('main-title', 'User Login')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" style="margin-bottom:10px;" placeholder="E-Mail Address" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                            <div class="col-md-6">
                                <input id="password" placeholder="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox" style="display: inline-block;width: 82%;">
                                    <label>
                                        <input id="checkitem" type="checkbox" style="width:5px;" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" id="login-button" class="btn btn-primary">
                                    Login
                                </button>
                                <a style="margin-right: 43%;" href="/public/register">Register</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
