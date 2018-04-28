<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrowseController extends Controller
{
    public function index(Request $request)
    {
        $result = \App\Models\Profile::whereHas('skillsets', function($query) {
            $query->where('skill_set_name', 'PHP');
        })->get();

        return view('admins.browse.browse', compact('result'));
    }
}
