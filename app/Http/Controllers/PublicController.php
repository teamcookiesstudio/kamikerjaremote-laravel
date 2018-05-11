<?php

namespace App\Http\Controllers;

use App\Http\Traits\TraitController;
use App\User;
use Cache;
use Illuminate\Http\Request;
use Response;
use View;

class PublicController extends Controller
{
    use TraitController;

    public function search(Request $request)
    {
        // if ($request->has('page')) {
        //     $page = $request->q.'&page='.$request->query('page');
        // } else {
        //     $page = $request->q;
        // }

        // $result = Cache::tags('search')->get($request->q);

        //     if (!empty($result)) {
        //         $cek = is_string($result) ? true : false;
        //         if ($cek) {
        //             Cache::tags('search')->flush($request->q);
        //         }
        //     }

        //$q = Cache::tags('search')->rememberForever($page, function () use ($request) {

            $user = User::when($request->q, function ($query) use ($request) {
                $query->member()
                    ->where(function ($query) use ($request) {
                        $query->where('first_name', 'LIKE', '%'.$request->q.'%')
                                ->orWhere('last_name', 'LIKE', '%'.$request->q.'%');
                });
        })->paginate(10);

        $user->appends($request->only('q'));

            if ($request->ajax()) {
                $view = view('search.partial-result', compact('user'))->render();
                return Response::json($view);
            }

        return view('search.result', compact('user'))->render();
        //});

        //return $q;
    }

    public function viewProfile($uuid)
    {
        $user = User::findByUuid($uuid);
        $image = $this->findImage($user->profile->url_photo_profile);

        return view('home', compact('user', 'image'));
    }
}
