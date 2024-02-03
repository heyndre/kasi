<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    {{-- @livewireStyles --}}

</head>
{{-- w-[1080px] max-w-[1080px] h-[1920px] max-h-[1920px] --}}

<body class="font-sans antialiased max-w-full">
    <div class="flex justify-between items-center px-4 pt-4 pb-2 bg-gradient-to-r from-orange-200 to-white">
        <!-- Logo -->
        <div class="shrink-0 flex items-center">
            <a href="{{ route('root') }}">
                <img src="{{storage_path('app/public/logo-small.png')}}" alt="" srcset="" class="block h-16 w-auto">
            </a>
        </div>
        <div class="">
            <div class="text-2xl font-bold drop-shadow-md">
                {{-- <span class="drop-shadow-md"> --}}
                    KASI Class Invoice - {{str_pad($billing->invoice_id, 5, '0', STR_PAD_LEFT)}}
                    {{-- </span> --}}
            </div>
            <div class="text-sm font-thin mt-2">Invoice generated on {{now()->format('d/m/Y H:i:s T')}}</div>
        </div>
    </div>
    <hr class="" style="border-color:#e36c2a">
    <!-- Page Content -->
    <main>
        <div class="p-3 mt-2">
            <div class="italic text-gray-800 text-sm">
                Thank you for learning with KASI!
            </div>
            @php
            // setlocale(LC_ALL, 'id_ID');
            @endphp
            <div class="text-gray-800 text-sm mt-6">
                Below is the billing details for :
                <div class="px-4 py-2 font-semibold bg-amber-100 rounded-md my-1">
                    {{$billing->theStudentData->name}} - Student Reg Number {{$billing->theStudent->nim}}
                </div>
                for <span class="font-semibold">{{$billing->bill_date->subMonth()->format('F Y')}}</span>
            </div>
            <table class="w-full mt-4 text-sm table-auto text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                    <tr>
                        <th scope="col" class="p-1 bg-amber-700 text-white">
                            #
                        </th>
                        <th scope="col" class="p-2 bg-amber-400">
                            Date & Tutor
                        </th>
                        <th scope="col" class="p-2 bg-amber-700 text-white">
                            Length
                        </th>
                        <th scope="col" class="p-2 bg-amber-400">
                            Price
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $price=0;
                    $totalPrice = 0;
                    $totalHours = 0;
                    $hours = 0;
                    $i=1;
                    @endphp
                    {{-- @for ($i = 0; $i < 15; $i++) @php $totalPrice +=$price; $totalHours +=$hours; @endphp --}}
                        @foreach ($billing->theClass as $item)
                        @php
                        $totalPrice += $item->price * $item->length / 60;
                        $totalHours += $item->length;
                        @endphp
                        <tr class="border-b border-amber-800 dark:border-gray-700">
                            <th scope="row" class="p-1 font-medium whitespace-nowrap bg-amber-600 text-white ">
                                {{$i++}}
                            </th>
                            <td class="p-2 bg-amber-100">
                                {{$item->date_of_event->format('d/m/y')}} - {{$item->theTutor->userData->nickname}}
                                {{-- Gerund {{Str::random(32)}} --}}
                            </td>
                            <td class="p-2 bg-amber-600 text-white">
                                {{$item->length}} mins
                            </td>
                            <td class="p-2 bg-amber-100">
                                KRW {{number_format($item->price * $item->length / 60, 0, ',', '.')}}
                            </td>
                        </tr>
                        @endforeach
                        {{-- @endfor --}}

                </tbody>
                <tfoot>
                    <tr class="font-semibold text-gray-900 dark:text-white">
                        <td scope="row" class="p-2 text-base bg-amber-800 text-white font-bold" colspan="2">Sum</td>
                        <td class="p-2 bg-amber-600 text-white font-bold">{{$totalHours / 60}} Hours</td>
                        <td class="p-2 bg-amber-100 font-bold">{{number_format($totalPrice, 0, ',', '.')}}</td>
                    </tr>
                    <tr class="border-b border-amber-800 dark:border-gray-700">
                        <td scope="row" class="p-2 text-base bg-amber-800 text-white font-bold" colspan="2">
                            Promo Code
                        </td>
                        <td class="p-2 bg-amber-600 text-white">
                            @if ($billing->promo_code != null)
                            {{$billing->promo_code}}
                            @else
                            No promo
                            @endif
                        </td>
                        <td class="p-2 bg-amber-100">
                            @if ($billing->promo_code != null)
                            ({{number_format($billing->amount - $billing->amount_no_promo, 0, ',', '.')}})
                            @else
                            -
                            @endif

                        </td>
                    </tr>
                    <tr class="font-semibold text-gray-900 dark:text-white">
                        <td scope="row" class="p-2 text-base bg-amber-800 text-white font-bold" colspan="3">Total</td>
                        {{-- <td class="p-2 bg-amber-600 text-white font-bold">{{$totalHours / 60}} jam</td> --}}
                        <td class="p-2 bg-amber-100 font-bold">KRW {{number_format($totalPrice - ($billing->amount_no_promo -
                            $billing->amount), 0, ',', '.')}}</td>
                    </tr>
                    {{-- <tr class="">
                        <td scope="row" colspan="4">
                            <p class="italic">
                                Terbilang {{Terbilang::make($totalPrice - ($billing->amount_no_promo - $billing->amount), '
                                rupiah')}}
                            </p>
                        </td>
                    </tr> --}}
                </tfoot>
            </table>
            <div class="grid grid-cols-2 gap-x-4 items-end">
                <div class="mt-4 text-gray-800 text-sm">
                    Please transfer the payment to
                    <p class="font-semibold">BANK BCA (Indonesia) 0240920395</p>
                    <p class="text-sm italic"> Firstya Andreas Pandega</p>
                    before <span class="font-bold">{{$billing->due_date->format('d/m/Y')}}</span>.
                    Passing this date will incur additional fees.
                </div>
            </div>
            <div class="mt-4 text-gray-800 text-sm">
                <span class="font-bold text-2xl text-amber-500/40 italic text-right">
                    Learn First, Inspire Later!
                </span>
            </div>
        </div>
        </div>
    </main>
    {{-- @stack('modals') --}}

    {{-- @livewireScripts --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.js"></script>

</body>

</html>