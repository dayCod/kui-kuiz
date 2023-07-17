<?php

namespace App\Http\Controllers\Backside\SettingInformation;

use App\Http\Controllers\Controller;
use App\Models\AsmntSetting;
use Illuminate\Http\Request;

class AssessmentSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assessment_settings = AsmntSetting::latest()->get();

        return view('backside.page.setting-information.assessment-config.index', compact('assessment_settings'));
    }
}
