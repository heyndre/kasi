<div>
    <x-page.header>
        Detail Kelas
    </x-page.header>
    <x-slot name='button'>
        @if ($billingStatus == 'Belum ditagih')
        <x-page.edit-button>
            Masukkan ke billing
            <x-slot name='route'>
                {{route('billing.add', ['id' => $course->id])}}
            </x-slot>
        </x-page.edit-button>
        @endif
        
        @if ($billingStatus == 'Ditagih')
        <x-page.edit-button>
            Cek Pembayaran
            <x-slot name='route'>
                {{route('kbm.edit', ['id' => $course->id])}}
            </x-slot>
        </x-page.edit-button>
        @endif

        <x-page.back-button>
            Kembali
            <x-slot name='route'>
                {{route('kbm.index')}}
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
            @if(session()->has('success'))
            <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">INFO</span> {{session('success')}}
                </div>
            </div>
            @endif
            <div
                class=" min-h-[100vh] flex flex-col w-full gap-4 p-4 bg-white border border-gray-200 rounded-lg md:flex-row dark:border-gray-700 dark:bg-gray-800">
                <div class="w-1/3 p-6">
                    <div class="text-2xl font-bold">
                        Data Kelas
                    </div>
                    <div class="grid gap-y-2">
                        <div class="border-b-1">
                            Pelaksanaan Kelas
                            <div class="font-thin">
                                {{$course->date_of_event->format('l d M Y H:i T')}}
                            </div>
                        </div>
                        <hr class="p-3">
                        <div class="border-b-1">
                            Kehadiran Murid
                            <div class="font-thin">
                                @if ($course->student_attendance !== null)
                                {{$course->student_attendance->format('l d M Y H:i T')}}
                                <p class="italic font-thin">
                                    {{$course->student_attendance->diffForHumans($course->date_of_event,
                                    Carbon\CarbonInterface::DIFF_RELATIVE_AUTO, false, 2)}}
                                </p>
                                @else
                                <p class="italic font-thin">
                                    Tidak ada data
                                </p>
                                @endif
                            </div>
                        </div>
                        <div class="border-b-1">
                            Kehadiran Tutor
                            <div class="font-thin">
                                @if ($course->tutor_attendance !== null)
                                {{$course->tutor_attendance->format('l d M Y H:i T')}}
                                <p class="italic font-thin">
                                    {{$course->tutor_attendance->diffForHumans($course->date_of_event,
                                    Carbon\CarbonInterface::DIFF_RELATIVE_AUTO, false, 2)}}
                                </p>
                                @else
                                <p class="italic font-thin">
                                    Tidak ada data
                                </p>
                                @endif
                            </div>
                        </div>
                        <hr class="p-3">
                        <div class="border-b-1">
                            Status Billing
                            <div class="font-thin">
                                <a href="">
                                    {{$billingStatus}}
                                </a>
                            </div>
                        </div>
                        <div class="border-b-1">
                            Status Pembayaran dari Murid
                            <div class="font-thin">
                                <a href="">
                                    {{$studentPayment}}
                                </a>
                            </div>
                        </div>
                        <div class="border-b-1">
                            Status Pembayaran Ke Tutor
                            <div class="font-thin">
                                <a href="">
                                    {{$tutorPayment}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col  leading-normal w-2/3">
                    @if ($course->tutor_attendance !== null && $course->student_attendance !== null)
                    <div
                        class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        Kehadiran Lengkap
                    </div>
                    @elseif ($course->tutor_attendance == null && $course->student_attendance !== null)
                    <div
                        class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        Murid sudah hadir, tutor belum hadir
                    </div>
                    @elseif ($course->tutor_attendance !== null && $course->student_attendance == null)
                    <div
                        class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        Murid belum hadir, tutor sudah hadir
                    </div>
                    @elseif ($course->tutor_attendance == null && $course->student_attendance == null)
                    <div
                        class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        Belum ada kehadiran
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
                                    Informasi Kelas
                                </button>
                            </li>
                            <li class="me-2">
                                <button id="services-tab" data-tabs-target="#services" type="button" role="tab"
                                    aria-controls="services" aria-selected="false"
                                    class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                                    Informasi Murid
                                </button>
                            </li>
                            <li class="me-2">
                                <button id="statistics-tab" data-tabs-target="#statistics" type="button" role="tab"
                                    aria-controls="statistics" aria-selected="false"
                                    class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                                    Informasi Tutor
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
                                            Bidang Pelajaran
                                        </label>
                                        <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                            {{$course->theCourse->name}}
                                        </div>
                                    </div>
                                    <div class="w-fit">
                                        <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                            for="name">
                                            Topik Bahasan
                                        </label>
                                        <a href="mailto:" target="_blank">
                                            <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                                {{$course->topic}}
                                            </div>
                                        </a>
                                    </div>
                                    <div class="w-fit col-span-2">
                                        <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                            for="name">
                                            Materi Pelajaran
                                        </label>
                                        <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                            {!!$course->lesson_matter!!}
                                        </div>
                                    </div>
                                    <div class="w-fit">
                                        <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                            for="name">
                                            Catatan Tutor
                                        </label>
                                        <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                            {{$course->tutor_notes}}
                                        </div>
                                    </div>
                                    <div class="w-fit">
                                        <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                            for="name">
                                            Referensi Tambahan
                                        </label>
                                        <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                            <ul>
                                                @foreach (json_decode($course->additional_links) as $item)
                                                <li>
                                                    <a href="{{$item}}">
                                                        {{$item}}
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="w-fit">
                                        <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                            for="name">
                                            Rekaman Kelas
                                        </label>
                                        <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                            <a href="{{$course->recording}}"></a>
                                        </div>
                                    </div>
                                    <div class="w-fit">
                                        <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                            for="name">
                                            Foto Kelas
                                        </label>
                                        <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                            @if ($course->photo)
                                            <a class="example-image-link" href="{{route('file.class.photo', ['file' => $course->photo])}}"
                                                data-lightbox="foto-pelaksanaan-kelas" data-title="">
                                            <img src="{{route('file.class.photo', ['file' => $course->photo])}}" alt="">
                                            </a>
                                            @else
                                                Tidak ada foto kelas.
                                            @endif
                                        </div>
                                    </div>
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
                                    </div>
                                </div>
                                <div class="w-fit">
                                    <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                        for="name">
                                        Nomor Rekening Tutor
                                    </label>
                                    <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                    </div>
                                </div>
                                <div class="w-fit">
                                    <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                        for="name">
                                        Informasi Tambahan
                                    </label>
                                    <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="statistics"
                            role="tabpanel" aria-labelledby="statistics-tab">
                            <dl
                                class="flex justify-between w-full grid-cols-2 gap-8 p-4 mx-auto text-gray-900 sm:grid-cols-3 xl:grid-cols-6 dark:text-white sm:p-8">
                                <div class="flex flex-col">

                                    <dd class="text-gray-500 dark:text-gray-400">Registrasi sejak</dd>
                                </div>
                                <div class="flex flex-col">

                                    <dd class="text-gray-500 dark:text-gray-400">
                                        Login Terakhir
                                    </dd>
                                </div>
                                <div class="flex flex-col">

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