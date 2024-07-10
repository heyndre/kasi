<div>
    <x-page.header>
        Detail Tutor
    </x-page.header>
    <x-slot name='button'>
        <x-page.edit-button>
            Ubah
            <x-slot name='route'>
                {{ route('tutor.edit', ['slug' => $slug]) }}
            </x-slot>
        </x-page.edit-button>
        {{-- <x-page.back-button>
            Kembali
            <x-slot name='route'>
                {{route('tutor.active')}}
            </x-slot>
        </x-page.back-button> --}}
    </x-slot>

    <x-page.style>
        <style>
            label {
                font-weight: 600 !important;
            }

            .no-resize {
                resize: none !important;
            }
        </style>

    </x-page.style>

    <x-page.content-white>
        <div class="px-4 py-2">
            @if (session()->has('success'))
                <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">INFO</span> {{ session('success') }}
                    </div>
                </div>
            @endif
            <div
                class=" min-h-[100vh] flex flex-col w-full gap-4 p-4 bg-white border border-gray-200 rounded-lg md:flex-row dark:border-gray-700 dark:bg-gray-800">
                <div class="w-1/3 p-6">
                    <img class="object-cover w-full rounded-2xl h-96 md:h-auto drop-shadow-2xl"
                        src="{{ $photoUrl }}" alt="">
                </div>
                <div class="flex flex-col  leading-normal w-2/3" wire:ignore>
                    @if ($status == 'Aktif')
                        <div
                            class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                            Status Tutor Aktif
                        </div>
                    @elseif ($status == 'Berhenti Sementara')
                        <div
                            class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                            Berhenti Sementara
                        </div>
                    @elseif ($status == 'Berhenti Permanen')
                        <div
                            class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                            Berhenti Permanen
                        </div>
                    @elseif ($status == 'Reaktivasi')
                        <div
                            class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                            Aktif Kembali
                        </div>
                    @else
                    @endif
                    <div
                        class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 rounded-t-lg bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800"
                            id="defaultTab" data-tabs-toggle="#defaultTabContent" role="tablist">
                            <li class="me-2">
                                <button id="about-tab" data-tabs-target="#about" type="button" role="tab"
                                    aria-controls="about" aria-selected="true"
                                    class="inline-block p-4 text-blue-600 rounded-ss-lg hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-blue-500">
                                    Biodata Tutor
                                </button>
                            </li>
                            <li class="me-2">
                                <button id="services-tab" data-tabs-target="#services" type="button" role="tab"
                                    aria-controls="services" aria-selected="false"
                                    class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                                    Informasi Keuangan
                                </button>
                            </li>
                            <li class="me-2">
                                <button id="statistics-tab" data-tabs-target="#statistics" type="button" role="tab"
                                    aria-controls="statistics" aria-selected="false"
                                    class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                                    Informasi Akun
                                </button>
                            </li>
                            <li class="me-2">
                                <button id="classes-tab" data-tabs-target="#classes" type="button" role="tab"
                                    aria-controls="classes" aria-selected="false"
                                    class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                                    Informasi Kelas
                                </button>
                            </li>
                            <li class="me-2">
                                <button id="evaluation-tab" data-tabs-target="#evaluation" type="button" role="tab"
                                    aria-controls="evaluation" aria-selected="false"
                                    class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                                    Informasi Evaluasi
                                </button>
                            </li>

                            <li class="me-2">
                                <button id="char-tab" data-tabs-target="#char" type="button" role="tab"
                                    aria-controls="char" aria-selected="false"
                                    class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                                    Informasi Karakteristik
                                </button>
                            </li>
                        </ul>
                        <div id="defaultTabContent">
                            <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800 w-full" id="about"
                                role="tabpanel" aria-labelledby="about-tab">
                                <div class="grid grid-cols-2 grid-flow-auto gap-4">
                                    <div class="w-fit">
                                        <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                            for="name">
                                            Nama Tutor
                                        </label>
                                        <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                            {{ $name }}
                                        </div>
                                    </div>
                                    <div class="w-fit">
                                        <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                            for="name">
                                            ID Tutor
                                        </label>
                                        <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                            {{ $tutor->id }}
                                        </div>
                                    </div>
                                    <div class="w-fit">
                                        <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                            for="name">
                                            Email Tutor
                                        </label>
                                        <a href="mailto:{{ $email }}" target="_blank">
                                            <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                                {{ $email }}
                                            </div>
                                        </a>
                                    </div>
                                    <div class="w-fit">
                                        <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                            for="name">
                                            Nomor Telepon/WhatsApp Tutor
                                        </label>
                                        <a href="https://wa.me/{{ $whatsapp }}" target="_blank">
                                            <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                                +{{ $whatsapp }}
                                            </div>
                                        </a>
                                    </div>
                                    <div class="w-fit">
                                        <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                            for="name">
                                            Alamat Tutor
                                        </label>
                                        <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                            {{ $address }}
                                        </div>
                                    </div>
                                    <div class="w-fit">
                                        <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                            for="name">
                                            Tanggal Ulang Tahun Tutor
                                        </label>
                                        <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                            {{ $birthday == null ? '' : $birthday->format('d F Y') }}
                                            <p class="italic font-thin">Ulang tahun dalam
                                                {{ $nextAnniversary->diffForHumans(now(), Carbon\CarbonInterface::DIFF_ABSOLUTE, false, 2) }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="w-fit">
                                        <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                            for="name">
                                            Status Studi Tutor
                                        </label>
                                        <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                            {{ $eduStatus }}
                                        </div>
                                    </div>
                                    {{-- @if ($eduStatus == 'Sedang Menempuh Studi') --}}
                                    <div class="w-fit">
                                        <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                            for="name">
                                            Jenjang Pendidikan Tutor
                                        </label>
                                        <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                            {{ $eduLevel }}
                                        </div>
                                    </div>

                                    <div class="w-fit">
                                        <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                            for="name">
                                            Tempat Pendidikan Tutor
                                        </label>
                                        <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                            {{ $eduSite }}
                                        </div>
                                    </div>

                                    {{-- @else --}}
                                    <div class="w-fit">
                                        <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                            for="name">
                                            Pekerjaan Tutor
                                        </label>
                                        <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                            {{ $workTitle }}
                                        </div>
                                    </div>

                                    @if ($workTitle != 'Ibu Rumah Tangga' && $workTitle != 'Tidak Memiliki Pekerjaan')
                                        <div class="w-fit">
                                            <label
                                                class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                                for="name">
                                                Tempat Bekerja Tutor
                                            </label>
                                            <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                                {{ $workSite }}
                                            </div>
                                        </div>
                                    @endif
                                    {{-- @endif --}}
                                </div>
                            </div>
                        </div>
                        <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="services"
                            role="tabpanel" aria-labelledby="services-tab">
                            <div class="grid grid-cols-2 grid-flow-auto gap-4">
                                <div class="w-fit">
                                    <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                        for="name">
                                        Status Pembayaran Tutor
                                    </label>
                                    <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">

                                    </div>
                                </div>
                                <div class="w-fit">
                                    <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                        for="name">
                                        Nama Bank Tutor
                                    </label>
                                    <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                        {{ $bankName }}
                                    </div>
                                </div>
                                <div class="w-fit">
                                    <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                        for="name">
                                        Nomor Rekening Tutor
                                    </label>
                                    <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                        {{ $bankNumber }}
                                    </div>
                                </div>
                                <div class="w-fit">
                                    <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                        for="name">
                                        Informasi Tambahan
                                    </label>
                                    <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                        {{ $bankAdditionalInfo }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="statistics"
                            role="tabpanel" aria-labelledby="statistics-tab">
                            <dl
                                class="flex justify-between w-full grid-cols-2 gap-8 p-4 mx-auto text-gray-900 sm:grid-cols-3 xl:grid-cols-6 dark:text-white sm:p-8">
                                <div class="flex flex-col">
                                    <dt class="mb-2 text-3xl font-extrabold">
                                        {{ $registeredAt->format('d-m-Y H:i:s
                                                                                                                                                                                                                                                T') }}
                                    </dt>
                                    <dd class="text-gray-500 dark:text-gray-400">Registrasi sejak</dd>
                                </div>
                                <div class="flex flex-col">
                                    <dt class="mb-2 text-3xl font-extrabold">
                                        {{ $lastLoginAt == null
                                            ? 'Belum Login'
                                            : $lastLoginAt->format('d-m-Y H:i:s
                                                                                                                                                                                                                                                T') }}
                                    </dt>
                                    <dd class="text-gray-500 dark:text-gray-400">
                                        Login Terakhir
                                    </dd>
                                </div>
                                <div class="flex flex-col">
                                    <dt class="mb-2 text-3xl font-extrabold">
                                        {{ $lastActiveAt == null
                                            ? 'Belum Aktif'
                                            : $lastActiveAt->format('d-m-Y H:i:s
                                                                                                                                                                                                                                                T') }}
                                    </dt>
                                    <dd class="text-gray-500 dark:text-gray-400">Aktivitas Terakhir</dd>
                                </div>
                            </dl>
                        </div>
                        <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="classes">
                            <div class="px-4 pt-4 w-full">
                                <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                    for="name">
                                    Mata Pelajaran/Bidang Tutor
                                </label>
                                <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                    @foreach ($tutor->theSkill as $key => $item)
                                        <span class="">{{ $key > 0 ? ', ' : '' }}{{ $item->name }}</span>
                                    @endforeach

                                </div>
                            </div>
                            <div class="">
                                {{-- Today Classes --}}
                                <x-table.classes search='false'>
                                    <x-slot name="title">
                                        Daftar Kelas Tutor ({{ $tutor->theSession->count('id') }})
                                    </x-slot>

                                    <x-slot name="caption">
                                        Per {{ date('d F Y H:i T') }}
                                    </x-slot>

                                    <x-slot name="head">
                                        <x-table.head>
                                            Waktu
                                        </x-table.head>
                                        <x-table.head>
                                            Mata Pelajaran
                                        </x-table.head>
                                        <x-table.head>
                                            Nama Murid
                                        </x-table.head>
                                        <x-table.head>
                                            Topik
                                        </x-table.head>
                                        <x-table.head>
                                            Opsi
                                        </x-table.head>
                                    </x-slot>

                                    <x-slot name="body">
                                        @php
                                            // dd($today);
                                        @endphp
                                        @forelse ($tutor->theSession as $i => $item)
                                            <x-table.row-class-billing wire:loading.class.delay.longest='opacity-80'
                                                :tutor='$item->theStudent' :student='$item->theTutor' :course='$item->theCourse' :item='$item'
                                                showTutorSharing='true'>
                                                <x-slot name="id">
                                                    {{ $item->id }}
                                                </x-slot>
                                                <x-slot name="time">
                                                    {{ $item->date_of_event->format('d M Y H:i T') }}
                                                </x-slot>
                                                <x-slot name="topic">
                                                    {{ $item->topic }}
                                                </x-slot>
                                            </x-table.row-class-billing>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="px-2 py-3 italic">
                                                    Tidak ada data kelas
                                                </td>
                                            </tr>
                                        @endforelse
                                    </x-slot>
                                    <x-slot name="foot">
                                    </x-slot>
                                </x-table.classes>
                            </div>
                        </div>
                        <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="evaluation">
                            @forelse ($evaluation as $item)
                                <div class="px-4 pt-4 w-full">
                                    <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                        for="name">
                                        Periode Evaluasi
                                    </label>
                                    <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                        Mei-Agustus 2024 (Quadrimester 2 2024)
                                    </div>
                                    <div class="mb-4 font-light text-gray-900 sm:mb-5 underline cursor-pointer"
                                        wire:click='downloadReport()'>
                                        Unduh Laporan Evaluasi
                                    </div>
                                </div>
                                <div class="">
                                    {{-- Today Classes --}}
                                    <x-table.classes search='false'>
                                        <x-slot name="title">
                                            Penilaian Kelas
                                        </x-slot>

                                        <x-slot name="caption">
                                            Per {{ date('d F Y H:i T') }} periode Mei-Agustus 2024 (Quadrimester 2
                                            2024)
                                        </x-slot>

                                        <x-slot name="head">
                                            <x-table.head>
                                                Waktu Penilaian
                                            </x-table.head>
                                            <x-table.head>
                                                Nilai Teknis
                                            </x-table.head>
                                            <x-table.head>
                                                Nilai Pengajaran
                                            </x-table.head>
                                            <x-table.head>
                                                Rata-rata
                                            </x-table.head>
                                            <x-table.head>
                                                Opsi
                                            </x-table.head>
                                        </x-slot>

                                        <x-slot name="body">
                                            @forelse ($item->theMeetingEval as $i => $data)
                                                @php
                                                    // dd($data);
                                                @endphp
                                                <x-table.row-class-eval wire:loading.class.delay.longest='opacity-80'
                                                    :student='$data->theStudent' :course='$data'>
                                                    <x-slot name="id">
                                                        {{ $data->id }}
                                                    </x-slot>
                                                    <x-slot name="courseId">
                                                        {{ $data->theCourse->id }}
                                                    </x-slot>
                                                    <x-slot name="time">
                                                        {{ $data->theCourse->date_of_event->format('d M Y H:i T') }}
                                                    </x-slot>
                                                    <x-slot name="topic">
                                                        {{ $data->theCourse->topic }}
                                                    </x-slot>
                                                </x-table.row-class-eval>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="px-2 py-3 italic">
                                                        Tidak ada data kelas
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </x-slot>
                                        <x-slot name="foot">
                                        </x-slot>
                                    </x-table.classes>
                                </div>

                            @empty
                                <div class="px-4 pt-4 w-full">
                                    <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                        for="name">
                                        Belum ada evaluasi.
                                    </label>
                                </div>
                            @endforelse
                        </div>
                        <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="char">
                            <div class="pt-4 w-full">
                                <label class="mb-4 font-semibold leading-none text-gray-900 dark:text-white"
                                    for="name">
                                    Preferensi Tutor
                                </label>
                                <div class="flex gap-x-4 w-full">
                                    <div class="mb-5">
                                        <label for="duration"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Durasi Kelas
                                        </label>
                                        <select name="" id="duration" wire:model.defer='preference.duration'
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option>Pilih</option>
                                            <option value="1">
                                                < 30 menit</option>
                                            <option value="5">30 - 60 menit</option>
                                            <option value="9">> 30 menit</option>
                                        </select>
                                    </div>
                                    <div class="mb-5">
                                        <label for="time_of_day"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Waktu Pelaksanaan Kelas
                                        </label>
                                        <select name="" id="time_of_day"
                                            wire:model.defer='preference.time_of_day'
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option>Pilih</option>
                                            <option value="2">Pagi (03.00 - 10.00)</option>
                                            <option value="4">Siang (10.00 - 15.00)</option>
                                            <option value="6">Sore (15.00 - 18.00)</option>
                                            <option value="8">Malam (18.00 - 03.00)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full flex gap-x-4 gap-y-4">
                                {{-- <div class="mb-5">
                                    <label for="char1"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Neuroticisim
                                    </label>
                                    <input type="text" id="char1" wire:model.defer='char.neuro'
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                                </div> --}}
                                <div class="mb-5">
                                    <label for="char2"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Extraversion
                                    </label>
                                    <input type="text" id="char2" wire:model.defer='char.extra'
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                                </div>
                                <div class="mb-5">
                                    <label for="char3"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Openness
                                    </label>
                                    <input type="text" id="char3" wire:model.defer='char.open'
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                                </div>
                                <div class="mb-5">
                                    <label for="char4"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Agreeableness
                                    </label>
                                    <input type="text" id="char4" wire:model.defer='char.agree'
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                                </div>
                                <div class="mb-5">
                                    <label for="char5"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Conscientiousness
                                    </label>
                                    <input type="text" id="char5" wire:model.defer='char.conscient'
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                                </div>
                            </div>
                            <div wire:click='saveChar' wire:loading.remove class="w-1/4 cursor-pointer focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                Simpan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



</div>
</x-page.content-white>
</div>
