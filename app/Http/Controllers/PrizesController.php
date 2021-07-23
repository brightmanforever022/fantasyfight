<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Models\Sport;
use App\Models\Prize;

class PrizesController extends Controller
{
    public function index() {
        $sport_id = NULL;
        $sports = Sport::orderBy('created_at', 'desc')->get();
        $first_sport = $sports->first();
        $first_sport_id = $first_sport->sport_id;
        if (Session::get("sport_id")) {
            $sport_id = Session::get("sport_id");
        }

        $results = Prize::all();

        return view('prizes', compact(['sports', 'sport_id', 'first_sport_id', 'results']));
    }

    public function filter($sportId = 'all', $rankId = 'all') {
        if ($sportId == 'all') {
            if($rankId == 'all') {
                $results = Prize::all();
            } else {
                $results = Prize::where('rank_id', $rankId)->get();
            }
        } else {
            if($rankId == 'all') {
                $results = Prize::where('sport_id', $sportId)->get();
            } else {
                $results = Prize::where('sport_id', $sportId)
                    ->where('rank_id', $rankId)
                    ->get();
            }
        }
        return $results;   
    }
}