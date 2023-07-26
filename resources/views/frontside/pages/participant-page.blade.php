@extends('auth.layout.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh">
            <div class="col-6">
                <div class="card border border-0 shadow p-4">
                    <div class="card-title">
                        <h2 class="text-uppercase text-center">kuikuiz - participant</h2>
                    </div>
                    <div class="card-body">
                        <p class="mb-3">
                            Welcome to the Assessment Test, designed to evaluate your skills and knowledge in a concise and
                            comprehensive manner.
                        </p>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center align-middle fw-bold">Name</th>
                                        <th class="text-center align-middle fw-bold">Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center align-middle">{{ $participant->name }}</td>
                                        <td class="text-center align-middle">{{ $participant->email }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-end">
                            <a href="" class="btn btn-danger text-uppercase">
                                <i class="fa fa-sign-out-alt"></i>
                                Logout
                            </a>
                            <button type="button" class="btn btn-primary text-uppercase"
                                data-bs-target="#choose-assessment" data-bs-toggle="modal">
                                <i class="fa fa-link"></i>
                                Choose The Assessment
                            </button>
                            <div id="choose-assessment" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="primary-header-modalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header modal-colored-header bg-primary">
                                            <h4 class="modal-title" id="primary-header-modalLabel">Choose the Assessment
                                                Below
                                            </h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-hidden="true"></button>
                                        </div>
                                        <form action="#" method="POST">
                                            <div class="modal-body">
                                                @csrf
                                                <div class="mb-3">
                                                    <select name="asmnt_group" id="" class="form-control">
                                                        <option value="" selected hidden>Select Assessment Group
                                                        </option>
                                                        @foreach($asmnt_groups as $asmnt_group)
                                                        <option value="{{ $asmnt_group->uuid }}">{{ ucfirst($asmnt_group->name) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <select name="assessment" id="" class="form-control">
                                                        <option value="" selected hidden>Select Assessment</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary text-uppercase">
                                                    <i class="fa fa-save"></i>
                                                    Submit
                                                </button>
                                            </div>
                                        </form>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-js')

<script>
    $(document).ready(function () {
        $('select[name="asmnt_group"]').change(function () {
            const ASMNT_GROUP_UUID = $(this).find(':selected').val();
            let routeUrl = "{{ route('api.res.get-assessment', [':asmnt_group_uuid']) }}";
            routeUrl = routeUrl.replace(':asmnt_group_uuid', ASMNT_GROUP_UUID);

            $.ajax({
                url: routeUrl,
                beforeSend: function() {
                    $('select[name="assessment"]').attr('disabled', 'disabled');
                    $('select[name="assessment"]').children()[0].innerHTML = "Please Wait..";
                },
                complete: function() {
                    $('select[name="assessment"]').removeAttr('disabled');
                    $('select[name="assessment"]').children()[0].innerHTML = "Select Assessment";
                },
                success: function(res) {
                    let selectHtml = ``;

                    $('select[name="assessment"]').empty();
                    $('select[name="assessment"]').append(`<option value="" selected hidden>Select Assessment</option>`);

                    $.each(res.data, function (key, item) {
                        selectHtml += `<option value="${item.uuid}">${item.asmnt_name}</option> `;
                    });

                    $('select[name="assessment"]').append(selectHtml);

                },
                error: function(err) {
                    console.log(err);
                }
            })
        });
    });
</script>

@endpush
