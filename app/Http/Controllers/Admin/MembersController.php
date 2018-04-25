<?php

namespace App\Http\Controllers\Admin;

use DataTables, DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryEloquent;

class MembersController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepo;

    /**
     * @var UserRepositoryEloquent
     */
    protected $eloquent;

    /**
     * MembersController 
     * 
     * @param UserRepository $userRepo
     */
    public function __construct(UserRepository $userRepo, UserRepositoryEloquent $eloquent)
    {
        $this->eloquent = $eloquent;
        $this->userRepo = $userRepo;
    }

    /**
     * Dispkay view for the members
     * 
     */
    public function index()
    {
        return view('admins.members.index');   
    }

    /**
     * List and get all data 
     * 
     * @param User $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function datatables()
    {
        DB::statement(DB::raw('set @rownum = 0'));
        $datatables = DataTables::of( 

                $this->eloquent->model()::select('*', DB::raw('@rownum := @rownum + 1 AS rownum'))
                ->member()
            )
            ->addColumn('status', function ($app) {

                switch ($app->status) {
                    case 'approved': 
                        return '<span class="label label-success">approved</span>';
                        break;
                    case 'waiting approval':
                        return '<span class="label label-info">waiting approval</span>';
                        break;
                    case 'rejected':
                        return '<span class="label label-danger">rejected</span>';
                        break;
                }
            })
            ->addColumn('name', function ($app) {

                $name = ucfirst($app->first_name).' '.ucfirst($app->last_name);
                return $name;
            })
            ->rawColumns(array('status'))
            ->AddIndexColumn()
            ->make(true);
            
        return $datatables;
    }

    /**
     * Approve a given members
     * 
     * @param User $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function approve($id)
    {  
        $data = array(
            'is_approved' => true, 
            'reviewed_by' => auth()->user()->id
        );
        if ($this->userRepo->update($data, $id)) {
            return response()->json(array(
                'status'    => 'success',
                'message'   => 'Approved'
            ));
        }
    }

    /**
     * Approve selected members
     * 
     * @return \Illuminate\Http\Response
     */
    public function approveSelected(Request $request)
    {
        $attributes = array();

        foreach ($request->id as $key => $value) {
            $attributes[] = (int)$value;
        }

        $this->eloquent->model()::whereIn('id', $attributes)
        ->update(['is_approved' => true, 'reviewed_by' => auth()->user()->id]);

        return response()->json(array(
            'status'    => 'success',
            'message'   => 'Approved'
        ));
    }

    /**
     * Reject selected members
     * 
     * @return \Illuminate\Http\Response
     */
    public function rejectSelected(Request $request)
    {
        $attributes = array();

        foreach ($request->id as $key => $value) {
            $attributes[] = (int)$value;
        }

        $this->eloquent->model()::whereIn('id', $attributes)
        ->update(['is_approved' => false, 'reviewed_by' => auth()->user()->id]);

        return response()->json(array(
            'status'    => 'success',
            'message'   => 'Rejected.'
        ));
    }

    /**
     * Reject a given members
     * 
     * @param User $id, $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function reject($id)
    {
        $data = array(
            'is_approved' => false, 
            'reviewed_by' => auth()->user()->id
        );
        if ($this->userRepo->update($data, $id)) {
            return response()->json(array(
                'status'    => 'success',
                'message'   => 'Rejected.'
            ));
        }
    }
}
