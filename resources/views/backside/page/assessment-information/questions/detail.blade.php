@extends('backside.layout.app', ['breadcrumb_heading' => 'Assessment Information', 'breadcrumb_sections' => ['Assessment Information', 'Manage Assessment', 'Questions', 'Detail']])

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="card-title">Detail Questions</h4>
                    <a href="{{ route('assessment-information.manage-assessment.questions.index', ['assessment_uuid' => 'df6fdea1-10c3-474c-ae62-e63def80d0b']) }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i>
                        {{ __('Back') }}
                    </a>
                </div>
                <form action="#">
                    <div class="form-body">
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="form-label">Questions <span class="text-danger">*</span> </label>
                                <div class="form-group mb-3">
                                    <textarea name="question" class="form-control" rows="5" disabled></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row answer-section">
                            <div class="col-md-1">
                                <label class="form-label"># </label>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" placeholder="Alphabet" name="alphabet" value="A" style="cursor: not-allowed" disabled>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <label class="form-label">Answer <span class="text-danger">*</span> </label>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" placeholder="Answer" name="answer" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Is Correct ? <span class="text-danger">*</span> </label>
                                <div class="form-group mb-3">
                                    <select class="form-control" name="is_correct" disabled>
                                        <option value="" selected hidden>Select The Corrections</option>
                                        <option value="">Yes, Correct Answer!</option>
                                        <option value="">No, It's Not Correct!</option>
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="col-md-4">
                                <label class="form-label">Score <span class="text-danger">*</span> </label>
                                <div class="form-group mb-3">
                                    <input type="number" min="1" class="form-control" placeholder="Score" name="score" disabled>
                                </div>
                            </div> --}}
                        </div>
                        <div id="answer-section-divider"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
