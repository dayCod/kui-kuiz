@extends('backside.layout.app', ['breadcrumb_heading' => 'User Information', 'breadcrumb_sections' => ['User Information', 'Visitors', 'Detail']])

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="card-title">Detail Visitors</h4>
                    <a href="{{ route('user-information.visitor.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i>
                        {{ __('Back') }}
                    </a>
                </div>
                <form action="#">
                    <div class="form-body">
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="form-label">IP Address </label>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" placeholder="Name" value="{{ $guest->ip_address }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">Location Coordinates </label>
                                <div class="form-group mb-3">
                                    <input type="email" class="form-control" value="{{ $guest->location ?? '-' }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Browser </label>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" value="{{ $guest->browser }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Device </label>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" value="{{ $guest->device }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Total Visit </label>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" value="{{ $guest->total_visit }}" disabled>
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
