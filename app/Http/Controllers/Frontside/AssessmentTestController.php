<?php

namespace App\Http\Controllers\Frontside;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AssessmentTestController extends Controller
{
    public function welcomePage()
    {
        return view('frontside.pages.welcome');
    }
}
