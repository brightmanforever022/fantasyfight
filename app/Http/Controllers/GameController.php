<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sport;
use App\Models\Game;
use App\Models\Question;
use App\Models\Answer;
use App\Models\UserPoint;
use DB;
use Session;

class GameController extends Controller
{
    public function index($sport_id, $game_id)
    {
        $sports = Sport::orderBy('created_at', 'desc')->get();
        $first_sport = $sports->first();
        $sport = Sport::where('sport_id', $sport_id)->first();
        $sport_name = $sport->name ?? "";

        $first_sport_id = $first_sport->sport_id;
        $game_name = Game::where('game_id', $game_id)->first()->name ?? "";
        $questions = Question::with('answers')->where('game_id', $game_id)->get();
        $answers = UserPoint::where('username', Session::get('name'))->get();
        $isSubmitted = false;

        $answers_arr = array();
        // foreach ($answers as $answer) {
        //     array_push($answers_arr, $answer->answer_id);
        // }

        for ($i = 0; $i < count($answers); $i++) {
            $questionId = $answers[$i]->question_id;

            if ($questionId) {
                $game = Question::find($questionId);

                if ($game_id == $game->game_id) {
                    $isSubmitted = true;
                    break;
                }
            }
        }

        // exit;

        //dd(json_decode($questions));
        // $questions= DB::table('questions')
        // ->join('answers', 'questions.question_id', '=', 'answers.question_id')
        // ->select('answers.*','questions.*')
        // ->where('questions.game_id','=',$game_id)
        // ->get();
        //dd(json_decode($questions));

        return view('game', compact('sports', 'first_sport_id', 'sport_id', 'sport_name', 'questions', 'game_name', 'answers_arr', 'isSubmitted'));
    }
}
