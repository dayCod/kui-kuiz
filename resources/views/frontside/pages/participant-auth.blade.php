@extends('auth.layout.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh">
            <div class="col-6">
                <div class="card border border-0 shadow p-4">
                    <div class="card-title">
                        <h2 class="text-uppercase text-center">kuikuiz - participant authentication</h2>
                    </div>
                    <div class="card-body">
                        @if (session()->has('errors'))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(session()->has('fail'))
                            <div class="alert alert-danger">
                                {{ session()->pull('fail') }}
                            </div>
                        @endif
                        <form action="{{ route('assessment-test.participant-authentication') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="">Email</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="mb-3">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-info text-white">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
