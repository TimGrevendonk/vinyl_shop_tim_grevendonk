<?php

namespace App\Http\Controllers;

use App\genre;
use Json;
use App\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShopController extends Controller
{
    // master page (.../shop)
    public function index(Request $request)
    {
        $genre_id = $request->input("genre_id") ?? '%';
        $artist_title = "%" . $request->input("artist") . "%";

        $order = Genre::orderBy('id')->get();
        $genres = Genre::orderBy('name')           // short version of orderBy('name', 'asc')
        ->has("records")                // only genres that have one or more records
        ->withCount("records")          // add new property "record_count" to the genre model/objects
        ->get()
            ->transform(function ($genre, $key) {
                // give genre name a capital letter, and hide the fields that are not used.
                $genre->name = ucfirst($genre->name) . " ({$genre->records_count})";
                return $genre;
            })
            ->makeHidden(['created_at', 'updated_at', 'records_count']);    // Remove all fields that you don't use inside the view

        $records = Record::with("genre")
            ->orderBy('artist')
            ->where([
                ['artist', 'like', $artist_title],
                ['genre_id', 'like', $genre_id]
            ])
            ->orWhere([
                ['title', 'like', $artist_title],
                ['genre_id', 'like', $genre_id]
            ])
            ->paginate(12) // get all records, and show 12 per page
            // OR ->appends(['artist' => $request->artist, 'genre_id' => $request->genre_id]);
            ->appends(['artist' => $request->artist, 'genre_id' => $request->input('genre_id')]);

        foreach ($records as $record) {
            $record->badge = ($record->stock > 0) ? "badge-success" : "badge-danger";
            $record->price = number_format($record->price, 2);
            $record->genre->name = ucfirst($record->genre->name);

            // if statement,
            $record->cover = $record->cover ?? "https://coverartarchive.org/release/{$record->title_mbid}/front-250.jpg";
        }


        $result = compact("genres", 'records', 'order');           // compact('records') is the same as ['records' => $records]
        Json::dump($result);                        // open http://vinyl_shop.test/shop?json
        return view('shop.index', $result);    // add $result as second parameter
    }


    // details page (.../shop/{id})
    public function show($id)
    {
        $record = Record::with('genre')->findOrFail($id);

        // Real path to cover image
        $record->cover = $record->cover ?? "https://coverartarchive.org/release/$record->title_mbid/front-500.jpg";
        // Combine artist + title
        $record->title = $record->artist . ' - ' . $record->title;
        // Links to MusicBrainz API
        // https://wiki.musicbrainz.org/Development/JSON_Web_Service
        $record->recordUrl = 'https://musicbrainz.org/ws/2/release/' . $record->title_mbid . '?inc=recordings+url-rels&fmt=json';
        // If stock > 0: button is green, otherwise the button is red
        // and add disabled if the record is not in stock.
        $record->btnClass = $record->stock > 0 ? 'btn-outline-success' : 'btn-outline-danger disabled';
        // You can't overwrite the attribute genre (object) with a string, so we make a new attribute
        $record->genreName = $record->genre->name;
        // set the price to 2 decimals
        $record->price = number_format($record->price, 2);
        // Hide attributes you don't need for the view
        $record->makeHidden(['genre', 'artist', 'genre_id', 'created_at', 'updated_at', 'title_mbid', 'genre']);

        // get record info and convert it to json
        $response = Http::get($record->recordUrl)->json();
        $tracks = $response['media'][0]['tracks'];
        $tracks = collect($tracks)
            ->transform(function ($item, $key) {
                $item['length'] = date('i:s', $item['length'] / 1000);      // PHP works with sec, not ms!!!
                unset($item['id'], $item['recording'], $item['number']);
                return $item;
            });

        $result = compact('tracks', 'record');
        Json::dump($result);
        return view('shop.show', $result);  // Pass $result to the view
    }

    // alternative master mage (.../shop_alt)
    public function show_alt(Request $request)
    {
        $genres = Genre::orderBy('name')           // short version of orderBy('name', 'asc')
        ->has("records")                // only genres that have one or more records
        ->get()
            ->transform(function ($genre, $key) {
                // give genre name a capital letter, and hide the fields that are not used.
                $genre->name = ucfirst($genre->name);
                return $genre;
            })
            ->makeHidden(['created_at', 'updated_at', 'records_count']);    // Remove all fields that you don't use inside the view

        $records = Record::with("genre")
            ->orderBy('artist')
            ->get();

        foreach ($records as $record) {
            $record->price = number_format($record->price, 2);
            $record->genre->name = ucfirst($record->genre->name);

            // if statement,
            $record->cover = $record->cover ?? "https://coverartarchive.org/release/{$record->title_mbid}/front-250.jpg";
        }

        $result = compact("genres", 'records');           // compact('records') is the same as ['records' => $records]
        Json::dump($result);                        // open http://vinyl_shop.test/shop?json
        return view('shop.shop_alt', $result);    // add $result as second parameter

    }

}
