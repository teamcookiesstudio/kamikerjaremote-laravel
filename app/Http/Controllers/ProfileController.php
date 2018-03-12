<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        $user = auth()->user();
        $profile = Profile::firstOrCreate(['member_id' => auth()->user()->id]);
        return view('profiles.edit', compact('user', 'profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function update(ProfileRequest $request)
    {
        $user = auth()->user();
        $user->update($request->only('first_name', 'last_name'));
        $profile = Profile::firstOrCreate(['member_id' => auth()->user()->id]);
        $profile->update($request->only('occupation', 'location', 'summary'));
		return redirect()->route('home');
    }
    
}
