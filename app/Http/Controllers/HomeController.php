<?php

namespace App\Http\Controllers;

use App\Models\Portofolio;
use App\Models\SkillSet;
use App\Profile;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $skillset = [];
        $portofolios = Portofolio::findMember(auth()->user()->id)->get();
        $profile = Profile::where('member_id', $user->id)->first();
        foreach ($profile->skillsets()->get() as $skill) {
            $skillset[] = $skill->skill_set_name;
        }

        return view('home', compact('user', 'portofolios', 'skillset'));
    }
}
