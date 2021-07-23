<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Sport;
use DateTime;
use DateTimeZone;
use Session;

class LeaderBoardController extends Controller
{
    public function index()
    {
        $sport_id = NULL;
        $sports = Sport::orderBy('created_at', 'desc')->get();
        $first_sport = $sports->first();
        $first_sport_id = $first_sport->sport_id;
        if (Session::get("sport_id")) {
            $sport_id = Session::get("sport_id");
        }

        $results = DB::table('userpoints')
            ->select('userpoints.username as name', DB::raw("SUM(actual_points) as actual_points"), DB::raw("count(DISTINCT questions.game_id, userpoints.created_at) as counts"))
            ->join('answers', 'userpoints.answer_id', '=', 'answers.answer_id')
            ->join('questions', 'userpoints.question_id', '=', 'questions.id')
            ->groupBy('userpoints.username')
            ->orderBy('actual_points', 'desc')
            ->get();
        //dd($results);
        return view('leaderboard', compact('sports', 'first_sport_id', 'sport_id', 'results'));
    }

    public function show($sportId = 'all', $periodFlag = 'all')
    {

        $startDatetime = '';
        $endDatetime = '';
        $newDateTime = new DateTime("now", new DateTimeZone("America/Chicago"));
        switch ($periodFlag) {
            case 'year':
                $startDatetime = date('Y') . '-01-01 23:00:00 America/Chicago';
                $endDatetime = date('Y') . '-12-31 22:59:59 America/Chicago';
                break;

            case 'month':
                $startDatetime = date('Y-m') . '-01 23:00:00 America/Chicago';
                $endDatetime = date('Y-m-t') . ' 22:59:59 America/Chicago';
                break;

            case 'week':
                $day = $newDateTime->format("w");
                if ($day == 0 && $newDateTime->format("H:i:s") < '23:00:00') {
                    $day = 7;
                }
                $startDatetime = date('Y-m-d', strtotime('-' . $day . ' days '. $newDateTime->format("Y-m-d"))) . ' 23:00:00 America/Chicago';
                $endDatetime = date('Y-m-d H:i:s', strtotime($startDatetime. " ". "+1 week"));
                break;
            case 'day':
                $day = $newDateTime->format("w");

                $startDatetime = date('Y-m-d', strtotime('-' . 1 . ' days')) . ' 23:00:00 America/Chicago';
                $endDatetime = date('Y-m-d', strtotime('+' . 1 . ' days')) . ' 22:59:59 America/Chicago';
        }

        if ($periodFlag != "all") {
            $startDatetime = gmdate('Y-m-d H:i:s', strtotime($startDatetime));
            $endDatetime = gmdate('Y-m-d H:i:s', strtotime($endDatetime));
        }


        if ($sportId == 'all') {
            if ($periodFlag == 'all') {
                $results = DB::table('userpoints')
                    ->select('userpoints.username as name', DB::raw("SUM(actual_points) as actual_points"), DB::raw("count(DISTINCT questions.game_id, userpoints.created_at) as counts"))
                    ->join('answers', 'userpoints.answer_id', '=', 'answers.answer_id')
                    ->join('questions', 'answers.question_id', '=', 'questions.id')
                    ->groupBy('userpoints.username')
                    ->orderBy('actual_points', 'desc')
                    ->get();
            } else {
                $results = DB::table('userpoints')
                    ->select('userpoints.username as name', DB::raw("SUM(actual_points) as actual_points"), DB::raw("count(DISTINCT questions.game_id, userpoints.created_at) as counts"))
                    ->join('answers', 'userpoints.answer_id', '=', 'answers.answer_id')
                    ->join('questions', 'answers.question_id', '=', 'questions.id')
                    ->whereBetween('userpoints.created_at', [$startDatetime, $endDatetime])
                    ->groupBy('userpoints.username')
                    ->orderBy('actual_points', 'desc')
                    ->get();
            }
        } else {
            if ($periodFlag == 'all') {
                $results = DB::table('userpoints')
                    ->select('userpoints.username as name', DB::raw("SUM(actual_points) as actual_points"), DB::raw("count(DISTINCT questions.game_id, userpoints.created_at) as counts"))
                    ->join('answers', 'userpoints.answer_id', '=', 'answers.answer_id')
                    ->join('questions', 'answers.question_id', '=', 'questions.id')
                    ->join('games', 'games.game_id', '=', 'questions.game_id')
                    ->join('sports', 'games.sport_id', '=', 'sports.sport_id')
                    ->where('sports.sport_id', $sportId)
                    ->groupBy('userpoints.username')
                    ->orderBy('actual_points', 'desc')
                    ->get();
            } else {
                $results = DB::table('userpoints')
                    ->select('userpoints.username as name', DB::raw("SUM(actual_points) as actual_points"), DB::raw("count(DISTINCT questions.game_id, userpoints.created_at) as counts"))
                    ->join('answers', 'userpoints.answer_id', '=', 'answers.answer_id')
                    ->join('questions', 'answers.question_id', '=', 'questions.id')
                    ->join('games', 'games.game_id', '=', 'questions.game_id')
                    ->join('sports', 'games.sport_id', '=', 'sports.sport_id')
                    ->whereBetween('userpoints.created_at', [$startDatetime, $endDatetime])
                    ->where('sports.sport_id', $sportId)
                    ->groupBy('userpoints.username')
                    ->orderBy('actual_points', 'desc')
                    ->get();
            }
        }

        return $results;
    }
}
