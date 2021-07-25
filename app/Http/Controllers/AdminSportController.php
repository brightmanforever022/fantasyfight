<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sport;
use App\Models\Prize;
use Illuminate\Support\Facades\Storage;
use Session;

class AdminSportController extends Controller
{
    public function index()
    {
        $sports = Sport::orderBy('created_at', 'desc')->get();
        //dd(json_decode($sports));
        // exit;

        return view('admin_sports', compact('sports'));
    }

    //create sport
    public function store(Request $request)
    {
        $imageUrl = "";
        $description = "";
        $redirectUrl = "";

        if ($request->splashEnabled) {
            if ($request->hasFile("image")) {
                $imageUrl = $request->file("image")->storePublicly("images");
            }
            $description = $request->description;
            $redirectUrl = $request->redirectUrl;
        }
        $request->validate([
            'name' => 'required',
            'sport_id' => str_replace(':', '-', str_replace('.', '-', str_replace(' ', '-', $request->name)))
        ]);
        Sport::create([
            'name' => $request->name,
            'sport_id' => str_replace(':', '-', str_replace('.', '-', str_replace(' ', '-', $request->name))),
            'image' => $imageUrl,
            'description' => $description,
            'redirect_url' => $redirectUrl
        ]);
        
        for ( $i = 1; $i < 11; $i++ ) {
            Prize::create([
                'sport_id' => str_replace(':', '-', str_replace('.', '-', str_replace(' ', '-', $request->name))),
                'rank_id' => $i,
                'prize' => 0
            ]);
        }
        
        return redirect()->route('admin');
    }
    public function update(Request $request)
    {

        $imageUrl = "";
        $description = "";
        $redirectUrl = "";

        if ($request->splashUpdateEnabled) {
            if ($request->hasFile("image")) {
                $imageUrl = $request->file("image")->storePublicly("images");
            }
            $redirectUrl = $request->redirectUrl;
            $description = $request->description;
        }
        $request->validate([
            'name' => 'required',
        ]);

        $updateArr = array('name' => $request->name, 'description' => $description, 'image' => $imageUrl, 'redirect_url' => $redirectUrl);

        if (Sport::where('sport_id', $request->sport_id)->update($updateArr)) {
            return redirect()->route('admin');
        };
    }

    public function delete(Request $request)
    {
        //dd("sport_id", $request->sport_id);
        //exit;
        //dd(Sport::where('sport_id', $request->sport_id)->get());

        if (Sport::where('sport_id', $request->sport_id)->first()->delete()) {
            Prize::where('sport_id', $request->sport_id)->delete();
            return redirect()->route('admin');
        }
    }
}
