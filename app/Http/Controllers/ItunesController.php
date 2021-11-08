<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Json;

class ItunesController extends Controller
{
    public function itunes()
    {
        $response = Http::get("https://rss.applemarketingtools.com/api/v2/be/music/most-played/12/songs.json");
//        dd($response);

        $feed = $response['feed'];
        $results = $response['feed']['results'];
        $results = collect($results);

        $result = compact("feed", "results");
        Json::dump($result);
        return view('itunes', $result);
    }

}
