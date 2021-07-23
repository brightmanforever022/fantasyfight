@extends('layouts.app')

@section('title', "prizes")

@section('headerbar')
    @parent
@stop

@section('content')
    <div class="lead-body">
        <span class="lead-title">PRIZES</span>
        <div class="row" id="filter-area">
            <div class="filter-box col-6">
                <span class="filter-label">Sport:</span>
                <div class="form-group filter-by-sport">
                    <select class="form-control" id="select_prize_sport">
                        @foreach($sports as $sport)
                            <option value="{{$sport->sport_id}}">{{$sport->name}}</option>
                        @endforeach
                        <option value="all" selected>All</option>
                    </select>
                </div>
            </div>
            <div class="filter-box col-6">
                <span class="filter-label">Rank: </span>
                <select name="" class="form-control" id="select_prize_rank">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="all" selected>All</option>
                </select>
            </div>
        </div>
        <div class="lead-table-box">
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">PLACE</th>
                    <th scope="col">SPORTS</th>
                    <th scope="col">RANK</th>
                    <th scope="col">PRIZE</th>
                    </tr>
                </thead>
                <tbody class="prize-results">
                    @foreach($results as $index => $result)
                    <tr>
                    <th scope="row">{{$index+1}}</th>
                    <td>{{$result->sport_id}}</td>
                    <td>{{$result->rank_id}}</td>
                    <td>{{$result->prize}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
