@extends('backside.layout.app', ['breadcrumb_heading' => 'Assessment Information', 'breadcrumb_sections' => ['Assessment Information', 'Manage Assessment']])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <a href="{{ route('assessment-information.manage-assessment.create') }}" class="btn btn-info">
                            <i class="fa fa-plus-circle"></i>
                            {{ __('Create') }}
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                        <thead>
                            <tr>
                                <th class="text-center align-middle">No</th>
                                <th class="text-center align-middle">Group Name</th>
                                <th class="text-center align-middle">Assessment Setting</th>
                                <th class="text-center align-middle">Serial Number</th>
                                <th class="text-center align-middle">Assessment Name</th>
                                <th class="text-center align-middle">Assessment Time</th>
                                <th class="text-center align-middle">Open at</th>
                                <th class="text-center align-middle">Closed at</th>
                                <th class="text-center align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($assessments as $assessment)
                            <tr>
                                <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                <td class="text-center align-middle">{{ $assessment->asmntGroup->name }}</td>
                                <td class="text-center align-middle">
                                    {{ ucfirst($assessment->asmntSetting->asmnt_type).' - '.ucfirst($assessment->asmntSetting->check_type) }}
                                </td>
                                <td class="text-center align-middle">{{ $assessment->asmnt_serial_number }}</td>
                                <td class="text-center align-middle">{{ $assessment->asmnt_name }}</td>
                                <td class="text-center align-middle">{{ $assessment->asmnt_time_test }}</td>
                                <td class="text-center align-middle">2023-07-10 10:14:55</td>
                                <td class="text-center align-middle">2023-07-10 11:14:55</td>
                                <td class="text-center align-middle">
                                    <a href="{{ route('assessment-information.manage-assessment.questions.index', ['assessment_uuid' => 'df6fdea1-10c3-474c-ae62-e63def80d0b']) }}" class="btn btn-success btn-sm text-white">
                                        <i class="fas fa-file"></i>
                                        {{ __('Add Question') }}
                                    </a>
                                    <a href="{{ route('assessment-information.manage-assessment.edit', ['uuid' => $assessment->uuid]) }}" class="btn btn-warning btn-sm text-white">
                                        <i class="fa fa-edit"></i>
                                        {{ __('Edit') }}
                                    </a>
                                    <a href="{{ route('assessment-information.manage-assessment.destroy', ['uuid' => $assessment->uuid]) }}" class="btn btn-danger btn-sm btn-delete">
                                        <i class="fa fa-trash"></i>
                                        {{ __('Delete') }}
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="9">{{ __('Empty') }}</td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center align-middle">No</th>
                                <th class="text-center align-middle">Group Name</th>
                                <th class="text-center align-middle">Assessment Setting</th>
                                <th class="text-center align-middle">Serial Number</th>
                                <th class="text-center align-middle">Assessment Name</th>
                                <th class="text-center align-middle">Assessment Time</th>
                                <th class="text-center align-middle">Open at</th>
                                <th class="text-center align-middle">Closed at</th>
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
