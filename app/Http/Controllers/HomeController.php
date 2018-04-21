<?php

namespace App\Http\Controllers;

use App\Models\Portofolio;
use App\Models\SkillSet;
use App\Models\Profile;
use App\Http\Traits\TraitController;

class HomeController extends Controller
{
    use TraitController;
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
        $image = $this->findImage($user->profile->url_photo_profile);
        return view('home', compact('user', 'image'));
    }
}
