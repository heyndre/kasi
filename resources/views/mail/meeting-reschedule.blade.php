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
            Informasi Perubahan Jadwal Kelas KASI
        </div>
        <hr>
        <div class="" style="font-weight:700">
            @if ($data['role'] == 'TUTOR')
            Yth. Tutor {{$data['tutorName']}}
            @elseif ($data['role'] == 'MURID')
            Yth. Murid KASI {{$data['studentName']}} - NIM {{$data['studentNIM']}}
            @elseif ($data['role'] == 'WALI MURID')
            Yth. Wali Murid KASI {{$data['guardianName']}}
            @endif
        </div>
        <br>
        <p style="">Berikut kami sampaikan perubahan jadwal pelaksanaan kelas untuk murid a.n. {{$data['studentName']}} - NIM
            {{$data['studentNIM']}}</p>


        <table style="width: 100%;">
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
                    Jadwal Kelas Lama :
                </td>
                <td>
                    {{$data['className']}} #{{$data['classID']}} | {{$data['classDateNew']}}
                </td>
            </tr>
            <tr>
                <td>
                    Jadwal Kelas Baru :
                </td>
                <td>
                    {{$data['className']}} #{{$data['classID']}} | {{$data['classDate']}}
                </td>
            </tr>
            <tr>
                <td>
                    Tutor :
                </td>
                <td>
                    {{$data['tutorName']}}
                </td>
            </tr>
        </table>
        @if ($data['role'] == 'TUTOR')
        <a class="" href="{{ route('tutor.classes.show', ['id' => $data['classID']]) }}">
            Buka Halaman Kelas
        </a>
        @elseif ($data['role'] == 'MURID')
        <a class="" href="{{ route('student.classes.show', ['id' => $data['classID']]) }}">
            Buka Halaman Kelas
        </a>
        @elseif ($data['role'] == 'WALI MURID')
        <a class="" href="{{ route('student.classes.show', ['id' => $data['classID']]) }}">
            Buka Halaman Kelas
        </a>
        @endif

    </div>

    <img src="{{$message->embed(storage_path('app/public/KASI Email Banner.png'))}}" alt="" srcset="" class="w-20 h-20">
</body>

</html>