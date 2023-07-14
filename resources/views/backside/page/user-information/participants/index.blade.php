@extends('backside.layout.app', ['breadcrumb_heading' => 'User Information', 'breadcrumb_sections' => ['User Information', 'Participants']])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <a href="{{ route('user-information.participant.create') }}" class="btn btn-info">
                            <i class="fa fa-plus-circle"></i>
                            {{ __('Create') }}
                        </a>
                        <a href="" class="btn btn-success">
                            <i class="fas fa-file-excel"></i>
                            {{ __('Export') }}
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('user-information.participant.trash') }}" class="btn btn-secondary">
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
                                <th class="text-center align-middle">Show Test History</th>
                                <th class="text-center align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($participants as $participant)
                            <tr>
                                <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                <td class="text-center align-middle">{{ $participant->name }}</td>
                                <td class="text-center align-middle">{{ $participant->email }}</td>
                                <td class="text-center align-middle">
                                    <span class="badge bg-danger p-2">Haven't taken a test yet</span>
                                </td>
                                <td class="text-center align-middle">
                                    <a href="{{ route('user-information.participant.show', ['uuid' => $participant->uuid]) }}" class="btn btn-success btn-sm text-white">
                                        <i class="fa fa-eye"></i>
                                        {{ __('Detail') }}
                                    </a>
                                    <a href="{{ route('user-information.participant.edit', ['uuid' => $participant->uuid]) }}" class="btn btn-warning btn-sm text-white">
                                        <i class="fa fa-edit"></i>
                                        {{ __('Edit') }}
                                    </a>
                                    <a href="" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                        {{ __('Delete') }}
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
                                <th class="text-center align-middle">Name</th>
                                <th class="text-center align-middle">Email</th>
                                <th class="text-center align-middle">Show Test History</th>
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
