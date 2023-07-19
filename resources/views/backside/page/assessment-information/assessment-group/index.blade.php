@extends('backside.layout.app', ['breadcrumb_heading' => 'Assessment Information', 'breadcrumb_sections' => ['Assessment Information', 'Assessment Group']])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <a href="{{ route('assessment-information.assessment-group.create') }}" class="btn btn-info">
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
                                <th class="text-center align-middle">Certificate Configuration</th>
                                <th class="text-center align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($assessment_groups as $assessment_group)
                            <tr>
                                <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                <td class="text-center align-middle">{{ $assessment_group->name }}</td>
                                <td class="text-center align-middle">
                                    <a href="{{ route('assessment-information.assessment-group.show-certificate-config', ['certificate_setting_uuid' => $assessment_group->certificateSetting->uuid]) }}" class="btn btn-primary btn-sm">Show Certificate Config</a>
                                </td>
                                <td class="text-center align-middle">
                                    <a href="{{ route('assessment-information.assessment-group.edit', ['uuid' => $assessment_group->uuid]) }}" class="btn btn-warning btn-sm text-white">
                                        <i class="fa fa-edit"></i>
                                        {{ __('Edit') }}
                                    </a>
                                    <a href="{{ route('assessment-information.assessment-group.destroy', ['uuid' => $assessment_group->uuid]) }}" class="btn btn-danger btn-sm btn-delete">
                                        <i class="fa fa-trash"></i>
                                        {{ __('Delete') }}
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="4">{{ __('Empty') }}</td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center align-middle">No</th>
                                <th class="text-center align-middle">Group Name</th>
                                <th class="text-center align-middle">Certificate Configuration</th>
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
