@extends('backside.layout.app', ['breadcrumb_heading' => 'User Information', 'breadcrumb_sections' => ['User Information', 'Supervisors']])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <a href="{{ route('user-information.supervisor.create') }}" class="btn btn-info">
                            <i class="fa fa-plus-circle"></i>
                            {{ __('Create') }}
                        </a>
                        <a href="{{ route('user-information.supervisor.export') }}" class="btn btn-success">
                            <i class="fas fa-file-excel"></i>
                            {{ __('Export') }}
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('user-information.supervisor.trash') }}" class="btn btn-secondary">
                            <i class="fa fa-trash"></i>
                            {{ __('Trash') }}
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
                            @forelse($supervisors as $supervisor)
                            <tr>
                                <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                <td class="text-center align-middle">{{ $supervisor->name }}</td>
                                <td class="text-center align-middle">{{ $supervisor->email }}</td>
                                <td class="text-center align-middle">
                                    <a href="{{ route('user-information.supervisor.show', ['uuid' => $supervisor->uuid]) }}" class="btn btn-success btn-sm text-white">
                                        <i class="fa fa-eye"></i>
                                        {{ __('Detail') }}
                                    </a>
                                    <a href="{{ route('user-information.supervisor.edit', ['uuid' => $supervisor->uuid]) }}" class="btn btn-warning btn-sm text-white">
                                        <i class="fa fa-edit"></i>
                                        {{ __('Edit') }}
                                    </a>
                                    <a href="{{ route('user-information.supervisor.destroy', ['uuid' => $supervisor->uuid]) }}" class="btn btn-danger btn-sm btn-delete">
                                        <i class="fa fa-trash"></i>
                                        {{ __('Delete') }}
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
