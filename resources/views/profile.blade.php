@extends('layouts.app')

@section('title', 'LeaderBoard')

@section('headerbar')
    @parent
@stop

@section('content')
    <div class="profile-body">
        <div class="profile-title">{{$username}}</div>
        <div class="profile-content">
          @foreach ($points as $point)
              <div class="game-board">
                <div class="game-header">
                  <span class="title">{{$point['gameName']}}</span>
                  <div class="score-board">
                    <span>{{$point['point']}}</span>
                    <span>FFL POINTS</span>
                  </div>
                </div>
                <div class="game-score-body">
                  @foreach ($point['content'] as $question)                    
                    <div class="question-board">
                      <span class="question-title">{{$question->answer}}</span>
                      <span class="score">{{$question->point}}</span>
                    </div>
                  @endforeach
                </div>
              </div>
          @endforeach
        </div>
    </div>
@stop
