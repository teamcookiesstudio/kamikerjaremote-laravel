<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('perPage', 3);
        if ($perPage > 20) {
            $perPage = 20;
        }

        $members = User::member();
        $status = $request->get('status', 'all');

        switch ($status) {
            case 'approved':
                $members = $members->approved()->paginate($perPage);
                break;
            case 'rejected':
                $members = $members->rejected()->paginate($perPage);
                break;
            case 'waiting':
                $members = $members->waitingApproval()->paginate($perPage);
                break;
            case 'all':
            default:
                $members = $members->paginate($perPage);
                break;
        }

        $param = compact('members', 'perPage', 'ownerName');
        if ($status !== 'all') {
            $param = compact('members', 'status', 'perPage', 'ownerName');
        }

        return view('members.index', $param);
    }

    public function approve(User $user)
    {
        $user->update(['is_approved' => true, 'reviewed_by' => auth()->user()->id]);

        return redirect()->route('members.index');
    }

    public function reject(User $user)
    {
        $user->update(['is_approved' => false, 'reviewed_by' => auth()->user()->id]);

        return redirect()->route('members.index');
    }
}
