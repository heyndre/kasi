<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('site.webmanifest')}}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif !important;

        }
    </style>
    <style>
        @page {
            margin: 5mm 10mm 0mm 10mm !important;
        }

        .header {
            font-weight: bold;
            font-size: 14pt;
        }

        .header-bigger {
            font-weight: bold;
            font-size: 24pt;
        }

        .header-smaller {
            font-weight: bold;
            font-size: 9pt;
        }

        body {
            font-size: 9pt !important;
        }

        .text-right {
            text-align: right;
        }

        table,
        tr,
        td,
        th .bordered {
            border: solid 1px #222;
            border-collapse: collapse;
        }

        .td-right {
            text-align: right;
        }

        .td-center {
            text-align: center;
        }

        .footer {
            text-align: center;
            font-weight: bold;
        }

        th {
            text-align: center;
        }

        .pagebreak {
            page-break-before: always;
        }
    </style>
</head>

<body class="font-sans antialiased max-w-full">
    <div class="flex justify-between items-center px-4 pt-4 pb-2 bg-gradient-to-r from-orange-200 to-white">
        <!-- Logo -->
        <div class="shrink-0 flex items-center" style="max-width: 50%;">
            <a href="{{ route('root') }}">
                <img src="{{storage_path('app/public/logo-small.png')}}" alt="" srcset="" class="block h-16 w-auto">
            </a>
        </div>
        <div class="text-2xl font-bold drop-shadow-md" style="max-width: 50%;">
            {{-- <span class="drop-shadow-md"> --}}
                Tagihan Kelas KASI
                {{-- </span> --}}
        </div>
    </div>
    <hr class="" style="border-color:#e36c2a">
    <!-- Page Content -->
    <main>
        <div class="p-3 mt-2">
            <div class="italic text-gray-800 text-sm">
                Terima kasih telah belajar bersama KASI!
            </div>
            <div class="text-gray-800 text-sm mt-6">
                Berikut rincian tagihan murid a.n. :
                <span class="px-4 font-bold bg-amber-100 rounded-md my-1">
                    Matahari Nadia Wicaksono - NIM 2023000112300
                </span>
                <p>untuk bulan <span class="font-bold">Desember 2023</span></p>
            </div>
            <table class="w-full mt-4 text-sm table-auto text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                    <tr>
                        <th scope="col" class="p-1 bg-amber-700 text-white">
                            #
                        </th>
                        <th scope="col" class="p-2 bg-amber-400">
                            Tanggal & Tutor
                        </th>
                        <th scope="col" class="p-2 bg-amber-700 text-white">
                            Durasi
                        </th>
                        <th scope="col" class="p-2 bg-amber-400">
                            Biaya
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $price=35000;
                    $totalPrice = 0;
                    $totalHours = 0;
                    $hours = 60;
                    @endphp
                    @for ($i = 0; $i < 15; $i++) @php $totalPrice +=$price; $totalHours +=$hours; @endphp <tr
                        class="border-b border-amber-800 dark:border-gray-700">
                        <th scope="row" class="p-1 font-medium whitespace-nowrap bg-amber-600 text-white ">
                            {{$i+1}}
                        </th>
                        <td class="p-2 bg-amber-100">
                            23/12/2023 - Ms. Tia
                            {{-- Gerund {{Str::random(32)}} --}}
                        </td>
                        <td class="p-2 bg-amber-600 text-white">
                            {{$hours}} mnt
                        </td>
                        <td class="p-2 bg-amber-100">
                            Rp.{{number_format($price, 0, ',', '.')}}
                        </td>
                        </tr>
                        @endfor
                </tbody>
                <tfoot>
                    <tr class="font-semibold text-gray-900 dark:text-white">
                        <td scope="row" class="p-2 text-base bg-amber-800 text-white" colspan="2">Jumlah</td>
                        <td class="p-2 bg-amber-600 text-white font-bold">{{$totalHours / 60}} jam</td>
                        <td class="p-2 bg-amber-100 font-bold">Rp.{{number_format($totalPrice, 0, ',', '.')}}</td>
                    </tr>
                </tfoot>
            </table>
            <div class="grid grid-cols-2 gap-x-4">
                <div class="mt-4 text-gray-800 text-sm">
                    Pembayaran dapat dilakukan melalui transfer ke
                    <p class="font-bold">BANK BCA 0240920395</p>
                    <p class="text-sm italic">a.n. Firstya Andreas Pandega</p>
                    maksimal pada tanggal <span class="font-bold">{{now()->addDays(10)->format('d-m-Y')}}</span>.
                    Keterlambatan pembayaran dapat mengakibatkan denda.
                </div>
                <div class="mt-4 text-gray-800 text-sm">
                    <span class="font-bold text-2xl text-amber-500/40 italic text-right">
                        Belajar Dulu, Menginspirasi Kemudian!
                    </span>
                </div>
            </div>
        </div>
    </main>
</body>

</html>