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

        $name = ['url_photo_profile' => $profile->url_photo_profile, 'image_header' => $profile->image_header];
        foreach ($name as $key => $value) {
            if ($request->hasFile($key)) {
                if ($value) {
                    $file = Storage::disk('public')->delete('/profile/'.$value);
                }
                $fileName = ''.uniqid().'.'.
                $request->file($key)->getClientOriginalExtension();
                $request->file($key)->move(storage_path().'/app/public/profile/', $fileName);

                if ($key == 'url_photo_profile') {
                    $profile->url_photo_profile = $fileName;
                } else {
                    $profile->image_header = $fileName;
                }
                $profile->update();
            }
        }
    }
}
