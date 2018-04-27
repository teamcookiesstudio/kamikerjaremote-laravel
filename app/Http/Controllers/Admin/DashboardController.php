<?php

namespace App\Http\Controllers\Admin;

use Charts;
use App\Charts\Dashboard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepositoryEloquent;

class DashboardController extends Controller
{
    /**
     * 
     * 
     */
    protected $eloquent;

    /**
     * 
     * 
     */
    public function __construct(UserRepositoryEloquent $eloquent)
    {
        $this->eloquent = $eloquent;
    }

    /**
     * 
     * 
     */
    public function index()
    {
        $approved = $this->eloquent->model()::approved();
        $waitingApproval = $this->eloquent->model()::waitingApproval();
        $rejected = $this->eloquent->model()::rejected();

        $chart = Charts::multiDatabase('area', 'chartjs')
            ->title('Statistic Status Members')
            ->elementLabel('Total')
            ->colors(['#00BFFF', '#00ff00', '#ff0000'])
            ->dataset('Waiting Approval', $waitingApproval->get())
            ->dataset('Approved', $approved->get())
            ->dataset('Rejected', $rejected->get())
            ->lastByMonth(12, true);

        $variable = array(
            'chart' => $chart,
            'approved'  => $approved->count(),
            'waitingApproval' => $waitingApproval->count(),
            'rejected'  => $rejected->count()
        );

        return view('admins.dashboard', $variable);
    }
}
