@extends('backside.layout.app', ['breadcrumb_heading' => 'User Information', 'breadcrumb_sections' => ['User Information', 'Participants', 'Assessment History']])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <h4>Assessment History of John Doe</h4>
                    </div>
                    <div>
                        <a href="{{ route('user-information.participant.index') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i>
                            {{ __('Back') }}
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                        <thead>
                            <tr>
                                <th class="text-center align-middle">No</th>
                                <th class="text-center align-middle">Email</th>
                                <th class="text-center align-middle">Assessment Group</th>
                                <th class="text-center align-middle">Assessment Serial Number</th>
                                <th class="text-center align-middle">Assessment Result</th>
                                <th class="text-center align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center align-middle">1</td>
                                <td class="text-center align-middle">johndoe@mail.com</td>
                                <td class="text-center align-middle">TKA</td>
                                <td class="text-center align-middle">ASMNT/001/010/VII/1454/2023</td>
                                <td class="text-center align-middle">934 Score / 2 Uncorrect (98 A)</td>
                                <td class="text-center align-middle">
                                    <a href="" class="btn btn-success btn-sm text-white">
                                        <i class="far fa-file-pdf"></i>
                                        {{ __('Certificate Download') }}
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center align-middle">No</th>
                                <th class="text-center align-middle">Email</th>
                                <th class="text-center align-middle">Assessment Group</th>
                                <th class="text-center align-middle">Assessment Serial Number</th>
                                <th class="text-center align-middle">Assessment Result</th>
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
