<?php

namespace App\Http\Controllers;

use App\Http\Traits\TraitController;
use App\User;
use Cache;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    use TraitController;

    public function search(Request $request)
    {
        if ($request->has('page')) {
            $page = $request->q.'&page='.$request->query('page');
        } else {
            $page = $request->q;
        }
        $q = Cache::rememberForever($page, function () use ($request) {
            $user = User::when($request->q, function ($query) use ($request) {
                $query->select(
                    'users.id', 'users.uuid', 'users.first_name', 'users.last_name', 'users.level',
                    'profiles.location', 'profiles.occupation', 'profiles.url_photo_profile')
                ->leftJoin('profiles', 'users.id', '=', 'profiles.member_id')
                ->where('users.level', User::ACCESS_MEMBER)
                ->where(function ($query) use ($request) {
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

    public function viewProfile($uuid)
    {
        $user = User::findByUuid($uuid);
        $image = $this->findImage($user->profile->url_photo_profile);

        return view('home', compact('user', 'image'));
    }
}
