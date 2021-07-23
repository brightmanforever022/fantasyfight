@extends('layouts.app')

@section('title', 'LeaderBoard')

@section('headerbar')
    @parent
@stop

@section('content')
    <div class="lead-body">
        <span class="lead-title">LEADERBOARD</span>
        <div class="row" id="filter-area">
            <div class="filter-box col-6">
                <span class="filter-label">Sport:</span>
                <div class="form-group filter-by-sport">
                    <select class="form-control" id="select_sport">
                        @foreach($sports as $sport)
                            <option value="{{$sport->sport_id}}">{{$sport->name}}</option>
                        @endforeach
                        <option value="all" selected>All</option>
                    </select>
                </div>
            </div>
            <div class="filter-box col-6">
                <span class="filter-label">Date: </span>
                <select name="" class="form-control" id="select_period">
                    <option value="week">Week</option>
                    <option value="month">Month</option>
                    <option value="year">Year</option>
                    <option value="all" selected>All</option>
                </select>
            </div>
        </div>
        <div class="lead-table-box">
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">PLACE</th>
                    <th scope="col">USER</th>
                    <th scope="col">GAMES PLAYED</th>
                    <th scope="col">SCORE</th>
                    </tr>
                </thead>
                <tbody class="sport-results">
                    @foreach($results as $index => $result)
                    <tr>
                    <th scope="row">{{$index+1}}</th>
                    <td><a style="color: white; text-decoration: none;" href="{{route('profile')}}/{{$result->name}}">{{$result->name}}</td>
                    <td>{{$result->counts}}</td>
                    <td>{{$result->actual_points}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
