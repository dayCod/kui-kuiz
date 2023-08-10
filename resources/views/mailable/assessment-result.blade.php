<x-mail::message>
# Thanks For Using Us.

# Here's your assessment result
- Assessment Serial Number  : {{ $asmnt_serial_number }},
- Assessment Name           : {{ $asmnt_name }},
- Final Result              : {{ $final_result }},

{{-- <x-mail::button :url="''">
Button Text
</x-mail::button> --}}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
