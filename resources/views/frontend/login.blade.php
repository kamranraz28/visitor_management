@extends('layouts.master')
@section('title','VMS')

@section('content')
    <div class="content top-space">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">

                    <div class="account-content">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-7 col-lg-6 login-left">
                                <img src="assets/img/logo.png" class="img-fluid" alt="Doccure Login">
                            </div>
                            <div class="col-md-12 col-lg-6 login-right">
                                <div class="login-header">
                                    <h3>Login <span>Admin</span></h3>
                                </div>
                                <form method="POST" action="{{ route('log_in') }}">
                                    @csrf
                                
                                    <div class="form-group form-focus">
                                        <label  class="focus-label">Email</label>
                                        <div class="col-md-10">
                                        <input id="email" class="form-control floating" type="text" name="email" value="{{ old('name') }}" required autofocus>
                                        </div>
                                    </div>
                                
                                    <div class="form-group form-focus">
                                        <label class="focus-label">Password</label>
                                        <div class="col-md-10">
                                        <input id="password" class="form-control floating" type="password" name="password" required autocomplete="current-password">
                                        </div>
                                    </div>
                                
                                    <!-- <div>
                                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label for="remember">{{ __('Remember Me') }}</label>
                                    </div> -->
                                
                                    <div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Log In') }}
                                        </button>
                                    </div>

                                
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection