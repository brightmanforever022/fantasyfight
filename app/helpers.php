<?php

use App\Models\GameUser;

function getMyCredits() {
    $user = GameUser::where("name", \Session::get('name'))->first();
    return $user ? $user->credit: 0;
}