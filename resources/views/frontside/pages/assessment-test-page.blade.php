@extends('auth.layout.app')

@section('content')
    <div class="container">
        <div class="row align-items-center" style="height: 100vh">
            <div class="col-12 col-md-4">
                <div class="card border border-0 shadow p-4" style="height: 100%">
                    <div class="card-body">
                        <div>
                            <div class="d-flex justify-content-between align-items-start">
                                <h3 class="text-uppercase mb-4">kuikuiz - statistic</h3>
                                <h3 class="text-uppercase" id="test_timer">
                                </h3>
                            </div>
                            <hr class="pb-3">
                        </div>
                        <div class="row align-items-stretch">
                            @for ($question_number = 1; $question_number <= $user_assessment_test['total']; $question_number++)
                                <div class="col-3 mb-3">
                                    <a href="#"
                                        class="btn border-secondary rounded-circle {{ is_null($assessment_test['question_answer_data'][$question_number - 1]->user_participant_answer_id) ? '' : 'bg-primary text-white' }}"
                                        style="width: 100%; height: 100%">{{ $question_number }}</a>
                                </div>
                            @endfor
                        </div>
                        <hr class="pb-3">
                        <div class="d-flex flex-column ">
                            <div class="mb-3 d-flex justify-content-between flex-row">
                                <span class="text-uppercase text-xs">Answered Question</span>
                                <span>5</span>
                            </div>
                            <div class="mb-3 d-flex justify-content-between flex-row">
                                <span class="text-uppercase text-xs">Not Answered Question</span>
                                <span>7</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="card border border-0 shadow p-4" style="height: 100%">
                    <div class="card-title">
                        <h3 class="text-uppercase mb-3">{{ '#' . $user_assessment_test['current_page'] . ' Question' }}</h3>
                        <h3>{{ $user_assessment_test['data'][0]['question'] }}</h3>
                        <hr>
                    </div>
                    <div class="d-flex flex-column">
                        @foreach ($user_assessment_test['data'][0]['has_answers'] as $key => $answer)
                            <div class="d-flex align-items-center gap-3 flex-row mb-3">
                                <span
                                    class="btn-answers btn border border-dark rounded-circle text-uppercase {{ $answer['id'] == $assessment_test['question_answer_data'][$user_assessment_test['current_page'] - 1]->user_participant_answer_id ? 'bg-info text-white' : '' }}"
                                    data-answer-id="{{ $answer['id'] }}" data-answer-alphabet="{{ $answer['alphabet'] }}"
                                    data-answer-score="{{ $answer['score'] ?? null }}"
                                    data-answer-correct="{{ $answer['is_correct'] }}">
                                    {{ ucfirst($answer['alphabet']) }}
                                </span>
                                <span class="text-uppercase">
                                    {{ ucfirst($answer['answer']) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-between mt-4 mb-3">
                        <a href="{{ $user_assessment_test['prev_page_url'] }}"
                            class="btn btn-danger {{ $user_assessment_test['current_page'] == 1 ? 'disabled' : '' }}">
                            <i class="fa fa-arrow-left"></i>
                            Prev
                        </a>
                        @if ($user_assessment_test['current_page'] !== $user_assessment_test['last_page'])
                            <a href="{{ $user_assessment_test['next_page_url'] }}" class="btn btn-info" id="next-question">
                                Next
                                <i class="fa fa-arrow-right"></i>
                            </a>
                        @else
                            <a href="#" class="btn btn-info" id="submit-question">
                                Submit
                                <i class="fas fa-save"></i>
                            </a>
                        @endif
                    </div>
                    @if ($user_assessment_test['current_page'] !== $user_assessment_test['last_page'])
                        <form action="{{ route('assessment-test.append-qna') }}" id="form-next-question" method="POST">
                            @csrf
                            <input type="hidden" name="next_page_url"
                                value="{{ $user_assessment_test['next_page_url'] }}">
                            <input type="hidden" name="page" value="{{ request()->get('page') ?? 1 }}">
                            <input type="hidden" name="question_id" value="{{ $user_assessment_test['data'][0]['id'] }}">
                            <input type="hidden" name="answer_collection" value="">
                        </form>
                    @else
                        <form action="{{ route('assessment-test.submit-qna') }}" id="form-submit-question" method="POST">
                            @csrf
                            <input type="hidden" name="next_page_url"
                                value="{{ $user_assessment_test['next_page_url'] }}">
                            <input type="hidden" name="page" value="{{ request()->get('page') ?? 1 }}">
                            <input type="hidden" name="question_id" value="{{ $user_assessment_test['data'][0]['id'] }}">
                            <input type="hidden" name="answer_collection" value="">
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-js')
    <script>
        $(document).ready(function() {
            $('span.btn-answers').click(function() {
                $('span.btn-answers').removeClass('bg-info text-white selected')
                $(this).addClass('bg-info text-white selected');
            })

            function answerCollectionFunc(answerElem, inputHiddenElem) {
                const ANSWERS_COLLECTION = {
                    answerId: answerElem.data('answer-id'),
                    answerAlphabet: answerElem.data('answer-alphabet'),
                    answerScore: answerElem.data('answer-score'),
                    answerCorrect: answerElem.data('answer-correct')
                }

                inputHiddenElem.val(JSON.stringify(ANSWERS_COLLECTION))
            }

            $('#next-question').click(function(e) {
                e.preventDefault();
                let answers = $('span.btn-answers.selected')

                answerCollectionFunc(answers, $('#form-next-question > input[name="answer_collection"]'));

                $('#form-next-question').submit();
            })

            $('#submit-question').click(function(e) {
                e.preventDefault();
                let answers = $('span.btn-answers.selected')

                answerCollectionFunc(answers, $('#form-submit-question > input[name="answer_collection"]'));

                sessionStorage.removeItem('timer_test');

                $('#form-submit-question').submit();
            })

            let timerTestInSeconds = parseInt("{{ $assessment_test['asmnt_time_test'] }}");
            // sessionStorage.clear()
            let getTimerTestFromSessionStorage = sessionStorage.getItem('timer_test');
            // console.log(getTimerTestFromSessionStorage)

            if (getTimerTestFromSessionStorage == null) {
                sessionStorage.setItem('timer_test', timerTestInSeconds)
            } else {
                let interval;
                interval = setInterval(() => {
                    if (getTimerTestFromSessionStorage <= 0) {
                        sessionStorage.removeItem('timer_test')
                        clearInterval(interval)
                        setTimeout(() => {
                            $('#form-submit-question').submit();
                        }, 30);
                    };

                    sessionStorage.setItem('timer_test', getTimerTestFromSessionStorage--);

                    $('#test_timer').html(timerTestForHumans(sessionStorage.getItem('timer_test')));
                }, 1000);
            }

            function timerTestForHumans(seconds) {
                return new Date(seconds * 1000).toISOString().slice(11, 19);
            }
        });
    </script>
@endpush
