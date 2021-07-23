@extends('layouts.app_admin')

@section('title', 'LeaderBoard')

@section('headerbar')
    @parent
@stop

@section('content')
    <div class="sports-body">
        <span class="body-title">{{$game_name}}</span>
        <div class="add-sports-btn-box">
            <button class="btn add-sports" data-toggle="modal" data-target="#questionModal">
                Add Questions
            </button>
            <!-- Modal -->
            <div class="modal fade" id="questionModal" tabindex="-1" role="dialog" aria-labelledby="questionModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form class="modal-body-custom" action="{{ route('admin.questions.store') }}" method="POST" >
                                @csrf
                                <span class="welcome-label">WELCOME BACK!</span>
                                <div class="form-group custom-form-group">
                                    <input type="text" name="name" class="form-control custom-input" autocomplete="off" aria-describedby="emailHelp" placeholder="Question Name">
                                    <input type="hidden" class="form-control" name="game_id" value="{{$game_id}}">
                                </div>
                                <button type="submit" class="btn add-sports">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sports-box">
            @foreach($questions as $question)
            <div class="sport-item">
                <div class="sport-button">
                    <div class="sport-button-left">
                        <a class="btn expanded-btn" href="{{route('admin.answers.index', $question->id)}}"><i class="fas fa-plus"></i></a>
                        <span>{{$question->name}}</span>
                    </div>
                    <div class="sport-button-right">
                        <button class="btn action-button" data-toggle="modal" data-target="#edit_{{$question->id}}">Edit</button>
                        <button class="btn action-button" data-toggle="modal" data-target="#delete_{{$question->id}}">Delete</button>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="edit_{{$question->id}}" tabindex="-1" role="dialog" aria-labelledby="edit_{{$question->id}}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <form class="modal-body-custom" action="{{ route('admin.question.update') }}" method="POST" >
                                        <div class="form-group custom-form-group">
                                            <span class="confirm-text">Are you sure to edit this question?</span>
                                            <input type="text" class="form-control" name="name" value="{{$question->name}}">
                                            <input type="hidden" class="form-control" name="question_id" value="{{$question->id}}">
                                            <input type="hidden" class="form-control" name="game_id" value="{{$game_id}}">
                                        </div>
                                        <div class="action-box">
                                            <button type="button" class="btn delete-part-action delete-cancel-button" data-dismiss="modal">Cancel</button>
                                            @csrf
                                            <button type="submit" class="btn delete-part-action delete-button">Edit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="delete_{{$question->id}}" tabindex="-1" role="dialog" aria-labelledby="delete_{{$question->id}}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <form class="modal-body-custom" action="{{ route('admin.question.delete') }}" method="POST" >
                                        <div class="form-group custom-form-group">
                                            <span class="confirm-text">Are you sure to delete this question?</span>
                                            <input type="hidden" name="question_id" value="{{$question->id}}">
                                            <input type="hidden" class="form-control" name="game_id" value="{{$game_id}}">
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
                <!-- <div class="games-list">
                    <button class="btn open-game">
                        <i class="fas fa-plus"></i><span class="game-text">Athlete1</span>
                    </button>
                    <div class="projected_points">
                        <div class="form-group">
                            <label class="point-label" for="exampleFormControlSelect1">10 PTS</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="point-label" for="exampleFormControlSelect1">20 PTS</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="point-label" for="exampleFormControlSelect1">30 PTS</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="point-label" for="exampleFormControlSelect1">40 PTS</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                            </select>
                        </div>
                    </div>
                    <div class="points-save-box">
                        <button class="btn point-save-btn">Save</button>
                    </div>
                </div> -->
            </div>
            @endforeach
        </div>
    </div>
@stop
