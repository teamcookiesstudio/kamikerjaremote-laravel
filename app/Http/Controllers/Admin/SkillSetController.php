<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\SkillSetRepository;

class SkillSetController extends Controller
{
    protected $repo;

    public function __construct(SkillSetRepository $repo)
    {
        $this->repo = $repo;
    }

    public function data(Request $request)
    {
        return \App\Models\SkillSet::all()->toArray();
    }
}
