<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Prize;

class AdminPrizeController extends Controller
{
    public function index() {
        $sport_id = NULL;
        $sports = Sport::orderBy('created_at', 'desc')->get();
        $first_sport = $sports->first();
        $first_sport_id = $first_sport->sport_id;
        if (Session::get("sport_id")) {
            $sport_id = Session::get("sport_id");
        }

        $results = [];
        return view('prizes', compact(['sports', 'sport_id', 'first_sport_id', 'results']));
    }

    public function update(Request $request)
    {
        $updateArr = array('sport_id' => $request->sport_id,
                             'rank_id' => $request->rank_id,
                                 'prize' => $request->prize,
        );

        if (Prize::where('sport_id', $request->sport_id)
                 ->where('rank_id', $request->rank_id)->update($updateArr)) {
            return redirect()->route('admin');
        };
    }
}