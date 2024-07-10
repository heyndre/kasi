<div>
    <x-page.header>
        Detail Murid - {{ $nim }}
    </x-page.header>
    <x-slot name='button'>
        <x-page.edit-button>
            Ubah
            <x-slot name='route'>
                {{ route('student.edit', ['nim' => $nim]) }}
            </x-slot>
        </x-page.edit-button>
        {{-- <x-page.back-button>
            Kembali
            <x-slot name='route'>
                {{route('student.active')}}
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
                            Status Murid Aktif
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
                                    Biodata Murid
                                </button>
                            </li>
                            <li class="me-2">
                                <button id="services-tab" data-tabs-target="#services" type="button" role="tab"
                                    aria-controls="services" aria-selected="false"
                                    class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                                    Wali Murid
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
                                <button id="char-tab" data-tabs-target="#char" type="button" role="tab"
                                    aria-controls="char" aria-selected="false"
                                    class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                                    Informasi Karakteristik
                                </button>
                            </li>
                            <li class="me-2">
                                <button id="recommend-tab" data-tabs-target="#recommend" type="button" role="tab"
                                    aria-controls="recommend" aria-selected="false"
                                    class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                                    Rekomendasi Tutor
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
                                            Nama Murid
                                        </label>
                                        <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                            {{ $name }}
                                        </div>
                                    </div>
                                    <div class="w-fit">
                                        <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                            for="name">
                                            Nomor Telepon/WhatsApp Murid
                                        </label>
                                        <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                            @if ($whatsapp != null && $whatsapp !== '')
                                                <a href="https://wa.me/{{ $whatsapp }}" target="_blank">
                                                    +{{ $whatsapp }}
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                    <div class="w-fit">
                                        <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                            for="name">
                                            Tanggal Ulang Tahun Murid
                                        </label>
                                        <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                            {{ $birthday == null ? '' : $birthday->format('d F Y') }}
                                            <p class="italic font-thin">Ulang tahun dalam
                                                {{ $nextAnniversary->diffForHumans(now(), Carbon\CarbonInterface::DIFF_ABSOLUTE, false, 3) }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="w-fit">
                                        <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                            for="name">
                                            Alamat Murid
                                        </label>
                                        <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                            {{ $address }}
                                        </div>
                                    </div>
                                    <div class="w-fit">
                                        <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                            for="name">
                                            Status Studi Murid
                                        </label>
                                        <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                            {{ $eduStatus }}
                                        </div>
                                    </div>
                                    @if ($eduStatus == 'Sedang Menempuh Studi')
                                        <div class="w-fit">
                                            <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                                for="name">
                                                Jenjang Pendidikan Murid
                                            </label>
                                            <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                                {{ $eduLevel }}
                                            </div>
                                        </div>

                                        <div class="w-fit">
                                            <label
                                                class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                                for="name">
                                                Tempat Pendidikan Murid
                                            </label>
                                            <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                                {{ $eduSite }}
                                            </div>
                                        </div>
                                    @else
                                        <div class="w-fit">
                                            <label
                                                class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                                for="name">
                                                Pekerjaan Murid
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
                                                    Tempat Bekerja Murid
                                                </label>
                                                <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                                    {{ $workSite }}
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="services"
                            role="tabpanel" aria-labelledby="services-tab">
                            <div class="grid grid-cols-2 grid-flow-auto gap-4">
                                <div class="w-fit">
                                    <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                        for="name">
                                        Status Wali Murid
                                    </label>
                                    <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                        {{ $hasGuardian != null && $hasGuardian != '' && $hasGuardian == 1
                                            ? 'Punya
                                                                                                                                                                                                        Wali
                                                                                                                                                                                                        Murid'
                                            : 'Tidak Punya Wali Murid' }}
                                    </div>
                                </div>
                                @if ($hasGuardian == 1)
                                    <div class="w-fit">
                                        <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                            for="name">
                                            Nama Wali Murid
                                        </label>
                                        <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                            <a
                                                href="{{ route('guardian.show', ['slug' => $guardian->userData->slug]) }}">
                                                {{ $guardianName != null && $guardianName != '' ? $guardianName : '-' }}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="w-fit">
                                        <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                            for="name">
                                            Nomor Telepon/WhatsApp Wali Murid
                                        </label>
                                        <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                            @if ($guardianWhatsapp != null && $guardianWhatsapp !== '')
                                                <a href="https://wa.me/{{ $guardianWhatsapp }}" target="_blank">
                                                    +{{ $guardianWhatsapp }}
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                @endif
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
                        <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="char">
                            <div class="pt-4 w-full">
                                <label class="mb-4 font-semibold leading-none text-gray-900 dark:text-white"
                                    for="name">
                                    Preferensi Murid
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
                                <div class="grid grid-cols-3 gap-x-4 gap-y-2">
                                    <div class="mb-5">
                                        <label for="extra_open"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Keramahan | Kreativitas
                                        </label>
                                        <select name="" id="extra_open"
                                            wire:model.defer='preference.extra_open'
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option>Pilih</option>
                                            <option value="1">1 - Sama Penting</option>
                                            <option value="2">2 - Penengah 1-3</option>
                                            <option value="3">3 - Sedikit Lebih Penting</option>
                                            <option value="4">4 - Penengah 3-5</option>
                                            <option value="5">5 - Lebih Penting</option>
                                            <option value="6">6 - Penengah 5-7</option>
                                            <option value="7">7 - Sangat Penting</option>
                                            <option value="8">8 - Penengah 7-9</option>
                                            <option value="9">9 - Mutlak Penting</option>
                                        </select>
                                    </div>
                                    <div class="mb-5">
                                        <label for="extra_agree"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Keramahan | Keterbukaan
                                        </label>
                                        <select name="" id="extra_agree"
                                            wire:model.defer='preference.extra_agree'
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option>Pilih</option>
                                            <option value="1">1 - Sama Penting</option>
                                            <option value="2">2 - Penengah 1-3</option>
                                            <option value="3">3 - Sedikit Lebih Penting</option>
                                            <option value="4">4 - Penengah 3-5</option>
                                            <option value="5">5 - Lebih Penting</option>
                                            <option value="6">6 - Penengah 5-7</option>
                                            <option value="7">7 - Sangat Penting</option>
                                            <option value="8">8 - Penengah 7-9</option>
                                            <option value="9">9 - Mutlak Penting</option>
                                        </select>
                                    </div>
                                    <div class="mb-5">
                                        <label for="extra_conscient"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Keramahan | Terencana
                                        </label>
                                        <select name="" id="extra_conscient"
                                            wire:model.defer='preference.extra_conscient'
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option>Pilih</option>
                                            <option value="1">1 - Sama Penting</option>
                                            <option value="2">2 - Penengah 1-3</option>
                                            <option value="3">3 - Sedikit Lebih Penting</option>
                                            <option value="4">4 - Penengah 3-5</option>
                                            <option value="5">5 - Lebih Penting</option>
                                            <option value="6">6 - Penengah 5-7</option>
                                            <option value="7">7 - Sangat Penting</option>
                                            <option value="8">8 - Penengah 7-9</option>
                                            <option value="9">9 - Mutlak Penting</option>
                                        </select>
                                    </div>
                                    <div class="mb-5">
                                        <label for="extra_duration"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Keramahan | Durasi
                                        </label>
                                        <select name="" id="extra_duration"
                                            wire:model.defer='preference.extra_duration'
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option>Pilih</option>
                                            <option value="1">1 - Sama Penting</option>
                                            <option value="2">2 - Penengah 1-3</option>
                                            <option value="3">3 - Sedikit Lebih Penting</option>
                                            <option value="4">4 - Penengah 3-5</option>
                                            <option value="5">5 - Lebih Penting</option>
                                            <option value="6">6 - Penengah 5-7</option>
                                            <option value="7">7 - Sangat Penting</option>
                                            <option value="8">8 - Penengah 7-9</option>
                                            <option value="9">9 - Mutlak Penting</option>
                                        </select>
                                    </div>
                                    <div class="mb-5">
                                        <label for="extra_TOD"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Keramahan | Waktu
                                        </label>
                                        <select name="" id="extra_TOD" wire:model.defer='preference.extra_TOD'
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option>Pilih</option>
                                            <option value="1">1 - Sama Penting</option>
                                            <option value="2">2 - Penengah 1-3</option>
                                            <option value="3">3 - Sedikit Lebih Penting</option>
                                            <option value="4">4 - Penengah 3-5</option>
                                            <option value="5">5 - Lebih Penting</option>
                                            <option value="6">6 - Penengah 5-7</option>
                                            <option value="7">7 - Sangat Penting</option>
                                            <option value="8">8 - Penengah 7-9</option>
                                            <option value="9">9 - Mutlak Penting</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 gap-x-4 gap-y-2">
                                    <div class="mb-5">
                                        <label for="open_agree"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Kreativitas | Keterbukaan
                                        </label>
                                        <select name="" id="open_agree"
                                            wire:model.defer='preference.open_agree'
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option>Pilih</option>
                                            <option value="1">1 - Sama Penting</option>
                                            <option value="2">2 - Penengah 1-3</option>
                                            <option value="3">3 - Sedikit Lebih Penting</option>
                                            <option value="4">4 - Penengah 3-5</option>
                                            <option value="5">5 - Lebih Penting</option>
                                            <option value="6">6 - Penengah 5-7</option>
                                            <option value="7">7 - Sangat Penting</option>
                                            <option value="8">8 - Penengah 7-9</option>
                                            <option value="9">9 - Mutlak Penting</option>
                                        </select>
                                    </div>
                                    <div class="mb-5">
                                        <label for="open_conscient"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Kreativitas | Terencana
                                        </label>
                                        <select name="" id="open_conscient"
                                            wire:model.defer='preference.open_conscient'
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option>Pilih</option>
                                            <option value="1">1 - Sama Penting</option>
                                            <option value="2">2 - Penengah 1-3</option>
                                            <option value="3">3 - Sedikit Lebih Penting</option>
                                            <option value="4">4 - Penengah 3-5</option>
                                            <option value="5">5 - Lebih Penting</option>
                                            <option value="6">6 - Penengah 5-7</option>
                                            <option value="7">7 - Sangat Penting</option>
                                            <option value="8">8 - Penengah 7-9</option>
                                            <option value="9">9 - Mutlak Penting</option>
                                        </select>
                                    </div>
                                    <div class="mb-5">
                                        <label for="open_duration"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Kreativitas | Durasi
                                        </label>
                                        <select name="" id="open_duration"
                                            wire:model.defer='preference.open_duration'
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option>Pilih</option>
                                            <option value="1">1 - Sama Penting</option>
                                            <option value="2">2 - Penengah 1-3</option>
                                            <option value="3">3 - Sedikit Lebih Penting</option>
                                            <option value="4">4 - Penengah 3-5</option>
                                            <option value="5">5 - Lebih Penting</option>
                                            <option value="6">6 - Penengah 5-7</option>
                                            <option value="7">7 - Sangat Penting</option>
                                            <option value="8">8 - Penengah 7-9</option>
                                            <option value="9">9 - Mutlak Penting</option>
                                        </select>
                                    </div>
                                    <div class="mb-5">
                                        <label for="open_TOD"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Kreativitas | Waktu
                                        </label>
                                        <select name="" id="open_TOD" wire:model.defer='preference.open_TOD'
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option>Pilih</option>
                                            <option value="1">1 - Sama Penting</option>
                                            <option value="2">2 - Penengah 1-3</option>
                                            <option value="3">3 - Sedikit Lebih Penting</option>
                                            <option value="4">4 - Penengah 3-5</option>
                                            <option value="5">5 - Lebih Penting</option>
                                            <option value="6">6 - Penengah 5-7</option>
                                            <option value="7">7 - Sangat Penting</option>
                                            <option value="8">8 - Penengah 7-9</option>
                                            <option value="9">9 - Mutlak Penting</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 gap-x-4 gap-y-2">
                                    <div class="mb-5">
                                        <label for="agree_conscient"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Keterbukaan | Terencana
                                        </label>
                                        <select name="" id="agree_conscient"
                                            wire:model.defer='preference.agree_conscient'
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option>Pilih</option>
                                            <option value="1">1 - Sama Penting</option>
                                            <option value="2">2 - Penengah 1-3</option>
                                            <option value="3">3 - Sedikit Lebih Penting</option>
                                            <option value="4">4 - Penengah 3-5</option>
                                            <option value="5">5 - Lebih Penting</option>
                                            <option value="6">6 - Penengah 5-7</option>
                                            <option value="7">7 - Sangat Penting</option>
                                            <option value="8">8 - Penengah 7-9</option>
                                            <option value="9">9 - Mutlak Penting</option>
                                        </select>
                                    </div>
                                    <div class="mb-5">
                                        <label for="agree_duration"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Keterbukaan | Durasi
                                        </label>
                                        <select name="" id="agree_duration"
                                            wire:model.defer='preference.agree_duration'
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option>Pilih</option>
                                            <option value="1">1 - Sama Penting</option>
                                            <option value="2">2 - Penengah 1-3</option>
                                            <option value="3">3 - Sedikit Lebih Penting</option>
                                            <option value="4">4 - Penengah 3-5</option>
                                            <option value="5">5 - Lebih Penting</option>
                                            <option value="6">6 - Penengah 5-7</option>
                                            <option value="7">7 - Sangat Penting</option>
                                            <option value="8">8 - Penengah 7-9</option>
                                            <option value="9">9 - Mutlak Penting</option>
                                        </select>
                                    </div>
                                    <div class="mb-5">
                                        <label for="agree_TOD"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Keterbukaan | Waktu
                                        </label>
                                        <select name="" id="agree_TOD" wire:model.defer='preference.agree_TOD'
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option>Pilih</option>
                                            <option value="1">1 - Sama Penting</option>
                                            <option value="2">2 - Penengah 1-3</option>
                                            <option value="3">3 - Sedikit Lebih Penting</option>
                                            <option value="4">4 - Penengah 3-5</option>
                                            <option value="5">5 - Lebih Penting</option>
                                            <option value="6">6 - Penengah 5-7</option>
                                            <option value="7">7 - Sangat Penting</option>
                                            <option value="8">8 - Penengah 7-9</option>
                                            <option value="9">9 - Mutlak Penting</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 gap-x-4 gap-y-2">
                                    <div class="mb-5">
                                        <label for="conscient_duration"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Terencana | Durasi
                                        </label>
                                        <select name="" id="conscient_duration"
                                            wire:model.defer='preference.conscient_duration'
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option>Pilih</option>
                                            <option value="1">1 - Sama Penting</option>
                                            <option value="2">2 - Penengah 1-3</option>
                                            <option value="3">3 - Sedikit Lebih Penting</option>
                                            <option value="4">4 - Penengah 3-5</option>
                                            <option value="5">5 - Lebih Penting</option>
                                            <option value="6">6 - Penengah 5-7</option>
                                            <option value="7">7 - Sangat Penting</option>
                                            <option value="8">8 - Penengah 7-9</option>
                                            <option value="9">9 - Mutlak Penting</option>
                                        </select>
                                    </div>
                                    <div class="mb-5">
                                        <label for="conscient_TOD"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Terencana | Waktu
                                        </label>
                                        <select name="" id="conscient_TOD"
                                            wire:model.defer='preference.conscient_TOD'
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option>Pilih</option>
                                            <option value="1">1 - Sama Penting</option>
                                            <option value="2">2 - Penengah 1-3</option>
                                            <option value="3">3 - Sedikit Lebih Penting</option>
                                            <option value="4">4 - Penengah 3-5</option>
                                            <option value="5">5 - Lebih Penting</option>
                                            <option value="6">6 - Penengah 5-7</option>
                                            <option value="7">7 - Sangat Penting</option>
                                            <option value="8">8 - Penengah 7-9</option>
                                            <option value="9">9 - Mutlak Penting</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 gap-x-4 gap-y-2">
                                    <div class="mb-5">
                                        <label for="duration_TOD"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Durasi | Waktu
                                        </label>
                                        <select name="" id="duration_TOD"
                                            wire:model.defer='preference.duration_TOD'
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option>Pilih</option>
                                            <option>Pilih</option>
                                            <option value="1">1 - Sama Penting</option>
                                            <option value="2">2 - Penengah 1-3</option>
                                            <option value="3">3 - Sedikit Lebih Penting</option>
                                            <option value="4">4 - Penengah 3-5</option>
                                            <option value="5">5 - Lebih Penting</option>
                                            <option value="6">6 - Penengah 5-7</option>
                                            <option value="7">7 - Sangat Penting</option>
                                            <option value="8">8 - Penengah 7-9</option>
                                            <option value="9">9 - Mutlak Penting</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full flex gap-x-4 gap-y-4">
                                <div class="mb-5">
                                    <label for="char1"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Neuroticisim
                                    </label>
                                    <input type="text" id="char1" wire:model.defer='char.neuro'
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                                </div>
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
                            <div wire:click='saveChar' wire:loading.remove
                                class="w-1/4 cursor-pointer focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                Simpan
                            </div>
                        </div>
                        <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="recommend">
                            <div class="pt-4 w-full">
                                <label class="mb-4 font-semibold leading-none text-gray-900 dark:text-white"
                                    for="name">
                                    Rekomendasi Tutor untuk murid
                                </label>
                                <div class="flex gap-x-4 w-full">
                                    <table
                                        class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        <thead
                                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            <tr>
                                                <th scope="col" class="px-6 py-3">Urutan</th>
                                                <th scope="col" class="px-6 py-3">Tanggal Rekomendasi</th>
                                                <th scope="col" class="px-6 py-3">Nama Tutor</th>
                                                <th scope="col" class="px-6 py-3">Poin</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $lastDate = '';
                                                $rank = 1;
                                            @endphp
                                            @forelse ($recommendation as $key => $item)
                                                @if ($lastDate != $item->created_at && $lastDate != '')
                                                    <tr
                                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                        <td colspan="4" class="bg-gray-600">&nbsp;</td>
                                                    </tr>
                                                    @php
                                                        $rank = 1;
                                                    @endphp
                                                @endif
                                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                    <td class="px-6 py-4">{{ $rank++ }}</td>
                                                    <td class="px-6 py-4">
                                                        {{ $item->created_at->format('d-m-Y H:i:s') }}</td>
                                                    <td class="px-6 py-4">{{ $item->theTutor->userData->name }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ number_format($item->point, 3, '.', ',') }}</td>
                                                </tr>
                                                @php
                                                    $lastDate = $item->created_at;
                                                @endphp
                                            @empty
                                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                    <td colspan="4">Belum ada rekomendasi</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div wire:click='getRecommendation' wire:loading.remove
                                class="mt-6 w-1/4 cursor-pointer focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                Perbarui Rekomendasi
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



</div>
</x-page.content-white>
</div>
