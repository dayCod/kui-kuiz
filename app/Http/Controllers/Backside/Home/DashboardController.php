<?php

namespace App\Http\Controllers\Backside\Home;

use App\Http\Controllers\Controller;
use App\Models\AsmntGroup;
use App\Models\Guest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * display the home page of admin dashboard
     *
     * @return View
     */
    public function index(): View
    {
        $total_participant = User::where('role', 'participant')->count();
        $total_visitor = Guest::count();
        $total_assessment_group = AsmntGroup::count();

        return view('backside.page.dashboard.index', compact('total_participant', 'total_visitor', 'total_assessment_group'));
    }
}
