@extends('backside.layout.app', ['breadcrumb_heading' => 'System Information', 'breadcrumb_sections' => ['System Information', 'Detail Log Information']])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h4 class="card-title">Detail Log Information</h4>
                    <a href="{{ route('system.log.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i>
                        {{ __('Back') }}
                    </a>
                </div>
                <div class="table-responsive">
                    <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                        <thead>
                            <tr>
                                <th class="text-center align-middle">No</th>
                                <th class="text-center align-middle">User</th>
                                <th class="text-center align-middle">Access Feature</th>
                                <th class="text-center align-middle">Access Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($detail_logs as $log)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $log->user->email }}</td>
                                <td class="text-center">{{ $log->access_feature }}</td>
                                <td class="text-center">{{ $log->access_time }}</td>
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
                                <th class="text-center align-middle">User</th>
                                <th class="text-center align-middle">Access Feature</th>
                                <th class="text-center align-middle">Access Time</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
