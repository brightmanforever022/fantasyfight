@extends('layouts.app_admin')

@section('title', 'LeaderBoard')

@section('headerbar')
@parent
@stop

@section('content')
<div class="sports-body">
    <span class="body-title">Manage Sports</span>
    <div class="add-sports-btn-box">
        @if(Session::get('name') && (Session::get('name') == 'admin'))
        <button class="btn add-sports" data-toggle="modal" data-target="#sportModal">
            Add sport
        </button>
        <a class="btn add-sports" href='{{route("admin.users.download")}}' target="_blank">
            Export Users
        </a>
        <button class="btn add-sports" data-toggle="modal" data-target="#prizeModal">
            Manage Prizes
        </button>
        @else
        <button class="btn add-sports">
            Add sport
        </button>
        @endif
        <!-- Modal -->
        <div class="modal fade" id="sportModal" tabindex="-1" role="dialog" aria-labelledby="sportModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form class="modal-body-custom" action="{{ route('admin.sport.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <span class="welcome-label">Add Sport</span>
                            <div class="form-group custom-form-group">
                                <input type="text" required name="name" class="form-control custom-input" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Sport Name">
                                <div class="custom-control custom-checkbox my-3" data-toggle="collapse" href="#collapseSplash" role="button" aria-expanded="false" aria-controls="collapseSplash">
                                    <input type="checkbox" class="custom-control-input" id="splashCheck" name="splashEnabled">
                                    <label class="custom-control-label" for="splashCheck">Add splash page?</label>
                                </div>
                                <div class="collapse w-100" id="collapseSplash">
                                    <textarea name="description" placeholder="Add Description" class="form-control my-3"></textarea>
                                    <div class="custom-file">
                                        <input type="file" name="image" accept="image/*" id="splashImage" />
                                        <label class="custom-file-label" for="splashImage">Choose Image</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn add-sports">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Manage Prizes Modal -->
        <div class="modal fade" id="prizeModal" tabindex="-1" role="dialog" aria-labelledby="prizeModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form class="modal-body-custom" action="{{ route('admin.prize.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="prize-box-sport-area">
                                <span class="prize-box-sport-label">Sport:</span>
                                <div class="prize-box-select-sport">
                                    <select name="sport_id" class="form-control" id="select_sport">
                                        @foreach($sports as $sport)
                                            <option value="{{$sport->sport_id}}">{{$sport->sport_id}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="prize-box-Rank-area">
                                <span class="prize-box-rank-label">Rank: </span>
                                <div class="prize-box-select-rank">
                                    <select name="rank_id" class="form-control" id="select_period">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="prize-box-prize-area">
                                <span class="prize-box-prize-label">Prize: </span>
                                <div class="prize-box-prize">
                                    <input name="prize" type="text" class="form-control prize-box-input">
                                </div>
                            </div>
                            <div class="prize-bix-update-button-area">
                                <button type="submit" class="btn add-sports update-prize">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="sports-box">
        @foreach($sports as $sport)
        <div class="sport-item">
            <div class="sport-button">
                <div class="sport-button-left">
                    @if(Session::get('name') && (Session::get('name') == 'admin'))
                    <a class="btn expanded-btn" href="{{route('admin.game.index', $sport->sport_id)}}"><i class="fas fa-plus"></i></a>
                    @endif
                    <span>{{$sport->name}}</span>
                </div>
                <div class="sport-button-right">
                    @if(Session::get('name') && (Session::get('name') == 'admin'))
                    <button class="btn action-button" data-toggle="modal" data-target="#edit_{{$sport->sport_id}}">Edit</button>
                    <button class="btn action-button" data-toggle="modal" data-target="#{{$sport->sport_id}}">Delete</button>
                    @endif
                    <!-- Modal -->
                    <div class="modal fade" id="edit_{{$sport->sport_id}}" tabindex="-1" role="dialog" aria-labelledby="edit_{{$sport->sport_id}}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <form class="modal-body-custom" action="{{ route('admin.sport.update') }}" enctype="multipart/form-data" method="POST">
                                        @csrf
                                        <div class="form-group custom-form-group">
                                            <span class="confirm-text">Are you sure to edit this sport?</span>
                                            <input type="text" class="form-control" name="name" value="{{$sport->name}}">
                                            <textarea class="form-control mt-2" name="description">{{$sport->description}}</textarea>
                                            <input type="hidden" class="form-control mt-2" name="sport_id" value="{{$sport->sport_id}}">
                                            <div class="custom-file mt-2">
                                                <input type="file" name="image" accept="image/*" id="splashImageUpdate" />
                                                <label class="custom-file-label" for="splashImageUpdate">Choose Image</label>
                                            </div>
                                        </div>
                                        <div class="action-box">
                                            <button type="button" class="btn delete-part-action delete-cancel-button" data-dismiss="modal">Cancel</button>

                                            <button type="submit" class="btn delete-part-action delete-button">Edit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="{{$sport->sport_id}}" tabindex="-1" role="dialog" aria-labelledby="{{$sport->sport_id}}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <form class="modal-body-custom" action="{{ route('admin.sport.delete') }}" method="POST">
                                        <div class="form-group custom-form-group">
                                            <span class="confirm-text">Are you sure to delete this sport <strong>{{$sport->name}}</strong>?</span>
                                            <input type="hidden" name="sport_id" value="{{$sport->sport_id}}">
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
            <!-- <div class="games-list">
                    <button class="btn open-game">
                        <i class="fas fa-plus"></i><span class="game-text">U.S.OPEN</span>
                    </button>
                </div> -->
        </div>
        @endforeach
        <!-- <div class="sport-item">
                <div class="sport-button">
                    <div class="sport-button-left">
                        <button class="btn expanded-btn"><i class="fas fa-plus"></i></button>
                        <span>BJJ</span>
                    </div>
                    <div class="sport-button-right">
                        <button class="btn action-button">Add Game</button>
                        <button class="btn action-button">Edit</button>
                        <button class="btn action-button">Delete</button>
                    </div>
                </div>
            </div>
            <div class="sport-item">
                <div class="sport-button">
                    <div class="sport-button-left">
                        <button class="btn expanded-btn"><i class="fas fa-plus"></i></button>
                        <span>MMA</span>
                    </div>
                    <div class="sport-button-right">
                        <button class="btn action-button">Add Game</button>
                        <button class="btn action-button">Edit</button>
                        <button class="btn action-button">Delete</button>
                    </div>
                </div>
            </div> -->
    </div>
</div>
@stop