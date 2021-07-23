<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserPoint;
use App\Models\Sport;
use App\Models\EmailGroup;
use App\Models\GameUser;
use DateTime;
use Session;


class UserPointsController extends Controller
{
    //create user points
    public function store(Request $request)
    {

        $user = GameUser::where("name", Session::get('name'))->first();

        if (!$user) {
            return response("", 401);
        }
        if ($user->credit == 0) {
            return response("", 403);
        }

        $request->validate([
            'qa' => 'required|array|min:1'
        ]);
        $createdAt = date("Y-m-d H:i:s");
        foreach($request->qa as $req) {
            UserPoint::create([
                'username' => Session::get('name'),
                'question_id' => $req['question_id'],
                'answer_id' => $req['answer_id'],
                'created_at' => $createdAt
            ]);
        }
        $user->credit -= 1;
        $user->save();

        // $current_emails = Sport::where('sport_id', $request->sport_id)->first()->emails_group;
        // if($current_emails != "") {
        //     $current_emails = $current_emails." , ".Session::get("email");
        // } else {
        //     $current_emails = Session::get("email");
        // }
        // $arr = array(
        //     'emails_group' => $current_emails
        // );

        // Sport::where('sport_id', $request->sport_id)->update($arr);

        EmailGroup::create([
            'sport_id' => $request->sport_id,
            'email' => Session::get("email")
        ]);

        return response()->json(['success'=>true]);

        //return redirect()->route('admin.game.index', $request->sport_id);
    }
}
