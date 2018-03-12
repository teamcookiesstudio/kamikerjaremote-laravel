<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;

class ProfileController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        $profile = Profile::firstOrCreate(['member_id' => auth()->user()->id]);
        $user = auth()->user();
        return view('layouts.profiles.show', compact('profile', 'user'));
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        $profile = Profile::firstOrCreate(['member_id' => auth()->user()->id]);
        return view('layouts.profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request)
    {
        $profile = Profile::firstOrCreate(['member_id' => auth()->user()->id]);
        $profile->update('current_position', 'location', 'summary');
		return redirect()->route('layouts.profiles.show');
    }
    
}
