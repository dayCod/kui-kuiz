@extends('backside.layout.app', ['breadcrumb_heading' => 'Assessment Information', 'breadcrumb_sections' => ['Assessment Information', 'Manage Assessment', 'Questions', 'Create']])

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="card-title">Create Questions</h4>
                    <a href="{{ route('assessment-information.manage-assessment.questions.index', ['assessment_uuid' => 'df6fdea1-10c3-474c-ae62-e63def80d0b']) }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i>
                        {{ __('Back') }}
                    </a>
                </div>
                <form action="{{ route('assessment-information.manage-assessment.questions.store', ['assessment_uuid' => $assessment_uuid]) }}" method="POST">
                    @csrf
                    <input type="hidden" name="asmnt_type" value="{{ $assessment->asmntSetting->asmnt_type }}">
                    <div class="form-body">
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="form-label">Questions <span class="text-danger">*</span> </label>
                                <div class="form-group mb-3">
                                    <textarea name="question" class="form-control" rows="5" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row answer-section">
                            <div class="col-md-1">
                                <label class="form-label"># </label>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" placeholder="Alphabet" name="alphabet[]" value="A" style="cursor: not-allowed" readonly>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <label class="form-label">Answer <span class="text-danger">*</span> </label>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" placeholder="Answer" name="answer[]" required>
                                </div>
                            </div>
                            @if ($assessment->asmntSetting->asmnt_type == "corrections")
                            <div class="col-md-4">
                                <label class="form-label">Is Correct ? <span class="text-danger">*</span> </label>
                                <div class="form-group mb-3">
                                    <select class="form-control" name="is_correct[]" required>
                                        <option value="" selected hidden>Select The Corrections</option>
                                        <option value="">Yes, Correct Answer!</option>
                                        <option value="">No, It's Not Correct!</option>
                                    </select>
                                </div>
                            </div>
                            @elseif ($assessment->asmntSetting->asmnt_type == "score")
                            <div class="col-md-4">
                                <label class="form-label">Score <span class="text-danger">*</span> </label>
                                <div class="form-group mb-3">
                                    <input type="number" min="1" class="form-control" placeholder="Score" name="score[]" required>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div id="answer-section-divider"></div>
                    </div>
                    <div class="my-3" id="btn-actions-group">
                        <button type="button" class="btn btn-success rounded-circle btn-actions" id="increase">
                            <i class="fa fa-plus"></i>
                        </button>
                        <button type="button" class="btn btn-warning text-white rounded-circle btn-actions" id="decrease">
                            <i class="fa fa-minus"></i>
                        </button>
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
