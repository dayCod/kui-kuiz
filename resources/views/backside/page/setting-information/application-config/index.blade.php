@extends('backside.layout.app', ['breadcrumb_heading' => 'Setting Information', 'breadcrumb_sections' => ['Setting Information', 'Application Config']])

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="card-title">Application Setting</h4>
                </div>
                <form action="#">
                    <div class="form-body">
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="form-label">Application Name </label>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" value="KUIKUIZ" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">Application Version </label>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" value="v1.0.0" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">Application Locale </label>
                                <div class="form-group mb-3">
                                    <select class="form-control">
                                        <option value="" selected hidden>Select Application Locale</option>
                                        <option value="">id-ID</option>
                                        <option value="" selected>en-EN</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="text-end">
                            <button type="submit" class="btn btn-info">
                                <i class="fas fa-save"></i>
                                {{ __('Save Changes') }}
                            </button>
                            <a href="#" class="btn btn-secondary">
                                <i class="fas fa-download"></i>
                                {{ __('Migrate Sample / Dummy Data') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
