@extends('backside.layout.app', ['breadcrumb_heading' => 'Setting Information', 'breadcrumb_sections' => ['Setting Information', 'Certificate Config']])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <a href="{{ route('setting-information.certificate-setting.create') }}" class="btn btn-info">
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
                                <th class="text-center align-middle">Page Orientation</th>
                                <th class="text-center align-middle">Heading</th>
                                <th class="text-center align-middle">Description</th>
                                <th class="text-center align-middle">Signature By</th>
                                <th class="text-center align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($certificates as $certificate)
                            <tr>
                                <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                <td class="text-center align-middle">{{ ucfirst($certificate->page_orientation) }}</td>
                                <td class="text-center align-middle">{{ $certificate->heading }}</td>
                                <td class="text-center align-middle word-limiter">{{ $certificate->description }}</td>
                                <td class="text-center align-middle">{{ $certificate->signatured_by }}</td>
                                <td class="text-center align-middle">
                                    <a href="{{ route('setting-information.certificate-setting.show', ['uuid' => $certificate->uuid]) }}" class="btn btn-success btn-sm text-white">
                                        <i class="fa fa-eye"></i>
                                        {{ __('Detail') }}
                                    </a>
                                    <a href="{{ route('setting-information.certificate-setting.edit', ['uuid' => $certificate->uuid]) }}" class="btn btn-warning btn-sm text-white">
                                        <i class="fa fa-edit"></i>
                                        {{ __('Edit') }}
                                    </a>
                                    <a href="{{ route('setting-information.certificate-setting.destroy', ['uuid' => $certificate->uuid]) }}" class="btn btn-danger btn-sm btn-delete">
                                        <i class="fa fa-trash"></i>
                                        {{ __('Delete') }}
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="6">{{ __('Empty') }}</td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center align-middle">No</th>
                                <th class="text-center align-middle">Page Orientation</th>
                                <th class="text-center align-middle">Heading</th>
                                <th class="text-center align-middle">Description</th>
                                <th class="text-center align-middle">Signature By</th>
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
