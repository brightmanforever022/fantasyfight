@extends('layouts.app')

@section('title', $sport_name)

@section('headerbar')
    @parent
@stop

@section('content')
    <div class="home-body">
        <span class="body-title">HOW TO PLAY</span>
        <span class="body-content">
            Take your pick from a group of athletes and decide who you want to start on your team. The points your athletes
            score will be awarded to your username and get you moving up the leaderboard
        </span>
        <div class="action-buttons">
            @foreach($games as $game)
                @if(!$game->game_fired)
                    @if($sport_id == NULL)
                        @if((strtotime($game->game_start_day." ".$game->game_start_time) < strtotime(date('Y-m-d h:i:sa'))) && strtotime($game->game_end_day." ".$game->game_end_time) > strtotime(date('Y-m-d h:i:sa')))
                            <a type="button" class="btn custom-home-action-btn" href="{{route('game', [$first_sport_id, $game->game_id])}}">
                                <span class="action-font">{{$game->name}}</span>
                                @if($game->game_url != '')
                                <span class="video-action-link"><i class="fas fa-video action-arrow"></i></span>
                                @endif
                                <input type="hidden" value="{{$game->game_url}}" class="video-action-link-value"/>
                            </a>
                        @endif
                    @else
                        @if((strtotime($game->game_start_day." ".$game->game_start_time) < strtotime(date('Y-m-d h:i:sa'))) && strtotime($game->game_end_day." ".$game->game_end_time) > strtotime(date('Y-m-d h:i:sa')))
                            <a type="button" class="btn custom-home-action-btn" href="{{route('game', [$sport_id, $game->game_id])}}">
                                <span class="action-font">{{$game->name}}</span>
                                @if($game->game_url != '')
                                <span class="video-action-link"><i class="fas fa-video action-arrow"></i></span>
                                @endif
                                <input type="hidden" value="{{$game->game_url}}" class="video-action-link-value"/>
                            </a>
                        @endif
                    @endif
                @endif
            @endforeach
        </div>
    </div>
@stop
