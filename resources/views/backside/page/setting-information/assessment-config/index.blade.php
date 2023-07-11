@extends('backside.layout.app', ['breadcrumb_heading' => 'Setting Information', 'breadcrumb_sections' => ['Setting Information', 'Assessment Config']])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <a href="{{ route('setting-information.assessment-setting.create') }}" class="btn btn-info">
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
                                <th class="text-center align-middle">Name</th>
                                <th class="text-center align-middle">Type</th>
                                <th class="text-center align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center align-middle">1</td>
                                <td class="text-center align-middle">Score</td>
                                <td class="text-center align-middle">Auto</td>
                                <td class="text-center align-middle">
                                    <a href="{{ route('setting-information.assessment-setting.edit', ['uuid' => 'df6fdea1-10c3-474c-ae62-e63def80d0b']) }}" class="btn btn-warning btn-sm text-white">
                                        <i class="fa fa-edit"></i>
                                        {{ __('Edit') }}
                                    </a>
                                    <a href="" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                        {{ __('Delete') }}
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center align-middle">No</th>
                                <th class="text-center align-middle">Name</th>
                                <th class="text-center align-middle">Type</th>
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
