<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ProfileRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Traits\TraitController;

class BrowseController extends Controller
{
    use TraitController;

    protected $userRepo;

    protected $profileRepo;

    private $storage = 'storage/json';

    public function __construct(UserRepository $userRepo, ProfileRepository $profileRepo)
    {
        $this->userRepo = $userRepo;
        $this->profileRepo = $profileRepo;
        $this->storage = base_path($this->storage);
    }

    public function index(Request $request)
    {
        $indonesia = [];
        $path = "$this->storage/indonesia.json";

        if (file_exists($path)) {
            $json = file_get_contents($path);
            $result = json_decode($json, true);
            foreach ($result as $k => $v) {
                array_push($indonesia, $v);
            }
        }

        if ($request->has('q')) {
            
            $collection = \App\User::when($request->q, function ($query) use ($request) {
                $query->member();
                $query->where(function($q) use ($request) {
                    $q->where('first_name', 'LIKE', '%'.$request->q.'%')
                        ->orWhere('last_name', 'LIKE', '%'.$request->q.'%');
                });
            });

            if ($request->has('skill')) {
                $skill = $request->get('skill');
                $collection->whereHas('profile', function($q) use ($skill) {
                        $q->whereHas('skillsets', function($q) use ($skill) {
                            $q->whereIn('profile_skill_set.id', $skill);
                        });
                    }
                );
            }

            if ($request->has('city')) {
                $city = str_replace(' ', '|', $request->city);
                $collection->whereHas('profile', function($q) use ($city) {
                    $q->where('location', 'regexp', $city);
                });
            }

            $model = $collection->with('profile')->paginate(10);
            
            $model->appends($request->only('q'));
            
            if ($request->ajax()) {
                return \Response::json(
                    \View::make('admins.browse.partials._result-browse', compact('model', 'indonesia'))->render()
                );
            }

        } else {
            
            $model = \App\User::member()->paginate(10);

            if ($request->ajax()) {
                return \Response::json(
                    \View::make('admins.browse.partials._result-browse', compact('model', 'indonesia'))->render()
                );
            }
        }

        return view('admins.browse.browse', compact('model', 'indonesia'));
    }
}
