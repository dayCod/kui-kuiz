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
use App\Models\AssessmentTest;
use App\Models\UserAssessmentTest;
use App\Traits\UserLogging;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class ParticipantController extends Controller
{
    use UserLogging;

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
        DB::beginTransaction();

        try {
            $process = app('CreateUser')->execute([
                'uuid' => Str::uuid(),
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'participant',
                'profile_picture' => $request->file('profile_picture'),
            ]);

            $this->createLog(auth()->id(), 'Was Create the Participant', true);

            DB::commit();

            return redirect()->route('user-information.participant.index')->with('success', $process['message']);
        } catch (\Exception $ex) {
            DB::rollBack();
            dd($ex->getMessage());
        }
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

        $this->createLog(auth()->id(), 'Was Update the Participant', true);

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

        $this->createLog(auth()->id(), 'Was Delete the Participant', true);

        return response()->json(['success' => $process['message']], 200);
    }

    /**
     * generate assessment certificate with related users.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function generateAssessmentCertificate($uuid)
    {
        $asmnt_test = AssessmentTest::where('uuid', $uuid)->first();
        $user_assessment_test = UserAssessmentTest::where('assessment_test_id', $asmnt_test->id)->first();

        $data = [
            'background' => $asmnt_test->assessment->asmntGroup->certificateSetting->certi_background_img,
            'asmnt_serial_number' => $asmnt_test->assessment->asmnt_serial_number,
            'asmnt_name' => $asmnt_test->assessment->asmnt_name,
            'user_name' => $user_assessment_test->user->name,
            'final_result' => $asmnt_test->total_is_correct ?? $asmnt_test->total_score,
            'created_at' => \Carbon\Carbon::parse($asmnt_test->created_at)->format('D, d F Y'),
            'signature_img' => $asmnt_test->assessment->asmntGroup->certificateSetting->signature_img,
            'signatured_by' => $asmnt_test->assessment->asmntGroup->certificateSetting->signatured_by,
        ];

        return Pdf::loadView('pdf.certificate', $data)
            ->setPaper('a4', $asmnt_test->assessment->asmntGroup->certificateSetting->page_orientation)
            ->stream('certificate.pdf');
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
        // dd(getScoreFromTotalCorrectAnswer(5, 5));

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

        $this->createLog(auth()->id(), 'Was Restore the Participant', true);

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

        $this->createLog(auth()->id(), 'Was Deleted Permanently the Participant', true);

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
