<?php

namespace App\Http\Controllers\Backside\UserInformation;

use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $participants = User::with('userAssessmentTest')->where('role', 'participant')->latest()->get();

        return view('backside.page.user-information.participants.index', compact('participants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backside.page.user-information.participants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $process = app('CreateUser')->execute([
            'uuid' => Str::uuid(),
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'participant',
            'profile_picture' => $request->file('profile_picture'),
        ]);

        return redirect()->route('user-information.participant.index')->with('success', $process['message']);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $participant = User::where('role', 'participant')->where('uuid', $uuid)->latest()->first();

        return view('backside.page.user-information.participants.detail', compact('participant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $process = app('FindUser')->execute(['user_uuid' => $uuid]);

        return view('backside.page.user-information.participants.edit', [
            'user' => $process['data'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $uuid)
    {
        $process = app('UpdateUser')->execute([
            'user_uuid' => $uuid,
            'name' => $request->name,
            'email' => $request->email,
            'change_password' => $request->change_password,
            'profile_picture' => $request->file('profile_picture'),
        ]);

        return redirect()->route('user-information.participant.index')->with('success', $process['message']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $process = app('DeleteUser')->execute(['user_uuid' => $uuid]);

        return response()->json(['success' => $process['message']], 200);
    }

    /**
     * Display a listing of the assessment history resource.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function assessmentHistory($uuid)
    {
        $participant = User::with('userAssessmentTest')->where('role', 'participant')->where('uuid', $uuid)->latest()->first();
        // dd($participant);

        return view('backside.page.user-information.participants.history-assessment', compact('participant'));
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $process = app('GetTrashedUser')->execute(['role' => 'participant']);

        return view('backside.page.user-information.participants.trash', [
            'users' => $process['data'],
        ]);
    }

    /**
     * Restore a soft-deleted model instance.
     *
     * @param string $uuid
     * @return bool
     */
    public function restore($uuid)
    {
        $process = app('RestoreUser')->execute(['user_uuid' => $uuid]);

        return redirect()->back()->with('success', $process['message']);
    }

    /**
     * Force a hard delete on a soft deleted model.
     *
     * @param string $uuid
     * @return bool|null
     */
    public function forceDelete($uuid)
    {
        $process = app('ForceDelete')->execute(['user_uuid' => $uuid]);

        return response()->json(['success' => $process['message']], 200);
    }

    /**
     * Download the formatted excel collection
     *
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        $export_name = 'participant-users-export-'.time().config('excel.exports.default_format');

        return Excel::download(new UserExport(User::where('role', 'participant')->latest()->get()), $export_name);
    }
}
