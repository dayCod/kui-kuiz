<script>
    $(document).ready(function () {
        @if(is_null(cache()->get('visitor:'.request()->getClientIp())))
            setTimeout(() => {
                $.ajax({
                    url: "{{ route('visitor.store') }}",
                    success: function (res) {
                        console.info('USER COOKIES SUCCESSFULLY COLLECTED')
                    }
                });
            }, 2000);
        @endif
    });
</script>
