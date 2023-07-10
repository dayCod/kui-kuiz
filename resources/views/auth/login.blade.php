@extends('auth.layout.app')


@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center" style="height: 100vh">
        <div class="col-6">
            <div class="card border border-0 shadow p-4">
                <h3 class="text-uppercase mb-4 text-center">kuikuiz - login</h3>
                <form action="{{ route('dashboard.index') }}">
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

@endsection
