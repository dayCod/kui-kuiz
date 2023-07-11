@extends('backside.layout.app', ['breadcrumb_heading' => 'Assessment Information', 'breadcrumb_sections' => ['Assessment Information', 'Manage Assessment', 'Edit']])

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="card-title">Edit Assessment</h4>
                    <a href="{{ route('assessment-information.manage-assessment.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i>
                        {{ __('Back') }}
                    </a>
                </div>
                <form action="#">
                    <div class="form-body">
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="form-label">Group Name <span class="text-danger">*</span> </label>
                                <div class="form-group mb-3">
                                    <select class="form-control" name="asmnt_group_id" id="" required>
                                        <option value="" selected hidden>Select The Assessment Group</option>
                                        <option value="">Value 1</option>
                                        <option value="">Value 2</option>
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
                                        <option value="">Value 1</option>
                                        <option value="">Value 2</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="form-label">Assessment Name <span class="text-danger">*</span> </label>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" placeholder="Assessment Name" name="asmnt_name" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label class="form-label">Assessment Time <span class="text-danger">*</span> </label>
                                <div class="form-group mb-3">
                                    <input type="number" min="1" class="form-control" placeholder="Assessment Time Test (Minutes)" name="asmnt_time_test" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Assessment Open at <span class="text-danger">*</span> </label>
                                <div class="form-group mb-3">
                                    <input type="datetime-local" class="form-control" name="time_open" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Assessment Closed at <span class="text-danger">*</span> </label>
                                <div class="form-group mb-3">
                                    <input type="datetime-local" class="form-control" name="time_close" required>
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
