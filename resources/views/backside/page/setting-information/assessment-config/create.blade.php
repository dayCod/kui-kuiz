@extends('backside.layout.app', ['breadcrumb_heading' => 'Setting Information', 'breadcrumb_sections' => ['Setting Information', 'Assessment Config', 'Create']])

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="card-title">Create Assessment Setting</h4>
                    <a href="{{ route('setting-information.assessment-setting.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i>
                        {{ __('Back') }}
                    </a>
                </div>
                <form action="#">
                    <div class="form-body">
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="form-label">Assessment Types <span class="text-danger">*</span> </label>
                                <div class="form-group mb-3">
                                    <select name="asmnt_type" id="" class="form-control" required>
                                        <option value="" selected hidden>Select Assessment Types</option>
                                        <option value="">Score</option>
                                        <option value="">Corrections</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">Check Types <span class="text-danger">*</span> </label>
                                <div class="form-group mb-3">
                                    <select name="check_type" id="" class="form-control" required>
                                        <option value="" selected hidden>Select Type</option>
                                        <option value="">Auto</option>
                                        {{-- <option value="">Manual</option> soon --}}
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="text-end">
                            <button type="submit" class="btn btn-info">
                                <i class="fas fa-save"></i>
                                {{ __('Submit') }}
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
