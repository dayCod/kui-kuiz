@extends('backside.layout.app', ['breadcrumb_heading' => 'User Information', 'breadcrumb_sections' => ['User Information', 'Participants', 'Trash']])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <h4>Trashed Participants</h4>
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
                                <th class="text-center align-middle">Name</th>
                                <th class="text-center align-middle">Email</th>
                                <th class="text-center align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr>
                                <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                <td class="text-center align-middle">{{ $user['name'] }}</td>
                                <td class="text-center align-middle">{{ $user['email'] }}</td>
                                <td class="text-center align-middle">
                                    <a href="{{ route('user-information.supervisor.restore', ['uuid' => $user['uuid']]) }}" class="btn btn-success btn-sm text-white">
                                        <i class="fas fa-redo"></i>
                                        {{ __('Restore') }}
                                    </a>
                                    <a href="{{ route('user-information.supervisor.force-delete', ['uuid' => $user['uuid']]) }}" class="btn btn-danger btn-sm btn-delete">
                                        <i class="fa fa-trash"></i>
                                        {{ __('Delete Permanently') }}
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">{{ __('Empty') }}</td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center align-middle">No</th>
                                <th class="text-center align-middle">Name</th>
                                <th class="text-center align-middle">Email</th>
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
