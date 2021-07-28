@extends('layouts.app')

@section('title', $sport_name)

@section('headerbar')
    @parent
@stop

@section('content')
    <div class="game-body">
        <span class="game-title">{{$game_name}}</span>
        @foreach($questions as $question)
        <span class="game-sub-title">
                {{$question->name}}
        </span>
        <div class="selected-groups">
            <div class="selected-group">
                @foreach($question->answers as $answer)
                    @if(in_array($answer->answer_id, $answers_arr))
                    <div class="pick-item pick-checked">
                        <input class="question" type="hidden" value="{{$question->id}}" name="question_id"/>
                        <input class="answer" type="hidden" value="{{$answer->answer_id}}" name="answer_id"/>
                        <div class="pick-item-names">
                            <span class="pick-item-label">{{$answer->name}}</span>
                        </div>
                        <div class="pick-item-amount">
                            <span class="pick-item-number">{{$answer->projected_points}}</span>
                            <span class="pick-item-number-comment">PROJECTED FFL PTS</span>
                        </div>
                    </div>
                    @else
                    <div class="pick-item">
                        <input class="question" type="hidden" value="{{$question->id}}" name="question_id"/>
                        <input class="answer" type="hidden" value="{{$answer->answer_id}}" name="answer_id"/>
                        <div class="pick-item-names">
                            <span class="pick-item-label">{{$answer->name}}</span>
                        </div>
                        <div class="pick-item-amount">
                            <span class="pick-item-number">{{$answer->projected_points}}</span>
                            <span class="pick-item-number-comment">PROJECTED FFL PTS</span>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
        @endforeach
        <span class="game-credit">Unlimited Games for $5 per Month</span>
        @if(getMyCredits())
            <div class="submit-box">
                <button id="qa_result" class="btn submit-btn">Submit</button>
            </div>
        @else
            <div class="submit-box">
                <button id="qa_result_paywall" class="btn  submit-btn" onclick="initiateStripeSession(1)">Submit</button>
            </div>
        @endif
    </div>

    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <p style="font-family: KanedaLight; font-size: 45px; font-weight: 900; margin-bottom: 0px;">PLEASE LOG IN FIRST</p>
                    <button class="btn login-btn" data-toggle="modal" data-target="#loginModal" data-dismiss="modal">LOGIN</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="selectAnswersModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <p style="font-family: KanedaLight; font-size: 45px; font-weight: 900; margin-bottom: 0px;">Please select answers.</p>
                    <button class="btn login-btn" data-toggle="modal" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal" id="successModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <p style="font-family: KanedaLight; font-size: 45px; font-weight: 900; margin-bottom: 0px; line-height: 50px;">
                        Congratulations, your picks have been received
                    </p>
                    <button class="btn redirect-btn" data-toggle="modal" data-dismiss="modal">OK</a>
                </div>
            </div>
        </div>
    </div>
@stop
