@extends('backside.layout.app', ['breadcrumb_heading' => 'User Information', 'breadcrumb_sections' => ['User Information', 'Supervisors', 'Detail']])

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="card-title">Detail Supervisor</h4>
                    <a href="{{ route('user-information.supervisor.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i>
                        {{ __('Back') }}
                    </a>
                </div>
                <form action="#">
                    <div class="form-body">
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="form-label">Name </label>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" placeholder="Name" value="{{ $supervisor->name }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">Email </label>
                                <div class="form-group mb-3">
                                    <input type="email" class="form-control" placeholder="Email" value="{{ $supervisor->email }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="form-label">Profile Picture </label>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    @if(is_null($supervisor->profile_picture))
                                    <img src="{{ asset('backside/assets/images/users/1.jpg') }}" class="img-fluid" alt="">
                                    @else
                                    <img src="{{ $supervisor->profile_picture }}" class="img-fluid" alt="">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Is User Online ? </label>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" placeholder="Email" value="{{ ($supervisor->is_login) ? 'User is Online' : 'User is Offline' }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Role </label>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" placeholder="Email" value="{{ ucfirst($supervisor->role) }}" disabled>
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
