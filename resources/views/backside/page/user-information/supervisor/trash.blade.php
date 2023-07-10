@extends('backside.layout.app', ['breadcrumb_heading' => 'User Information', 'breadcrumb_sections' => ['User Information', 'Supervisors', 'Trash']])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <h4>Trashed Supervisors</h4>
                    </div>
                    <div>
                        <a href="{{ route('user-information.supervisor.index') }}" class="btn btn-secondary">
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
                                <th class="text-center align-middle">Name</th>
                                <th class="text-center align-middle">Email</th>
                                <th class="text-center align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center align-middle">1</td>
                                <td class="text-center align-middle">John Doe</td>
                                <td class="text-center align-middle">johndoe@mail.com</td>
                                <td class="text-center align-middle">
                                    <a href="" class="btn btn-success btn-sm text-white">
                                        <i class="fas fa-redo"></i>
                                        {{ __('Restore') }}
                                    </a>
                                    <a href="" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                        {{ __('Delete Permanently') }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center align-middle">2</td>
                                <td class="text-center align-middle">Jane Doe</td>
                                <td class="text-center align-middle">janedoe@mail.com</td>
                                <td class="text-center align-middle">
                                    <a href="" class="btn btn-success btn-sm text-white">
                                        <i class="fas fa-redo"></i>
                                        {{ __('Restore') }}
                                    </a>
                                    <a href="" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                        {{ __('Delete Permanently') }}
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center align-middle">No</th>
                                <th class="text-center align-middle">Name</th>
                                <th class="text-center align-middle">Email</th>
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
