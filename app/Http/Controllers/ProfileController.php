<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\SkillSet;
use App\Profile;
use Storage;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Profile $profile
     *
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
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request)
    {
        foreach ($request->skill_set_name as $value) {
            $skillset[] = SkillSet::firstOrCreate(['skill_set_name' => $value])->id;
        }
        $user = auth()->user();
        $user->update($request->only('first_name', 'last_name'));
        $profile = Profile::firstOrCreate(['member_id' => auth()->user()->id]);
        $profile->update($request->only('occupation', 'location', 'summary', 'website'));
        $profile->skillsets()->sync($skillset);
        if ($request->hasFile('url_photo_profile')) {
            if ($profile->url_photo_profile) {
                $file = Storage::disk('public')->delete('/profile/'.$profile->url_photo_profile);
            }
            $fileName = ''.uniqid().'.'.
            $request->file('url_photo_profile')->getClientOriginalExtension();
            $request->file('url_photo_profile')->move(storage_path().'/app/public/profile/', $fileName);

            $profile->url_photo_profile = $fileName;
            $profile->update();
        }
    }
}
