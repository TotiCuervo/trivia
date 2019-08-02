@extends('layouts.play')

@section('content')
    <div class="container">
        <div class="row pt-5">
            <div class="col-md-8 offset-md-2 text-center pt-5">
                <h1>Let's Play!</h1>
            </div>
        </div>
        <div class="row pt-5">
            <div class="col-md-4 offset-md-4">
                <form method="POST" action="{{ route('checkCode') }}">
                    @csrf

                    <div class="form-group row pb-3">
                        <label for="Name">Game Code</label>

                        <input id="gameCode" type="gameCode" class="form-control @error('gameCode') is-invalid @enderror" name="gameCode" placeholder="Game Code" required autocomplete="gameCode" autofocus>

                        @error('gameCode')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="Name">Name</label>

                        <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="password">Password</label>

                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>



                    <div class="form-group row mb-0">
                        <button type="submit" class="btn btn-primary btn-block">Let's Play!</button>
                    </div>
                </form>
            </div>
        </div>
        {{--<div class="row pt-5">--}}
            {{--<div class="col-md-4 offset-md-4" v-if="this.validCode !== true">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-md-8 offset-md-2">--}}
                        {{--<label>Play Code:</label>--}}
                        {{--<b-form-input--}}
                                {{--v-model="gameCode"--}}
                                {{--:state=validCode--}}
                                {{--id="play-code"--}}
                                {{--placeholder="Enter your Play Code"--}}
                                {{--@click="validCode = ''"--}}
                        {{--></b-form-input>--}}
                        {{--<b-form-invalid-feedback id="play-code">--}}
                            {{--Sorry :( wrong play code--}}
                        {{--</b-form-invalid-feedback>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-md-4 offset-md-4" v-if="this.validCode === true">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-md-8 offset-md-2">--}}
                        {{--<label>Team Name:</label>--}}
                        {{--<b-form-input id="team-name" placeholder="Enter your Team Name" v-model="name"></b-form-input>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="row pt-3">--}}
                    {{--<div class="col-md-8 offset-md-2">--}}
                        {{--<label>Team Password:</label>--}}
                        {{--<b-form-input id="team-password" placeholder="Password" type="password" v-model="password"></b-form-input>--}}
                        {{--<b-form-text id="team-password">--}}
                            {{--Create a new team or login--}}
                        {{--</b-form-text>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="row pt-3">--}}
            {{--<div class="col-md-4 offset-md-4">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-md-8 offset-md-2">--}}
                        {{--<b-button block variant="primary" @click="checkPlayCode()" v-if="this.validCode !== true">Check Code</b-button>--}}
                        {{--<b-button block variant="primary" @click="loginOrRegister()" v-if="this.validCode === true">Let's Play</b-button>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
@endsection
