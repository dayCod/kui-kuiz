@extends('backside.layout.app', ['breadcrumb_heading' => 'User Information', 'breadcrumb_sections' => ['User Information', 'Participants', 'Assessment History']])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <h4>Assessment History of John Doe</h4>
                    </div>
                    <div>
                        <a href="{{ route('user-information.participant.index') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i>
                            {{ __('Back') }}
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                        <thead>
                            <tr>
                                <th class="text-center align-middle">No</th>
                                <th class="text-center align-middle">Email</th>
                                <th class="text-center align-middle">Assessment Group</th>
                                <th class="text-center align-middle">Assessment Serial Number</th>
                                <th class="text-center align-middle">Assessment Result</th>
                                <th class="text-center align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $num = 1;
                            @endphp
                            @foreach($participant->userAssessmentTest as $assessment_test)
                            <tr>
                                <td class="text-center align-middle">{{ $num++ }}</td>
                                <td class="text-center align-middle">{{ $participant->email }}</td>
                                <td class="text-center align-middle">{{ $assessment_test->assessment->asmntGroup->name }}</td>
                                <td class="text-center align-middle">ASMNT/001/010/VII/1454/2023</td>
                                <td class="text-center align-middle">
                                    {{ is_null($assessment_test->total_score)
                                        ? (!is_null($assessment_test->total_is_correct)
                                            ? $assessment_test->total_is_correct.' Correct - Score '. getScoreFromTotalCorrectAnswer(
                                                $assessment_test->assessment->asmntQuestion->count(),
                                                $assessment_test->total_is_correct
                                            ).'/100'
                                            : '-')
                                        : (!is_null($assessment_test->total_score)
                                            ? $assessment_test->total_score.' Score'
                                            : '-')  }}
                                </td>
                                {{-- <td class="text-center align-middle">934 Score / 2 Uncorrect (98 A)</td> --}}
                                <td class="text-center align-middle">
                                    <a href="{{ route('user-information.participant.generate-certificate', ['uuid' => $assessment_test->uuid]) }}" class="btn btn-success btn-sm text-white">
                                        <i class="far fa-file-pdf"></i>
                                        {{ __('Certificate Download') }}
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center align-middle">No</th>
                                <th class="text-center align-middle">Email</th>
                                <th class="text-center align-middle">Assessment Group</th>
                                <th class="text-center align-middle">Assessment Serial Number</th>
                                <th class="text-center align-middle">Assessment Result</th>
                                <th class="text-center align-middle">Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
