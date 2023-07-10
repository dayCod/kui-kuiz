@extends('backside.layout.app', ['breadcrumb_heading' => 'User Information', 'breadcrumb_sections' => ['User Information', 'Participants']])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <a href="{{ route('user-information.participant.create') }}" class="btn btn-info">
                            <i class="fa fa-plus-circle"></i>
                            {{ __('Create') }}
                        </a>
                        <a href="" class="btn btn-success">
                            <i class="fas fa-file-excel"></i>
                            {{ __('Export') }}
                        </a>
                    </div>
                    <div>
                        <a href="" class="btn btn-secondary">
                            <i class="fa fa-trash"></i>
                            {{ __('Trash') }}
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                        <thead>
                            <tr>
                                <th class="text-center align-middle">No</th>
                                <th class="text-center align-middle">Name</th>
                                <th class="text-center align-middle">Email</th>
                                <th class="text-center align-middle">Show Test History</th>
                                <th class="text-center align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center align-middle">1</td>
                                <td class="text-center align-middle">John Doe</td>
                                <td class="text-center align-middle">johndoe@mail.com</td>
                                <td class="text-center align-middle">
                                    <span class="badge bg-danger p-2">Haven't taken a test yet</span>
                                </td>
                                <td class="text-center align-middle">
                                    <a href="" class="btn btn-success btn-sm text-white">
                                        <i class="fa fa-eye"></i>
                                        {{ __('Detail') }}
                                    </a>
                                    <a href="{{ route('user-information.participant.edit', ['uuid' => 'df6fdea1-10c3-474c-ae62-e63def80d0b']) }}" class="btn btn-warning btn-sm text-white">
                                        <i class="fa fa-edit"></i>
                                        {{ __('Edit') }}
                                    </a>
                                    <a href="" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                        {{ __('Delete') }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center align-middle">2</td>
                                <td class="text-center align-middle">Jane Doe</td>
                                <td class="text-center align-middle">janedoe@mail.com</td>
                                <td class="text-center align-middle">
                                    <a href="" class="btn btn-primary btn-sm">Show Test History</a>
                                </td>
                                <td class="text-center align-middle">
                                    <a href="" class="btn btn-success btn-sm text-white">
                                        <i class="fa fa-eye"></i>
                                        {{ __('Detail') }}
                                    </a>
                                    <a href="" class="btn btn-warning btn-sm text-white">
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
                                <th class="text-center align-middle">Name</th>
                                <th class="text-center align-middle">Email</th>
                                <th class="text-center align-middle">Show Test History</th>
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
