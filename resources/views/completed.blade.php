@extends('layouts.app')

@section('title', 'LeaderBoard')

@section('headerbar')
    @parent
@stop

@section('content')
    <div class="profile-body">
        <h1 style="color: white">Signed up successfully.</h1>
        <a style="background-image: linear-gradient(to bottom, #5ac1c2, #478acd); color: #FFF; font-size: 19px; text-decoration: none; padding: 5px 20px; border-radius: 5px;"
            href="/">Get Started</a>
    </div>
@stop
