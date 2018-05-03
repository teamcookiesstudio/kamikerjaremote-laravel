<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ProfileRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class BrowseController extends Controller
{
    protected $userRepo;

    protected $profileRepo;

    public function __construct(UserRepository $userRepo, ProfileRepository $profileRepo)
    {
        $this->userRepo = $userRepo;
        $this->profileRepo = $profileRepo;
    }

    public function index(Request $request)
    {
        $result = $this->profileRepo->whereHas('skillsets', function ($query) {
            $query->where('skill_set_name', 'PHP');
        })->get();

        if ($request->ajax()) {
        }

        $model = $this->userRepo->paginate(10)->except(\Auth::id());

        return view('admins.browse.browse', compact('model'));
    }
}
