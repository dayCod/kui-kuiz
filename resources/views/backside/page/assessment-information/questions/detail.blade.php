@extends('backside.layout.app', ['breadcrumb_heading' => 'Assessment Information', 'breadcrumb_sections' => ['Assessment Information', 'Manage Assessment', 'Questions', 'Detail']])

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="card-title">Detail Questions</h4>
                    <a href="{{ route('assessment-information.manage-assessment.questions.index', ['assessment_uuid' => $assessment_uuid]) }}" class="btn btn-secondary">
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
                                    <textarea name="question" class="form-control" rows="5" disabled>{{ $assessment_question->question }}</textarea>
                                </div>
                            </div>
                        </div>

                        @foreach ($assessment_question->hasAnswers as $answer)
                        <div class="row answer-section">
                            <div class="col-md-1">
                                <label class="form-label"># </label>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" placeholder="Alphabet" name="alphabet" value="{{ $answer->alphabet }}" style="cursor: not-allowed" disabled>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <label class="form-label">Answer <span class="text-danger">*</span> </label>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" placeholder="Answer" name="answer" value="{{ $answer->answer }}" disabled>
                                </div>
                            </div>
                            @if ($assessment->asmntSetting->asmnt_type == "corrections")
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
                            @elseif ($assessment->asmntSetting->asmnt_type == "score")
                            <div class="col-md-4">
                                <label class="form-label">Score <span class="text-danger">*</span> </label>
                                <div class="form-group mb-3">
                                    <input type="number" min="1" class="form-control" placeholder="Score" name="score" value="{{ $answer->score }}" disabled>
                                </div>
                            </div>
                            @endif
                        </div>
                        @endforeach
                        <div id="answer-section-divider"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
