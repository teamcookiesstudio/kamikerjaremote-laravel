<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\ProfileRepository;

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
        $result = $this->profileRepo->whereHas('skillsets', function($query) {
            $query->where('skill_set_name', 'PHP');
        })->get();

        $model = $this->userRepo->paginate(10);

        return view('admins.browse.browse', compact('model'));
    }
}
