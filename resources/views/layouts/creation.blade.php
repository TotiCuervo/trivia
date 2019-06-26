@extends('layouts.app')

@section('layout')
    <main class="py-4">
        <div id="app">
            {{--<Creation></Creation>--}}
            <div class="container">
                @yield('content')
            </div>
        </div>
    </main>
@stop
