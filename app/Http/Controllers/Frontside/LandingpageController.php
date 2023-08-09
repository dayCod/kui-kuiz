<?php

namespace App\Http\Controllers\Frontside;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class LandingpageController extends Controller
{
    /**
     * display the base landing page
     *
     * @return View
     */
    public function index(): View
    {
        return view('frontside.index');
    }
}
