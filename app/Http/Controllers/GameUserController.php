<?php

namespace App\Http\Controllers;

use App\Models\GameUser;
use App\Models\Sport;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GameUserController extends Controller
{
    public function login(Request $request)
    {
        $validater = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $mathchTese = [
            'email' => $request->email
        ];
        $result = GameUser::where($mathchTese)
            ->first();
        if ($result) {

            $result->makeVisible(["password"]);

            if (!Hash::check($request->password, $result->password)) {
                return 'error';
            }

            Session::put('email', $result->email);
            Session::put('name', $result->name);
            return 'success';
        } else {
            return 'error';
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:gameusers,name',
            'email' => 'required|unique:gameusers,email',
            'password' => 'required|min:8',
            'terms' => 'accepted'
        ]);
        GameUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'terms' => ($request->terms == 'on') ? true : false
        ]);

        $mathchTese = [
            'email' => $request->email
        ];
        $result = GameUser::where($mathchTese)
            ->first();
        $result->makeVisible(["password"]);

        if (!Hash::check($request->password, $result->password)) {
            return 'error';
        }

        Session::put('email', $result->email);
        Session::put('name', $result->name);
        
        return redirect()->route('user.completed');
    }

    public function completed()
    {
        $sport_id = NULL;
        $sports = Sport::orderBy('created_at', 'desc')->get();
        $first_sport = $sports->first();
        $first_sport_id = $first_sport->sport_id;
        $current = date('Y-m-d h:i:sa');

        return view(
            'completed',
            compact(['sports', 'sport_id', 'first_sport_id', 'current'])
        );
    }
}
