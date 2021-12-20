<?php

namespace App\Http\Controllers\Admin;

use App\genre;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Json;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::orderBy('name')
            ->withCount('records')
            ->get();
        $result = compact('genres');
        Json::dump($result);
        return view('admin.genres.index', $result);
    }

    public function show(Genre  $genre)
    {
        return redirect('admin/genres');
    }

    public function edit(Genre $genre)
    {
        $result = compact('genre');
        Json::dump($result);
        return view('admin.genres.edit', $result);
    }

    public function update(Request $request, Genre $genre)
    {
        // Validate $request
        $this->validate($request,[
            'name' => 'required|min:3|unique:genres,name,' . $genre->id
        ]);

        // Update genre
        $genre->name = $request->name;
        $genre->save();

        // Flash a success message to the session
        session()->flash('success', 'The genre has been updated');
        // Redirect to the master page
        return redirect('admin/genres');
    }

    public function create()
    {
        return view('admin.genres.create');
    }

    public function store(Request $request)
    {
        // Validate $request
        $this->validate($request,[
            'name' => 'required|min:3|unique:genres,name'
        ]);

        // Create new genre
        $genre = new Genre();
        $genre->name = $request->name;
        $genre->save();

        // Flash a success message to the session
        session()->flash('success', "The genre <b>$genre->name</b> has been added");
        // Redirect to the master page
        return redirect('admin/genres');
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();
        session()->flash('success', "The genre <b>$genre->name</b> has been deleted");
        return redirect('admin/genres');
    }
}
