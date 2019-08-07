@extends('layouts.play')

{{--@section('content')--}}
    {{--<div class="container">--}}
        {{--<div class="row pt-5">--}}
            {{--<div class="col-md-8 offset-md-2 text-center pt-5">--}}
                {{--<h1>Let's Play!</h1>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="row pt-5">--}}
            {{--<div class="col-md-4 offset-md-4">--}}
                {{--<form method="POST" action="{{ route('checkCode') }}">--}}
                    {{--@csrf--}}

                    {{--<div class="form-group row pb-3">--}}
                        {{--<label for="Name">Game Code</label>--}}

                        {{--<input id="gameCode" type="gameCode" class="form-control @error('gameCode') is-invalid @enderror" name="gameCode" placeholder="Game Code" required autocomplete="gameCode" autofocus>--}}

                        {{--@error('gameCode')--}}
                        {{--<span class="invalid-feedback" role="alert">--}}
                            {{--<strong>{{ $message }}</strong>--}}
                        {{--</span>--}}
                        {{--@enderror--}}
                    {{--</div>--}}

                    {{--<div class="form-group row">--}}
                        {{--<label for="Name">Name</label>--}}

                        {{--<input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>--}}

                        {{--@error('name')--}}
                        {{--<span class="invalid-feedback" role="alert">--}}
                            {{--<strong>{{ $message }}</strong>--}}
                        {{--</span>--}}
                        {{--@enderror--}}
                    {{--</div>--}}

                    {{--<div class="form-group row">--}}
                        {{--<label for="password">Password</label>--}}

                        {{--<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

                        {{--@error('password')--}}
                        {{--<span class="invalid-feedback" role="alert">--}}
                                {{--<strong>{{ $message }}</strong>--}}
                            {{--</span>--}}
                        {{--@enderror--}}
                    {{--</div>--}}



                    {{--<div class="form-group row mb-0">--}}
                        {{--<button type="submit" class="btn btn-primary btn-block">Let's Play!</button>--}}
                    {{--</div>--}}
                {{--</form>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--@endsection--}}

@section('content')
    <Play></Play>
@stop