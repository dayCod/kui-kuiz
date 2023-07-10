@extends('backside.layout.app', ['breadcrumb_heading' => 'User Information', 'breadcrumb_sections' => ['User Information', 'Supervisors', 'Edit']])

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="card-title">Edit Supervisor</h4>
                    <a href="{{ route('user-information.supervisor.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i>
                        {{ __('Back') }}
                    </a>
                </div>
                <form action="#">
                    <div class="form-body">
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="form-label">Name <span class="text-danger">*</span> </label>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" placeholder="Name" name="name" value="John Doe">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Email <span class="text-danger">*</span> </label>
                                <div class="form-group mb-3">
                                    <input type="email" class="form-control" placeholder="Email" name="email" value="johndoe@mail.com">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Change Password </label>
                                <div class="form-group mb-3">
                                    <input type="password" class="form-control" placeholder="Password" name="password">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="form-label">Upload Profile Picture </label>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <input type="file" class="form-control" name="user_profile_img">
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
