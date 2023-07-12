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
                            <h3 class="text-uppercase">119:59</h3>
                        </div>
                        <hr class="pb-3">
                    </div>
                    <div class="row align-items-stretch">
                        <div class="col-3 mb-3">
                            <a href="#" class="btn border-secondary rounded-circle bg-primary text-white" style="width: 100%; height: 100%">1</a>
                        </div>
                        <div class="col-3 mb-3">
                            <a href="#" class="btn border-secondary rounded-circle bg-primary text-white" style="width: 100%; height: 100%">2</a>
                        </div>
                        <div class="col-3 mb-3">
                            <a href="#" class="btn border-secondary rounded-circle bg-primary text-white" style="width: 100%; height: 100%">3</a>
                        </div>
                        <div class="col-3 mb-3">
                            <a href="#" class="btn border-secondary rounded-circle bg-primary text-white" style="width: 100%; height: 100%">4</a>
                        </div>
                        <div class="col-3 mb-3">
                            <a href="#" class="btn border-secondary rounded-circle bg-primary text-white" style="width: 100%; height: 100%">5</a>
                        </div>
                        <div class="col-3 mb-3">
                            <a href="#" class="btn border-secondary rounded-circle" style="width: 100%; height: 100%">6</a>
                        </div>
                        <div class="col-3 mb-3">
                            <a href="#" class="btn border-secondary rounded-circle" style="width: 100%; height: 100%">7</a>
                        </div>
                        <div class="col-3 mb-3">
                            <a href="#" class="btn border-secondary rounded-circle" style="width: 100%; height: 100%">8</a>
                        </div>
                        <div class="col-3 mb-3">
                            <a href="#" class="btn border-secondary rounded-circle" style="width: 100%; height: 100%">9</a>
                        </div>
                        <div class="col-3 mb-3">
                            <a href="#" class="btn border-secondary rounded-circle" style="width: 100%; height: 100%">10</a>
                        </div>
                        <div class="col-3 mb-3">
                            <a href="#" class="btn border-secondary rounded-circle" style="width: 100%; height: 100%">11</a>
                        </div>
                        <div class="col-3 mb-3">
                            <a href="#" class="btn border-secondary rounded-circle" style="width: 100%; height: 100%">12</a>
                        </div>
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
                    <h3 class="text-uppercase mb-3">#5. Question</h3>
                    <h3>Apa Nama Ibukota Indonesia ? </h3>
                    <hr>
                </div>
                <div class="d-flex flex-column">
                    <div class="d-flex align-items-center gap-3 flex-row mb-3">
                        <span class="btn border border-dark rounded-circle text-uppercase bg-info text-white">A</span>
                        <span class="text-uppercase">Jakarta</span>
                    </div>
                    <div class="d-flex align-items-center gap-3 flex-row mb-3">
                        <span class="btn border border-dark rounded-circle text-uppercase">B</span>
                        <span class="text-uppercase">Medan</span>
                    </div>
                    <div class="d-flex align-items-center gap-3 flex-row mb-3">
                        <span class="btn border border-dark rounded-circle text-uppercase">C</span>
                        <span class="text-uppercase">Palembang</span>
                    </div>
                    <div class="d-flex align-items-center gap-3 flex-row mb-3">
                        <span class="btn border border-dark rounded-circle text-uppercase">D</span>
                        <span class="text-uppercase">Ambon</span>
                    </div>
                    <div class="d-flex align-items-center gap-3 flex-row">
                        <span class="btn border border-dark rounded-circle text-uppercase">E</span>
                        <span class="text-uppercase">Kalimantan</span>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-4 mb-3">
                    <a href="" class="btn btn-danger">
                        <i class="fa fa-arrow-left"></i>
                        Prev
                    </a>
                    <a href="" class="btn btn-info">
                        Next
                        <i class="fa fa-arrow-right"></i>
                    </a>
                    {{-- <a href="" class="btn btn-info">
                        Submit
                        <i class="fas fa-save"></i>
                    </a> --}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
