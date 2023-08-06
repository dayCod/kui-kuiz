@extends('backside.layout.app', ['breadcrumb_heading' => 'Assessment Information', 'breadcrumb_sections' => ['Assessment Information', 'Manage Assessment', 'Create']])

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="card-title">Create Assessment</h4>
                    <a href="{{ route('assessment-information.manage-assessment.index') }}" class="btn btn-secondary">
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
                <form action="{{ route('assessment-information.manage-assessment.store') }}" method="POST">
                    @csrf
                    <div class="form-body">
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="form-label">Group Name <span class="text-danger">*</span> </label>
                                <div class="form-group mb-3">
                                    <select class="form-control" name="asmnt_group_id" id="" required>
                                        <option value="" selected hidden>Select The Assessment Group</option>
                                        @foreach($asmnt_groups as $asmnt_group)
                                        <option value="{{ $asmnt_group->id }}" @selected(old('asmnt_group_id') == $certificate->id)>{{ $asmnt_group->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">Assessment Setting <span class="text-danger">*</span> </label>
                                <div class="form-group mb-3">
                                    <select class="form-control" name="asmnt_setting_id" id="" required>
                                        <option value="" selected hidden>Select The Assessment Setting</option>
                                        @foreach($asmnt_settings as $asmnt_setting)
                                        <option value="{{ $asmnt_setting->id }}" @selected(old('asmnt_setting_id') == $certificate->id)>{{ ucfirst($asmnt_setting->asmnt_type).' - '.ucfirst($asmnt_setting->check_type) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="form-label">Assessment Name <span class="text-danger">*</span> </label>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" placeholder="Assessment Name" name="asmnt_name" value="{{ old('asmnt_name') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label class="form-label">Assessment Time <span class="text-danger">*</span> </label>
                                <div class="form-group mb-3">
                                    <input type="number" min="1" class="form-control" placeholder="Assessment Time Test (Minutes)" name="asmnt_time_test" value="{{ old('asmnt_time_test') }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Assessment Open at <span class="text-danger">*</span> </label>
                                <div class="form-group mb-3">
                                    <input type="datetime-local" class="form-control" name="time_open" value="{{ old('time_open') }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Assessment Closed at <span class="text-danger">*</span> </label>
                                <div class="form-group mb-3">
                                    <input type="datetime-local" class="form-control" name="time_close" value="{{ old('time_close') }}" required>
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
