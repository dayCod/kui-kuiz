@extends('backside.layout.app', ['breadcrumb_heading' => 'Setting Information', 'breadcrumb_sections' => ['Setting Information', 'Certificate Config', 'Detail']])

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="card-title">Detail Certificate</h4>
                    <a href="{{ route('setting-information.certificate-setting.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i>
                        {{ __('Back') }}
                    </a>
                </div>
                <form action="#">
                    <div class="form-body">
                        <div class="row mt-3">
                            <label class="form-label">Page Orientation </label>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <select name="page_orientation" id="" class="form-control" disabled>
                                        <option value="" selected hidden>Select Page Orientation</option>
                                        <option value="landscape" @selected($certificate['page_orientation'] == "landscape")>Landscape</option>
                                        <option value="potrait" @selected($certificate['page_orientation'] == "potrait")>Potrait</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="form-label">Heading </label>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" placeholder="Heading" name="heading" value="{{ $certificate['heading'] }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="form-label">Description </label>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <textarea class="form-control" name="description" rows="5" disabled>{{ $certificate['description'] }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="form-label">Signatured By </label>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" placeholder="Signatured By" name="signatured_by" value="{{ $certificate['signatured_by'] }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="form-label">Certificate Background Image </label>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <img src="{{ $certificate['certi_background_img'] }}" class="img-fluid" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="form-label">Signature Image </label>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <img src="{{ $certificate['signature_img'] }}" class="img-fluid" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
