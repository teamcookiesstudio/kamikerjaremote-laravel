<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portofolio;
use App\Profile;
use App\Models\SkillSet;
use Cache;
use Illuminate\Support\Facades\Redis;

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
    public function index(Request $request)
    {
        $page = Cache::get('home');
        if($page != null){
            return $page;
        }
        
        return $this->getIndex();
    }

    public function getIndex()
    {
        $user = auth()->user();
        $arr = [];
        $portofolios = Portofolio::findMember(auth()->user()->id)->get();
        $profile = Profile::where('member_id', $user->id)->first();
        foreach($profile->skillsets()->get() as $skill){
            $skillset[] = $skill->skill_set_name;
        }
        return view('home', compact('user', 'portofolios', 'skillset'))->render();
    }
}
