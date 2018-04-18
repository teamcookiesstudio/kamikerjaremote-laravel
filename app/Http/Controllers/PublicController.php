<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Cache;

class PublicController extends Controller
{
    public function search(Request $request)
    {
        if($request->has('page')) {
            $page = $request->q.'&page='.$request->query('page');
        } else {
            $page = $request->q;
        }
        $q = Cache::remember($page, 30, function() use($request){
            $user = User::when($request->q, function($query) use ($request) {
                $query->select(
                    'users.id', 'users.first_name', 'users.last_name', 'users.level',
                    'profiles.location', 'profiles.occupation', 'profiles.url_photo_profile')
                ->leftJoin('profiles', 'users.id', '=', 'profiles.member_id')
                ->where('users.level', User::ACCESS_MEMBER)
                ->where(function($query) use ($request){
                    $query->where('first_name', 'LIKE', '%'.$request->q.'%')
                            ->orWhere('last_name', 'LIKE', '%'.$request->q.'%');
                });
            })->paginate(10);
            $user->appends($request->only('q'));
            if ($request->ajax()) {
                return Response::json(View::make('search.result', compact('user'))->render());
            }
            return view('search.result', compact('user'))->render();
        });
        return $q;
    }

    public function viewProfile($name)
    {
        return view('profiles.view_profile', compact('profileHash'));
    }
}
