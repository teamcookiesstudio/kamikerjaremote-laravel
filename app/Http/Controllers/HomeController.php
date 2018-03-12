<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('home', compact('user'));
    }

    public function search(Request $request)
    {
        $q = $request->get('q');
        return view('search.result', compact('q'));
    }

    public function viewProfile($profileHash)
    {
        return view('view_profile', compact('profileHash'));
    }
}
