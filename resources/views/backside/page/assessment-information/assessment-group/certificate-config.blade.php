@extends('backside.layout.app', ['breadcrumb_heading' => 'Assessment Information', 'breadcrumb_sections' => ['Assessment Information', 'Assessment Group', 'Certificate Configuration']])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <h4>Detail Certificate Configuration</h4>
                    </div>
                    <div>
                        <a href="{{ route('assessment-information.assessment-group.index') }}" class="btn btn-secondary">
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
                                <th class="text-center align-middle">Page Orientation</th>
                                <th class="text-center align-middle">Heading</th>
                                <th class="text-center align-middle">Description</th>
                                <th class="text-center align-middle">Signature By</th>
                                <th class="text-center align-middle">Certificate Background Image</th>
                                <th class="text-center align-middle">Signature Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center align-middle">1</td>
                                <td class="text-center align-middle">{{ $certificate['page_orientation'] }}</td>
                                <td class="text-center align-middle">{{ $certificate['heading'] }}</td>
                                <td class="text-center align-middle word-limiter">{{ $certificate['description'] }}</td>
                                <td class="text-center align-middle">{{ ucfirst($certificate['signatured_by']) }}</td>
                                <td class="text-center align-middle">
                                    <button type="button" class="btn btn-primary" data-bs-target="#primary-certi-modal" data-bs-toggle="modal">Show Background</button>
                                    <div id="primary-certi-modal" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="primary-header-modalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header modal-colored-header bg-primary">
                                                    <h4 class="modal-title" id="primary-header-modalLabel">Certificate Background Image
                                                    </h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-hidden="true"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="{{ $certificate['certi_background_img'] }}" class="img-fluid img-thumbnail p-3" alt="">
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div>
                                </td>
                                <td class="text-center align-middle">
                                    <button type="button" class="btn btn-primary" data-bs-target="#primary-signature-modal" data-bs-toggle="modal">Show Signature</button>
                                    <div id="primary-signature-modal" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="primary-header-modalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header modal-colored-header bg-primary">
                                                    <h4 class="modal-title" id="primary-header-modalLabel">Signature Image
                                                    </h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-hidden="true"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="{{ $certificate['signature_img'] }}" class="img-fluid img-thumbnail p-3" style="width:466px; height:223px;" alt="">
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div>
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
                                <th class="text-center align-middle">Certificate Background Image</th>
                                <th class="text-center align-middle">Signature Image</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
