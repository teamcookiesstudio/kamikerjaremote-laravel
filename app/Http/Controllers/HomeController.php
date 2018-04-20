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
        $portofolios = Portofolio::findMember(auth()->user()->id)->get();
        $profile = Profile::where('member_id', $user->id)->first();
        $skillset = $this->getSkill($profile->skillsets()->get());

        return view('home', compact('user', 'portofolios', 'skillset'));
    }

    private function getSkill($param)
    {
        $skillset = [];
        foreach ($param as $skill) {
            $skillset[] = $skill->skill_set_name;
        }

        return $skillset;
    }
}
