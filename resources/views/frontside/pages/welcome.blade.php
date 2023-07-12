@extends('auth.layout.app')


@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center" style="height: 100vh">
        <div class="col-6">
            <div class="card border border-0 shadow p-4">
                <div class="card-title">
                    <h2 class="text-uppercase text-center">kuikuiz - welcome</h2>
                </div>
                <div class="card-body">
                    <p class="mb-3">
                        Welcome to the Assessment Test, designed to evaluate your skills and knowledge in a concise and comprehensive manner.
                    </p>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">#</th>
                                    <th class="text-center align-middle">Group Name</th>
                                    <th class="text-center align-middle">Assessment Name</th>
                                    <th class="text-center align-middle">Total Question</th>
                                    <th class="text-center align-middle">Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center align-middle">1</td>
                                    <td class="text-center align-middle">FTI</td>
                                    <td class="text-center align-middle">Teknik Informatika</td>
                                    <td class="text-center align-middle">40</td>
                                    <td class="text-center align-middle">120 Minutes</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-end">
                        <a href="{{ route('auth.login') }}" class="btn btn-primary text-uppercase">start the test <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
