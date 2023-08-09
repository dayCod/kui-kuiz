<?php

namespace App\Http\Controllers\Backside\SettingInformation;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ApplicationSettingController extends Controller
{
    /**
     * display the application setting page.
     *
     * @return View
     */
    public function index(): View
    {
        return view('backside.page.setting-information.application-config.index', [
            'application_name' => config('app.name'),
            'application_version' => config('app.version'),
        ]);
    }
}
