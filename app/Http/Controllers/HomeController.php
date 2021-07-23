<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sport;
use App\Models\Game;
use Session;

class HomeController extends Controller
{
    public function index($sport_id = NULL)
    {

        $sports = Sport::orderBy('created_at', 'desc')->get();
        $first_sport = $sports->first();
        $first_sport_id = $first_sport->sport_id;
        $current = date('Y-m-d h:i:sa');

        if ($sport_id) {
            $sport = Sport::where('sport_id', $sport_id)->first();
        } else {
            $sport = Sport::where('sport_id', $first_sport_id)->first();
        }
        $sport_name = $sport->name ?? "";
        //dd(date($date." ".$time));
        //dd(date('Y-m-d h:i:sa'));
        // if(strtotime($date." ".$time) < strtotime(date('Y-m-d h:i:sa'))) {
        //     dd("Passed");
        // } else {
        //     dd("Future");
        // }
        // exit;

        if ($sport_id) {
            Session::put("sport_id", $sport_id);
            $games = Game::where('sport_id', $sport_id)->orderBy('created_at', 'desc')->get();
        } else {
            Session::put("sport_id", $first_sport_id);
            $games = Game::where('sport_id', $first_sport_id)->orderBy('created_at', 'desc')->get();
        }

        $time = strtotime(date('Y-m-d h:i:sa'));

        return view('home', compact(['sports', 'first_sport_id', 'sport_id', 'sport_name', 'games', 'current', 'sport', 'time']));
    }
    public function logout()
    {
        Session::forget('email');
        Session::forget('name');
        Session::forget('sport_id');
        // dd(Session::get('email'));
        // exit;
        // return response().json(['logout', 'success']);

        return redirect()->to('/');
    }
}
