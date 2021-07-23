@extends('layouts.app_admin')

@section('title', 'LeaderBoard')

@section('headerbar')
    @parent
@stop

@section('content')
    <div class="sports-body">
        <span class="body-title">Manage Games</span>
        <div class="add-sports-btn-box">
            <button class="btn add-sports" data-toggle="modal" data-target="#gameModal">
                Add Game
            </button>
            <!-- Modal -->
            <div class="modal fade" id="gameModal" tabindex="-1" role="dialog" aria-labelledby="sportModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form class="modal-body-custom" action="{{ route('admin.game.store') }}" method="POST" >
                                @csrf
                                <div class="games-detail">
                                    <div class="game-setting-item">
                                        <label class="game-setting-label">Game name:</label>
                                        <input autocomplete="off" type="text" class="form-control" name="name">
                                        <input type="hidden" class="form-control" name="sport_id" value="{{$sport_id}}">
                                        <input type="hidden" name="offset" class="timeOffset" value="0"/>
                                    </div>
                                    <div class="game-setting-item">
                                        <label class="game-setting-label">Schedule:</label>
                                        <div class="game-setting-values">
                                            <span>From:</span>
                                            <div class="game-setting-dates">
                                                <input class="game-date-input" type="date" name="game_start_day"/> <input type="time" name="game_start_time"/>
                                            </div>
                                            <span>To:</span>
                                            <div class="game-setting-dates">
                                                <input class="game-date-input" type="date" name="game_end_day"/> <input type="time" name="game_end_time"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="game-setting-item">
                                        <label class="game-setting-label">Stream:</label>
                                        <div class="game-setting-values">
                                            <input autocomplete="off" type="text" class="form-control steam" name="stream"/>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn add-sports">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sports-box">
            @foreach($games as $game)
            
            <div class="sport-item">
                <div class="sport-button">
                    <div class="sport-button-left">
                        <a class="btn expanded-btn" href="{{route('admin.questions.index', $game->game_id)}}"><i class="fas fa-plus"></i></a>
                        <span>{{$game->name}}</span>
                    </div>
                    <div class="sport-button-right">
                        @if($game->game_fired == 1)
                        <button class="btn action-button hide-game" data-toggle="modal" data-target="#unhide_{{$game->id}}">Hided</button>
                        @else
                        <button class="btn action-button" data-toggle="modal" data-target="#hide_{{$game->id}}">Hide</button>
                        @endif
                        <button class="btn action-button" data-toggle="modal" data-target="#edit_{{$game->id}}">Edit</button>
                        <button class="btn action-button" data-toggle="modal" data-target="#{{$game->game_id}}">Delete</button>
                        <!-- Modal -->
                        <div class="modal fade" id="edit_{{$game->id}}" tabindex="-1" role="dialog" aria-labelledby="edit_{{$game->id}}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <form class="modal-body-custom" action="{{ route('admin.game.update') }}" method="POST" >
                                            <div class="form-group custom-form-group">
                                                <div class="games-detail">
                                                    <div class="game-setting-item">
                                                        <label class="game-setting-label">Game name:</label>
                                                        <input type="text" class="form-control" name="name" value="{{$game->name}}">
                                                        <input type="hidden" name="offset" class="timeOffset" value="0"/>
                                                    </div>
                                                    <div class="game-setting-item">
                                                        <label class="game-setting-label">Schedule:</label>
                                                        <div class="game-setting-values">
                                                            <span>From:</span>
                                                            <div class="game-setting-dates">
                                                                <input class="game-date-input" type="date" name="game_start_day" value="{{$game->game_start_day}}"/> <input type="time" name="game_start_time" value="{{$game->game_start_time}}"/>
                                                            </div>
                                                            <span>To:</span>
                                                            <div class="game-setting-dates">
                                                                <input class="game-date-input" type="date" name="game_end_day" value="{{$game->game_end_day}}"/> <input type="time" name="game_end_time" value="{{$game->game_end_time}}"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="game-setting-item">
                                                        <label class="game-setting-label">Stream:</label>
                                                        <div class="game-setting-values">
                                                            <input type="text" class="form-control steam" name="stream" value="{{$game->game_url}}"/>
                                                        </div>
                                                    </div>
                                                </div>

                                                <input type="hidden" class="form-control" name="game_id" value="{{$game->game_id}}">
                                                <input type="hidden" class="form-control" name="sport_id" value="{{$sport_id}}">
                                            </div>

                                            <div class="action-box">
                                                @csrf
                                                <button type="submit" class="btn delete-button">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="hide_{{$game->id}}" tabindex="-1" role="dialog" aria-labelledby="hide_{{$game->id}}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <form class="modal-body-custom" action="{{ route('admin.game.update') }}" method="POST" >
                                            <div class="form-group custom-form-group">
                                                <span class="confirm-text">Are you sure to hide this game?</span>
                                                <input type="hidden" class="form-control" name="game_id" value="{{$game->game_id}}">
                                                <input type="hidden" class="form-control" name="sport_id" value="{{$sport_id}}">
                                                <input type="hidden" name="hide" value="1" />
                                            </div>
                                            <div class="action-box">
                                                <button type="button" class="btn delete-part-action delete-cancel-button" data-dismiss="modal">Cancel</button>
                                                @csrf
                                                <button type="submit" class="btn delete-part-action delete-button">Hide</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="unhide_{{$game->id}}" tabindex="-1" role="dialog" aria-labelledby="unhide_{{$game->id}}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <form class="modal-body-custom" action="{{ route('admin.game.update') }}" method="POST" >
                                            <div class="form-group custom-form-group">
                                                <span class="confirm-text">Are you sure to hide this game?</span>
                                                <input type="hidden" class="form-control" name="game_id" value="{{$game->game_id}}">
                                                <input type="hidden" class="form-control" name="sport_id" value="{{$sport_id}}">
                                                <input type="hidden" name="hide" value="0" />
                                            </div>
                                            <div class="action-box">
                                                <button type="button" class="btn delete-part-action delete-cancel-button" data-dismiss="modal">Cancel</button>
                                                @csrf
                                                <button type="submit" class="btn delete-part-action delete-button">Unhide</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="{{$game->game_id}}" tabindex="-1" role="dialog" aria-labelledby="{{$game->game_id}}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <form class="modal-body-custom" action="{{ route('admin.game.delete') }}" method="POST" >
                                            <div class="form-group custom-form-group">
                                                <span class="confirm-text">Are you sure to delete this game <strong>{{$game->name}}</strong>?</span>
                                                <input type="hidden" name="sport_id" value="{{$sport_id}}">
                                                <input type="hidden" class="form-control" name="game_id" value="{{$game->game_id}}">
                                            </div>
                                            <div class="action-box">
                                                <button type="button" class="btn delete-part-action delete-cancel-button" data-dismiss="modal">Cancel</button>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn delete-part-action delete-button">Delete</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
@stop
