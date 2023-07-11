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
                            <tr>
                                <td class="text-center align-middle">1</td>
                                <td class="text-center align-middle">Potrait</td>
                                <td class="text-center align-middle">Certificate Header</td>
                                <td class="text-center align-middle word-limiter">Lorem, ipsum dolor sit amet </td>
                                <td class="text-center align-middle">John Doe .Org</td>
                                <td class="text-center align-middle">
                                    <a href="{{ route('setting-information.certificate-setting.edit', ['uuid' => 'df6fdea1-10c3-474c-ae62-e63def80d0b']) }}" class="btn btn-warning btn-sm text-white">
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
