<div>
    <x-page.header>
        Status Billing
    </x-page.header>
    <x-slot name='button'>
        @if (auth()->user()->role == 'ADMIN' || auth()->user()->role == 'SUPERADMIN')
        @if ($studentPayment == 'Belum lunas')
        <x-page.edit-button>
            Hubungi Murid/Wali Murid
            <x-slot name='route'>
                {{route('billing.add', ['id' => $course->id])}}
            </x-slot>
        </x-page.edit-button>
        @endif
        @endif

        @if (auth()->user()->role == 'MURID' || auth()->user()->role == 'WALI MURID')
        @if ($studentPayment == null)
        <x-page.edit-button>
            Unggah Bukti Pembayaran
            <x-slot name='route'>
                {{route('student.billing.upload', ['id' => $billing->id])}}
            </x-slot>
        </x-page.edit-button> 
        @endif
        @endif
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
                        Status Pembayaran Billing
                    </div>

                    <ol class="relative border-s border-gray-200 dark:border-gray-700 mt-6">
                        @isset($course)
                        <x-flowbite.timeline-vertical-item title='Kelas dijadwalkan' :latest='false'
                            :time='$course->created_at' description='' :link="route('kbm.show', ['id' => $course->id])"
                            linkDesc='Detail Kelas'>
                        </x-flowbite.timeline-vertical-item>
                        @endisset

                        @isset($course->tutor_attendance)
                        <x-flowbite.timeline-vertical-item title='Kelas dilaksanakan' :latest='false'
                            :time='$course->date_of_event' description='' link='haha' linkDesc='Detail Kelas'>
                        </x-flowbite.timeline-vertical-item>
                        @endisset

                        @isset($billing)
                        <x-flowbite.timeline-vertical-item title='Billing dibuat' :latest='false'
                            :time='$billing->created_at' description='' link='#'
                            linkDesc="# {{str_pad($billing->invoice_id, 5, '0', STR_PAD_LEFT)}}">
                        </x-flowbite.timeline-vertical-item>

                        <x-flowbite.timeline-vertical-item title=' Billing ditagihkan' :latest='false'
                            :time='$billing->bill_date' description='Klik tombol untuk mengunduh tagihan'
                            target='_blank' link='{{route("billing.download", ["id" => $billing->id])}}'
                            linkDesc='Unduh Tagihan'>
                        </x-flowbite.timeline-vertical-item>
                        @endisset

                        @isset($payment)
                        <x-flowbite.timeline-vertical-item title='Billing dibayar' :latest='false'
                            :time='$payment->pay_date' description='' link='haha' linkDesc='Bukti Pembayaran'>
                        </x-flowbite.timeline-vertical-item>

                        @isset($payment->pay_date)
                        <x-flowbite.timeline-vertical-item title='Pembayaran dikonfirmasi' :latest='false'
                            :time='$payment->confirm_date' description='' link='' linkDesc=''>
                        </x-flowbite.timeline-vertical-item>
                        @endisset

                        @endisset

                        @isset($tutorPayment)
                        <x-flowbite.timeline-vertical-item title='Pembayaran diteruskan ke tutor' :latest='false'
                            :time='$tutorPayment->pay_date' description='' link='haha' linkDesc='Bukti Pembayaran'>
                        </x-flowbite.timeline-vertical-item>
                        @endisset
                    </ol>


                </div>
                <div class="flex flex-col  leading-normal w-2/3">
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
                            <div class="px-4 pt-4 w-full">

                            </div>
                            <div class="hidden bg-white rounded-lg dark:bg-gray-800 w-full" id="about" role="tabpanel"
                                aria-labelledby="about-tab" wire:ignore>
                                {{-- Today Classes --}}
                                <x-table.classes search='false'>
                                    <x-slot name="title">
                                        Daftar Kelas di dalam billing ({{$billing->theClass->count()}})
                                    </x-slot>

                                    <x-slot name="caption">
                                        Per {{date('d F Y H:i T')}}
                                    </x-slot>

                                    <x-slot name="head">
                                        <x-table.head>
                                            Waktu
                                        </x-table.head>
                                        <x-table.head>
                                            Mata Pelajaran
                                        </x-table.head>
                                        <x-table.head>
                                            Nama Tutor
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
                                        @forelse ($billing->theClass as $i => $item)
                                        <x-table.row-class-billing wire:loading.class.delay.longest='opacity-80'
                                            :tutor='$item->theTutor' :student='$item->theStudent'
                                            :course='$item->theCourse'>
                                            <x-slot name="id">
                                                {{$item->id}}
                                            </x-slot>
                                            <x-slot name="time">
                                                {{$item->date_of_event->format('d M Y H:i T')}}
                                            </x-slot>
                                            <x-slot name="topic">
                                                {{$item->topic}}
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
    </x-page.content-white>
</div>