<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Question;

use Session;

class AdminAnswerController extends Controller
{
    public function index($question_id)
    {
        $question_name = Question::where('id', $question_id)->first()->name;
        $answers = Answer::where('question_id', $question_id)->orderBy('created_at', 'desc')->get();
        //dd(json_decode($games));
        //exit;

        return view('admin_answers', compact(['answers', 'question_id', 'question_name']));
    }

    //create answ
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        Answer::create([
            'question_id' => $request->question_id,
            'name' => $request->name,
            'answer_id' => "answer_".time(),
            'projected_points' => round(($request->point1 * 10 + $request->point2 * 20 + $request->point3 * 30 + $request->point4 * 40)/4)
        ]);

        return redirect()->route('admin.answers.index', $request->question_id);
    }

    public function update(Request $request) {
        $arr = array(
            'actual_points' => round(($request->actual_pts1 * 10 + $request->actual_pts2 * 20 + $request->actual_pts3 * 30 + $request->actual_pts4 * 40)/4)
        );
        if(Answer::where('answer_id', $request->answer_id)->update($arr)) {
            return redirect()->route('admin.answers.index', $request->question_id);
        };
    }

    public function delete(Request $request) {
        if(Answer::where('answer_id', $request->answer_id)->first()->delete()) {
            return redirect()->route('admin.answers.index', $request->question_id);
        }
    }
}
