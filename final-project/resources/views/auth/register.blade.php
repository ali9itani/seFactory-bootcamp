@extends('layouts.app')

@section('content')

    <div>
        <div class="">
            <div class="">
                <div class="row">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="{{ $errors->has('username') ? ' has-error' : '' }}">
                            <div class="">
                                <input id="username" type="text" class="auth-input col-xs-10 col-xs-offset-1" placeholder="username" name="username" value="{{ old('username') }}" required autofocus>            
                            </div>
                        </div>

                        <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="">
                                <input id="email" type="email" class=" auth-input col-xs-10 col-xs-offset-1" placeholder="email" name="email" value="{{ old('email') }}" required>
                            </div>
                        </div>

                        <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="">
                                <input id="password" type="password" class="auth-input col-xs-10 col-xs-offset-1" placeholder="password" name="password" required>

                                
                            </div>
                        </div>

                        <div class="{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <div class="">
                                <input id="password-confirm" type="password" placeholder="confrim password" class=" auth-input col-xs-10 col-xs-offset-1" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block col-xs-10 col-xs-offset-1">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                                @if ($errors->has('password'))
                                    <span class="help-block col-xs-10 col-xs-offset-1">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                                 @if ($errors->has('username'))
                                    <span class="help-block col-xs-10 col-xs-offset-1">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif

                                 @if ($errors->has('email'))
                                    <span class="help-block col-xs-10 col-xs-offset-1">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class=" ">
                                <button type="submit" class="btn btn-primary">
                                    Sign Up
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
