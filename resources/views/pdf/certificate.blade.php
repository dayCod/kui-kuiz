<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <meta http-equiv="Content-Type" content="application/pdf" charset="utf-8> --}}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com"> --}}
    {{-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> --}}
    {{-- <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"> --}}

    <title>Certificate Page</title>
</head>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
        font-weight: 700;
        font-size: 18px;
        color: #121212;
        background-repeat: no-repeat;
        background-size: auto;
        background-position: right top;
        width: 100%;
        height: 100%;
        text-align: center;
        padding: 40px 15px;
        position: relative;
    }

    .certificate-background {
        margin: -40px -15px;
        position: absolute;
        width: inherit;
        height: inherit;
        object-fit: cover;
        object-position: center;
        opacity: 0.4;
        z-index: 3;
        top: 0;
        left: 0;
    }

    .certificate-wrapper {
        position: absolute;
        width: 93%;
        top: 20%;
        z-index: 100;
    }

    /* .certificate-wrapper > div, .certificate-footer > div{
        display: flex;
        flex-direction: column;
        align-items:center;
    } */

    .img-fluid {
        width: 300px;
    }

    .certificate-number {
        font-size: 28px;
    }

    .certificate-number span,
    .sign-name span {
        display: block;
        padding: 5px;
        font-weight: bold;
    }

    .certificate-body {
        margin-top: 30px;
    }

    .certificate-body h1 {
        font-size: 30px;
    }

    .certificate-body h5 {
        font-size: 20px;
    }

    .certificate-body span {
        font-weight: 600;
    }

    .certificate-footer {
        font-weight: 500;
        margin-top: 80px;
    }

    .regular-font {
        font-weight: 400;
    }

    .img-sign {
        margin-top: 30px;
        width: 120px;
    }
</style>

<body>
    @if ($background)
        <img src="{{ public_path('storage/certificate/background/'.getFileName($background)) }}" alt="Certificate Background"
            class="certificate-background">
    @endif
    <div class="certificate-wrapper">
        <div class="certificate-number">
            <p class="underline">
                Serial Number: {{ $asmnt_serial_number }} <br>
                <span style="font-size: 24px">{{ ucfirst($asmnt_name) }}</span>
            </p>
        </div>

        <div class="certificate-body">
            <h1 class="">{{ $user_name }}</h1>
            <h5> Final Result :</h5>
            <h1 class=""> {{ $final_result }} </h1>
        </div>

        <div class="certificate-footer">
            <div class="certificate-date">
                <span class="">Signatured Date,</span><br>
                <span class="">{{ $created_at }}</span>
            </div>

            <br>

            <a class="">
                <img src="{{ public_path('storage/certificate/signature/'.getFileName($signature_img)) }}" class="img-sign" alt="sign">
            </a>

            <br>

            <div class="sign-name" style="margin-top: 30px">
                <p>
                    {{ ucfirst($signatured_by) }} <br>
                </p>
            </div>
        </div>
    </div>


</body>


</html>
