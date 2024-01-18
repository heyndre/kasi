<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon-16x16.png')}}">

    <title>Notifikasi Portal KASI</title>
</head>

<body>
    <div class="font-sans text-gray-900 antialiased w-full" style="width: 100%;">

        <div class="text-xl font-bold" style="font-size: 2em; font-weight: 800;">
            Informasi Pembayaran Tagihan Kelas KASI
        </div>

        <table style="width: 100%; ">
            <tr>
                <td>
                    Nama :
                </td>
                <td>
                    {{$data['studentName']}}
                </td>
            </tr>
            <tr>
                <td>
                    NIM :
                </td>
                <td>
                    {{$data['studentNIM']}}
                </td>
            </tr>
            <tr>
                <td>
                    Wali Murid :
                </td>
                <td>
                    {{$data['guardianName']}}
                </td>
            </tr>
        </table>
        <hr>
        <div class=" mt-4" style="margin-top: 2rem;">
            <p class="text-xl" style="font-size: 2rem;">Waktu pembayaran murid</p>
            <p class="font-bold" style="font-weight: 800;">
                {{$data['studentPayTime']}}
            </p>
        </div>
        <hr>
        <a class=""
            href="{{ route('payment.student.status', ['id' => $data['billingID']]) }}">
            Buka Detail Billing
        </a>
        <hr>
        <a class=""
            href="{{ route('payment.student.confirm', ['id' => $data['paymentID']]) }}">
            Buka Bukti Pembayaran
        </a>
    </div>

    <img src="{{$message->embed(storage_path('app/public/KASI Email Banner.png'))}}" alt="" srcset="" class="w-20 h-20">
</body>

</html>