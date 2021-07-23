<?php

namespace App\Http\Controllers;
use App\Models\Question;
use App\Models\Game;

use Session;

use Illuminate\Http\Request;

class AdminQuestionController extends Controller
{
    public function index($game_id)
    {
        $game_name = Game::where('game_id', $game_id)->first()->name;
        $questions = Question::where('game_id', $game_id)->orderBy('created_at', 'desc')->get();
        //dd(json_decode($games));
        //exit;

        return view('admin_questions', compact(['questions', 'game_id', 'game_name']));
    }

    //create question
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        Question::create([
            'game_id' => $request->game_id,
            'name' => $request->name
        ]);

        return redirect()->route('admin.questions.index', $request->game_id);
    }

    public function update(Request $request) {
        $arr = array(
            'name' => $request->name,
        );
        if(Question::where('id', $request->question_id)->update($arr)) {
            return redirect()->route('admin.questions.index', $request->game_id);
        };
    }

    public function delete(Request $request) {
        //dd("sport_id", $request->sport_id);
        //exit;
        //dd(Sport::where('sport_id', $request->sport_id)->get());
        if(Question::where('id', $request->question_id)->first()->delete()) {
            return redirect()->route('admin.questions.index', $request->game_id);
        }
    }

}
