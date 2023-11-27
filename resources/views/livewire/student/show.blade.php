<div>
    <x-page.header>
        Detail Murid - {{$nim}}
    </x-page.header>
    <x-slot name='button'>
        <x-page.edit-button>
            Ubah
            <x-slot name='route'>
                {{route('student.edit', ['nim' => $nim])}}
            </x-slot>
        </x-page.edit-button>
        <x-page.back-button>
            Kembali
            <x-slot name='route'>
                {{route('student.active')}}
            </x-slot>
        </x-page.back-button>
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

            <div
                class="flex flex-col w-full items-center gap-4 p-4 bg-white border border-gray-200 rounded-lg md:flex-row dark:border-gray-700 dark:bg-gray-800">
                <img class="object-cover w-full rounded-t-2xl h-96 md:h-auto md:w-48"
                    src="{{$photoUrl}}" alt="">
                <div class="flex flex-col justify-between leading-normal w-full">
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
                        </ul>
                        <div id="defaultTabContent">
                            <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="about"
                                role="tabpanel" aria-labelledby="about-tab">
                                <div class="grid grid-col-3 grid-flow-auto gap-4">
                                    <div>
                                        <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                            for="name">
                                            Nama Murid
                                        </label>
                                        <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                            {{$name}}
                                        </div>
                                    </div>
                                    <div>
                                        <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                            for="name">
                                            Nomor Telepon/WhatsApp Murid
                                        </label>
                                        <a href="https://wa.me/{{$whatsapp}}" target="_blank">
                                            <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                                +{{$whatsapp}}
                                            </div>
                                        </a>
                                    </div>
                                    <div>
                                        <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                            for="name">
                                            Tanggal Ulang Tahun Murid
                                        </label>
                                        <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                            {{$birthday->format('d F Y')}}
                                        </div>
                                    </div>
                                    <div>
                                        <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                            for="name">
                                            Alamat Murid
                                        </label>
                                        <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                            {{$address}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="services"
                                role="tabpanel" aria-labelledby="services-tab">
                                <div class="grid grid-col-3 grid-flow-auto gap-4">
                                    <div>
                                        <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                            for="name">
                                            Status Wali Murid
                                        </label>
                                        <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                            {{$hasGuardian != null && $hasGuardian != '' && $hasGuardian == 1 ? 'Punya
                                            Wali
                                            Murid' : 'Tidak Punya Wali Murid'}}
                                        </div>
                                    </div>
                                    <div>
                                        <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                            for="name">
                                            Nama Wali Murid
                                        </label>
                                        <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                            {{$guardianName != null && $guardianName != '' ? $guardianName : '-'}}
                                        </div>
                                    </div>
                                    <div>
                                        <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                            for="name">
                                            Nomor Telepon/WhatsApp Wali Murid
                                        </label>
                                        <a href="https://wa.me/{{$guardianWhatsapp}}" target="_blank">
                                            <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                                @if ($guardianWhatsapp != null && $guardianWhatsapp !== '')
                                                +{{$guardianWhatsapp}}
                                                @else
                                                -
                                                @endif
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="statistics"
                                role="tabpanel" aria-labelledby="statistics-tab">
                                <dl
                                    class="flex justify-between w-full grid-cols-2 gap-8 p-4 mx-auto text-gray-900 sm:grid-cols-3 xl:grid-cols-6 dark:text-white sm:p-8">
                                    <div class="flex flex-col">
                                        <dt class="mb-2 text-3xl font-extrabold">{{$registeredAt->format('d-m-Y H:i:s
                                            T')}}</dt>
                                        <dd class="text-gray-500 dark:text-gray-400">Registrasi sejak</dd>
                                    </div>
                                    <div class="flex flex-col">
                                        <dt class="mb-2 text-3xl font-extrabold">{{$lastLoginAt->format('d-m-Y H:i:s
                                            T')}}</dt>
                                        <dd class="text-gray-500 dark:text-gray-400">
                                            Login Terakhir
                                        </dd>
                                    </div>
                                    <div class="flex flex-col">
                                        <dt class="mb-2 text-3xl font-extrabold">{{$lastActiveAt->format('d-m-Y H:i:s
                                            T')}}</dt>
                                        <dd class="text-gray-500 dark:text-gray-400">Aktivitas Terakhir</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </x-page.content-white>
</div>