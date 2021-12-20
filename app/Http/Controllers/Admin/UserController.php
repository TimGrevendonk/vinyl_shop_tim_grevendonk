<?php

namespace App\Http\Controllers\Admin;

use Json;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id')
            ->paginate(12);

        $result = compact('users');
        Json::dump($result);
        return view('admin.users.index', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('admin/users');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return redirect('admin/users');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $result = compact('user');
        Json::dump($result);
        return view('admin.users.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // Validate $request
        $this->validate($request,[
                // The ". $user->id" will exclude the current user from the uniqueness check.
                // So if the field is not changed it will not throw an error that it already exists.
            'name' => 'required|min:3|unique:users,name,' . $user->id,
            'email' => 'required|min:3|unique:users,email,' . $user->id

        ]);
            // if active is 1 (checked) set the users to active.
        if($request->active == 1) {
            $user->active = 1;
        } else {
            $user->active = 0;
        }
            // if admin is 1 (checked) set the users to admin.
        if($request->admin == 1) {
            $user->admin = 1;
        } else {
            $user->admin = 0;
        }

        // Update User name and email.
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        // Flash a success message to the session
        session()->flash('success', "The user has been updated");
        // Redirect to the master page
        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('success', `The user <b>$user->name</b> has been deleted`);
        return redirect('admin/users');
    }
}
