@extends('layouts.login')

@section('content')
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-12 text-center" style="font-family: 'Pacifico', cursive; color:white;">
                <h1 class="" style="font-size:70px !important;">Trivalo</h1>
            </div>
        </div>
        <div class="row justify-content-center pt-5">
            <div class="col-md-8 col-lg-5">
                <div class="login-card card">
                    <div class="card-body">
                        <div class="row pb-3 pt-3">
                            <div class="col-12 text-center">
                                <h5>Welcome Back!</h5>
                                <h6>We're so excited to see you again!</h6>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-10 col-md-12">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="form-group row justify-content-center">
                                        <div class="col-md-10">
                                            <label for="email" class="small">{{ __('E-Mail Address') }}</label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row justify-content-center">
                                        <div class="col-md-10">
                                            <label for="password" class="small">{{ __('Password') }}</label>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                            @if (Route::has('password.request'))
                                                <a class="small" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0 justify-content-center">
                                        <div class="col-md-10">
                                            <button type="submit" class="btn btn-primary btn-block">
                                                {{ __('Login') }}
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group row pt-1 pb-3 justify-content-center">
                                        <div class="col-10">
                                            <small>Need an account? <a href="/register">Register</a></small>
                                        </div>
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
