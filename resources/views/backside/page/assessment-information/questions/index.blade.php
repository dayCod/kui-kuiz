@extends('backside.layout.app', ['breadcrumb_heading' => 'Assessment Information', 'breadcrumb_sections' => ['Assessment Information', 'Manage Assessment', 'Questions']])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <a href="{{ route('assessment-information.manage-assessment.questions.create', ['assessment_uuid' => $assessment_uuid]) }}" class="btn btn-info">
                            <i class="fa fa-plus-circle"></i>
                            {{ __('Create') }}
                        </a>
                    </div>
                    <a href="{{ route('assessment-information.manage-assessment.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i>
                        {{ __('Back') }}
                    </a>
                </div>
                <div class="table-responsive">
                    <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                        <thead>
                            <tr>
                                <th class="text-center align-middle">No</th>
                                <th class="text-center align-middle">Questions</th>
                                <th class="text-center align-middle">Amount of Answer</th>
                                <th class="text-center align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center align-middle">1</td>
                                <td class="text-center align-middle">What is your hobby ?</td>
                                <td class="text-center align-middle">5</td>
                                <td class="text-center align-middle">
                                    <a href="{{ route('assessment-information.manage-assessment.questions.show', ['assessment_uuid' => 'df6fdea1-10c3-474c-ae62-e63def80d0b', 'question_uuid' => 'df6fdea1-10c3-474c-ae62-e63def80d0b']) }}" class="btn btn-success btn-sm text-white">
                                        <i class="fa fa-eye"></i>
                                        {{ __('Detail') }}
                                    </a>
                                    <a href="{{ route('assessment-information.manage-assessment.questions.edit', ['assessment_uuid' => 'df6fdea1-10c3-474c-ae62-e63def80d0b', 'question_uuid' => 'df6fdea1-10c3-474c-ae62-e63def80d0b']) }}" class="btn btn-warning btn-sm text-white">
                                        <i class="fa fa-edit"></i>
                                        {{ __('Edit') }}
                                    </a>
                                    <a href="" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                        {{ __('Delete') }}
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center align-middle">No</th>
                                <th class="text-center align-middle">Questions</th>
                                <th class="text-center align-middle">Amount of Answer</th>
                                <th class="text-center align-middle">Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
