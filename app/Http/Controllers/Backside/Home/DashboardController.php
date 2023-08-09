<?php

namespace App\Http\Controllers\Backside\Home;

use App\Http\Controllers\Controller;
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
        return view('backside.page.dashboard.index');
    }
}
