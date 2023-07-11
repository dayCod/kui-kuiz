<?php

namespace App\Http\Controllers\Backside\SettingInformation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApplicationSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backside.page.setting-information.application-config.index');
    }
}
