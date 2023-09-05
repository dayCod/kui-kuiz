@extends('backside.layout.app', ['breadcrumb_heading' => 'System Information', 'breadcrumb_sections' => ['System Information', 'Updated Log Information']])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="card-title">Updated Log Information</h4>
                    <div></div>
                </div>
                <div class="table-responsive">
                    <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                        <thead>
                            <tr>
                                <th class="text-center align-middle">No</th>
                                <th class="text-center align-middle">User</th>
                                <th class="text-center align-middle">Access Feature</th>
                                <th class="text-center align-middle">Access Time</th>
                                <th class="text-center align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $log)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $log->user->email }}</td>
                                <td class="text-center">{{ $log->access_feature }}</td>
                                <td class="text-center">{{ $log->access_time }}</td>
                                <td class="text-center">
                                    <a href="{{ route('system.log.detail', ['log_id' => $log->id]) }}" class="btn btn-success btn-sm text-white">
                                        <i class="fa fa-eye"></i>
                                        {{ __('Detail') }}
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="5">{{ __('Empty') }}</td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center align-middle">No</th>
                                <th class="text-center align-middle">User</th>
                                <th class="text-center align-middle">Access Feature</th>
                                <th class="text-center align-middle">Access Time</th>
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
