<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sport;
use App\Models\User;
use App\Models\UserPoint;
use Session;

class ProfileController extends Controller
{
    public function index($user_id, $sport_id = NULL)
    {
        $sports = Sport::orderBy('created_at', 'desc')->get();
        $first_sport = $sports->first();
        $first_sport_id = $first_sport->sport_id;
        $username = $user_id;
        $pointList = UserPoint::join('answers', 'answers.answer_id', '=', 'userpoints.answer_id')
            ->join('questions', 'questions.id', '=', 'answers.question_id')
            ->join('games', 'games.game_id', '=', 'questions.game_id')
            ->where('userpoints.username', $username)
            ->select('userpoints.username', 'games.name as game', 'questions.name as question', 'answers.name as answer', 'answers.actual_points as point', 'games.game_id')
            ->get();

        $points = [];

        foreach ($pointList as $point) {
            if (!isset($points[$point['game_id']])) {
                $points[$point['game_id']]['gameName'] = $point->game;
                $points[$point['game_id']]['point'] = $point->point * 1;
                $points[$point['game_id']]['content'] = [$point];
            } else {
                $points[$point['game_id']]['content'] = array_merge($points[$point['game_id']]['content'], [$point]);
                $points[$point['game_id']]['point'] = $point->point * 1 + ($points[$point['game_id']]['point'] * 1);
            }
        }

        return view('profile', compact(['sports', 'sport_id', 'first_sport_id', 'points', 'username']));
    }
}
