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
    <link rel="stylesheet" href="{{asset('js/calendar-js/calendar.js.css')}}" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <link href="{{asset('lightbox2-2.11.4/dist/css/lightbox.css')}}" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="{{asset('lightbox2-2.11.4/dist/js/lightbox.js')}}"></script>
    <link href="{{asset('woocommerce-FlexSlider-690832b/flexslider.css')}}" rel="stylesheet" />
    <script src="{{asset('woocommerce-FlexSlider-690832b/jquery.flexslider.js')}}"></script>
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">

    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>

    @if (isset($style))
    {{ $style }}
    @endif

    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow ">
            <div class="max-w-7xl flex justify-between items-center mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
                @if (isset($button))
                <div class="flex space-x-2">
                    {{ $button }}
                </div>
                @endif
            </div>
        </header>
        @endif


        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    <div class="p-4 text-gray-800 text-sm flex justify-between items-center">
        <span class="font-bold text-2xl text-amber-500/40 italic text-right">
            Belajar Dulu, Menginspirasi Kemudian!
        </span>

        @php
        $whatsapp = \App\Models\Setting::where('key', 'whatsapp')->value('value');
        @endphp
        <a href="https://wa.me/{{$whatsapp}}?text=Halo%2C saya butuh bantuan tentang Portal KASI" class=""
            target="_blank">
            Butuh bantuan?
            <span class="p-1 bg-amber-600 text-white rounded-md hover:bg-amber-800 transition">
                Hubungi Admin KASI via WhatsApp
            </span>
        </a>
    </div>
    @stack('modals')

    @livewireScripts


    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/datepicker.min.js"></script>
    {{-- <script>
        FilePond.parse(document.body);
    </script> --}}

    {{-- <script>
        // Get a reference to the file input element
        const inputElement = document.querySelector('input[type="file"]');
    
        // Create a FilePond instance
        const pond = FilePond.create(inputElement);
    </script> --}}
</body>

</html>