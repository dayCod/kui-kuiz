@extends('backside.layout.app', ['breadcrumb_heading' => 'Setting Information', 'breadcrumb_sections' => ['Setting Information', 'Certificate Config', 'Edit']])

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="card-title">Edit Certificate Config</h4>
                    <a href="{{ route('setting-information.certificate-setting.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i>
                        {{ __('Back') }}
                    </a>
                </div>
                @if(session()->has('errors'))
                <div class="alert alert-danger mt-3">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{ route('setting-information.certificate-setting.update', $certificate['uuid']) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-body">
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="form-label">Page Orientation <span class="text-danger">*</span> </label>
                                <div class="form-group mb-3">
                                    <select name="page_orientation" id="" class="form-control" required>
                                        <option value="" selected hidden>Select Page Orientation</option>
                                        <option value="landscape" @selected(old('page_orientation', $certificate['page_orientation']) == "landscape")>Landscape</option>
                                        <option value="potrait" @selected(old('page_orientation', $certificate['page_orientation']) == "potrait")>Potrait</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">Heading <span class="text-danger">*</span> </label>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" placeholder="Heading" name="heading" value="{{ old('heading', $certificate['heading']) }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">Description <span class="text-danger">*</span> </label>
                                <div class="form-group mb-3">
                                    <textarea class="form-control" name="description" rows="5" required>{{ old('description', $certificate['description']) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">Signatured By <span class="text-danger">*</span> </label>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" placeholder="Signatured By" name="signatured_by" value="{{ old('signatured_by', $certificate['signatured_by']) }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">Certificate Background Image </label>
                                <div class="form-group mb-3">
                                    <input type="file" class="form-control" name="certi_background_img">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">Signature Image </label>
                                <div class="form-group mb-3">
                                    <input type="file" class="form-control" name="signature_img">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="text-end">
                            <button type="submit" class="btn btn-info">
                                <i class="fas fa-edit"></i>
                                {{ __('Update') }}
                            </button>
                            <button type="reset" class="btn btn-dark">
                                <i class="fas fa-redo"></i>
                                {{ __('Reset') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
