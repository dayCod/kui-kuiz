@extends('backside.layout.app', ['breadcrumb_heading' => 'User Information', 'breadcrumb_sections' => ['User Information', 'Visitors']])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <a href="" class="btn btn-success">
                            <i class="fas fa-file-excel"></i>
                            {{ __('Export') }}
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('user-information.visitor.trash') }}" class="btn btn-secondary">
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
                                <th class="text-center align-middle">IP Address</th>
                                <th class="text-center align-middle">Total Visit</th>
                                <th class="text-center align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($visitors as $visitor)
                            <tr>
                                <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                <td class="text-center align-middle">{{ $visitor->guest_ip }}</td>
                                <td class="text-center align-middle">{{ $visitor->guest_total_visit }}</td>
                                <td class="text-center align-middle">
                                    <a href="{{ route('user-information.visitor.show', ['uuid' => $visitor->guest_uuid]) }}" class="btn btn-success btn-sm text-white">
                                        <i class="fa fa-eye"></i>
                                        {{ __('Detail') }}
                                    </a>
                                    <a href="" class="btn btn-danger btn-sm">
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
                                <th class="text-center align-middle">IP Address</th>
                                <th class="text-center align-middle">Total Visit</th>
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
