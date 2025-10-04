<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Campaign;
use App\Models\Task;
use App\Models\Report;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $usersCount = User::count();

        $campaignsCount = Campaign::count();

        $tasksCount = Task::count();

        $reportsCount = Report::count();

        $latestUsers = User::latest('created_at')->take(5)->get();

        $latestCampaigns = Campaign::latest('start_date')->take(5)->get();

        return view('admin.dashboard', compact(
            'usersCount',
            'campaignsCount',
            'tasksCount',
            'reportsCount',
            'latestUsers',
            'latestCampaigns'
        ));
    }
}
