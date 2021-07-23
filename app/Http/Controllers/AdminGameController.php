<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

use Session;

class AdminGameController extends Controller
{
    public function index($sport_id)
    {
        $games = Game::where('sport_id', $sport_id)->orderBy('created_at', 'desc')->get();
        //dd(json_decode($games));
        //exit;

        return view('admin_games', compact(['games', 'sport_id']));
    }

    //create game
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $offset = $request->offset * 60;
        $start_date_local = strtotime($request->game_start_day . " " . $request->game_start_time);
        $start_based_date = $start_date_local + $offset;
        $start_based_day = date('Y-m-d', $start_based_date);
        $start_based_time = date('H:i:s', $start_based_date);
        $end_date_local = strtotime($request->game_end_day . " " . $request->game_end_time);
        $end_based_date = $end_date_local + $offset;
        $end_based_day = date('Y-m-d', $end_based_date);
        $end_based_time = date('H:i:s', $end_based_date);

        Game::create([
            'sport_id' => $request->sport_id,
            'name' => $request->name,
            'game_id' => str_replace(':', '-', str_replace('.', '-', str_replace(' ', '-', $request->name))),
            'game_start_day' => $start_based_day,
            'game_start_time' => $start_based_time,
            'game_end_day' => $end_based_day,
            'game_end_time' => $end_based_time,
            'game_url' => $request->stream,
            'game_fired' => false
        ]);

        return redirect()->route('admin.game.index', $request->sport_id);
    }

    public function update(Request $request)
    {

        $offset = $request->offset * 60;
        $start_date_local = strtotime($request->game_start_day . " " . $request->game_start_time);

        $start_based_date = $start_date_local + $offset;
        $start_based_day = date('Y-m-d', $start_based_date);
        $start_based_time = date('H:i:s', $start_based_date);
        $end_date_local = strtotime($request->game_end_day . " " . $request->game_end_time);
        $end_based_date = $end_date_local + $offset;
        $end_based_day = date('Y-m-d', $end_based_date);
        $end_based_time = date('H:i:s', $end_based_date);

        $isExistHideStatus = isset($request->hide);

        if (!$isExistHideStatus) {
            $arr = array(
                'name' => $request->name,
                'game_start_day' => $start_based_day,
                'game_start_time' => $start_based_time,
                'game_end_day' => $end_based_day,
                'game_end_time' => $end_based_time,
                'game_url' => $request->stream,
                'game_fired' => ($request->firedcheck == 'on') ? true : false
            );
        } else {
            $arr = array(
                'game_fired' => $request->hide
            );
        }

        if (Game::where('game_id', $request->game_id)->update($arr)) {
            return redirect()->route('admin.game.index', $request->sport_id);
        };
    }

    public function delete(Request $request)
    {
        //dd("sport_id", $request->sport_id);
        //exit;
        //dd(Sport::where('sport_id', $request->sport_id)->get());
        if (Game::where('game_id', $request->game_id)->first()->delete()) {
            return redirect()->route('admin.game.index', $request->sport_id);
        }
    }
}
