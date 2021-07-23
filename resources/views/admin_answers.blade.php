@extends('layouts.app_admin')

@section('title', 'LeaderBoard')

@section('headerbar')
    @parent
@stop

@section('content')
    <div class="sports-body">
        <span class="body-title">{{$question_name}}</span>
        <div class="add-sports-btn-box">
            <button class="btn add-sports" data-toggle="modal" data-target="#answerModal">
                Add Answer
            </button>
            <!-- Modal -->
            <div class="modal fade" id="answerModal" tabindex="-1" role="dialog" aria-labelledby="answerModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form class="modal-body-custom" action="{{ route('admin.answers.store') }}" method="POST" >
                                @csrf
                                <span class="welcome-label">WELCOME BACK!</span>
                                <div class="form-group custom-form-group">
                                    <input type="text" name="name" class="form-control custom-input" autocomplete="off" aria-describedby="emailHelp" placeholder="Answer Name">
                                    <input type="hidden" class="form-control" name="question_id" value="{{$question_id}}">
                                </div>
                                <div class="answer-item-label">
                                    <label class="answer-item-label-text">Projected Points</label>
                                </div>
                                <div class="projected_points">
                                    <div class="form-group">
                                        <label class="point-label" for="exampleFormControlSelect1">10 PTS</label>
                                        <select name="point1" class="form-control" id="exampleFormControlSelect1">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="point-label" for="exampleFormControlSelect1">20 PTS</label>
                                        <select name="point2"  class="form-control" id="exampleFormControlSelect1">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="point-label" for="exampleFormControlSelect1">30 PTS</label>
                                        <select name="point3" class="form-control" id="exampleFormControlSelect1">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="point-label" for="exampleFormControlSelect1">40 PTS</label>
                                        <select name="point4" class="form-control" id="exampleFormControlSelect1">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                        </select>
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
            @foreach($answers as $answer)
            <div class="sport-item">
                <div class="sport-button">
                    <div class="sport-button-left">
                        <span>{{ $answer->name}}</span>
                    </div>
                    <div class="sport-button-right">
                        @if($answer->actual_points > 0)
                        <button class="btn action-button added-actual-point" data-toggle="modal" data-target="#edit_{{ $answer->answer_id}}">Actual PTS</button>
                        @else
                        <button class="btn action-button" data-toggle="modal" data-target="#edit_{{ $answer->answer_id}}">Actual PTS</button>
                        @endif
                        <button class="btn action-button" data-toggle="modal" data-target="#{{ $answer->answer_id}}">Delete</button>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="edit_{{ $answer->answer_id}}" tabindex="-1" role="dialog" aria-labelledby="edit_{{ $answer->answer_id}}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <form class="modal-body-custom" action="{{ route('admin.answer.update') }}" method="POST" >
                                        <div class="form-group custom-form-group">
                                            <span class="confirm-text">Are you sure to add an actual points?</span>
                                            <input type="hidden" class="form-control" name="answer_id" value="{{ $answer->answer_id}}">
                                            <input type="hidden" class="form-control" name="question_id" value="{{$question_id}}">
                                            <!-- <div class="answer-item-label">
                                                <input autocomplete="off" type="number" class="form-control" name="actual_pts" value="" placeholder="actual pts">
                                            </div> -->
                                            <div class="projected_points">
                                                <div class="form-group">
                                                    <label class="point-label" for="exampleFormControlSelect1">10 PTS</label>
                                                    <select name="actual_pts1" class="form-control" id="exampleFormControlSelect1">
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="point-label" for="exampleFormControlSelect1">20 PTS</label>
                                                    <select name="actual_pts2"  class="form-control" id="exampleFormControlSelect1">
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="point-label" for="exampleFormControlSelect1">30 PTS</label>
                                                    <select name="actual_pts3" class="form-control" id="exampleFormControlSelect1">
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="point-label" for="exampleFormControlSelect1">40 PTS</label>
                                                    <select name="actual_pts4" class="form-control" id="exampleFormControlSelect1">
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="action-box">
                                            <button type="button" class="btn delete-part-action delete-cancel-button" data-dismiss="modal">Cancel</button>
                                            @csrf
                                            <button type="submit" class="btn delete-part-action delete-button">Add</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="{{ $answer->answer_id}}" tabindex="-1" role="dialog" aria-labelledby="{{ $answer->answer_id}}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <form class="modal-body-custom" action="{{ route('admin.answer.delete') }}" method="POST" >
                                        <div class="form-group custom-form-group">
                                            <span class="confirm-text">Are you sure to delete this question?</span>
                                            <input type="hidden" class="form-control" name="answer_id" value="{{ $answer->answer_id}}">
                                            <input type="hidden" class="form-control" name="question_id" value="{{$question_id}}">
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
            @endforeach
        </div>
    </div>
@stop
