<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->profile == null) {
            return redirect("profile/create");
        }
        return view('profile/index')->with("profile", auth()->user()->profile);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->profile == null) {
            $profile = new Profile();
            $profile->user_id = auth()->user()->id;
            $profile->save();
            return redirect("/profile");
        } else {
            abort(401);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $profile = $user->profile;

        if($request->input("username") != null) {
            $user->username = $request->input("username");
        }
        if($request->input("email") != null) {
            $user->email = $request->input("email");
        }

        $profile->first_name = $request->input("first_name");
        $profile->last_name = $request->input("last_name");
        $profile->discord = $request->input("discord");
        $profile->phone = $request->input("phone");
        $profile->location = $request->input("location");
        $profile->signature = $request->input("signature");

        $user->save();
        $profile->save();
        return redirect("/profile")->with("success", "Updated your profile!");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
