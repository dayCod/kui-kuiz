<?php

namespace App\Http\Controllers\Backside\System;

use App\Http\Controllers\Controller;
use App\Models\LogUser;
use App\Models\LogUserDetail;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
     * display updated log information.
     *
     * @return View
     */
    public function updatedLogInformationView(): View
    {
        $logs = LogUser::orderBy('id', 'desc')->get();

        return view('backside.page.system.log.index', compact('logs'));
    }

    /**
     * display detail related log information.
     *
     * @param int $log_id
     * @return View
     */
    public function detailRelatedLogInformationView(int $log_id): View
    {
        $detail_logs = LogUserDetail::where('log_user_id', $log_id)->get();

        return view('backside.page.system.log.detail', compact('detail_logs'));
    }
}
