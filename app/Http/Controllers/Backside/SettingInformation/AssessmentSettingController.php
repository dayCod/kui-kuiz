<?php

namespace App\Http\Controllers\Backside\SettingInformation;

use App\Http\Controllers\Controller;
use App\Models\AsmntSetting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AssessmentSettingController extends Controller
{
    /**
     * display the application assessment setting page.
     *
     * @return View
     */
    public function index(): View
    {
        $assessment_settings = AsmntSetting::latest()->get();

        return view('backside.page.setting-information.assessment-config.index', compact('assessment_settings'));
    }
}
