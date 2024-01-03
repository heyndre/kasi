<div>
    <x-page.header>
        Status Billing
    </x-page.header>
    <x-slot name='button'>
        @if (auth()->user()->role == 'ADMIN' || auth()->user()->role == 'SUPERADMIN')
        @php
        // dd($billing->theStudent->theGuardian);
        @endphp
        @if ($billing->thePayment->isEmpty())
        <x-page.edit-button>
            @if (!isset($billing->theStudent->theGuardian))
            Hubungi Murid
            <x-slot name='route'>
                https://wa.me/{{$billing->theStudent->userData->mobile_number}}
            </x-slot>
            @else
            Hubungi Wali Murid
            <x-slot name='route'>
                https://wa.me/{{$billing->theStudent->theGuardian->userData->mobile_number}}
            </x-slot>
            @endif
        </x-page.edit-button>
        @endif
        @endif

        @if (auth()->user()->role == 'MURID' || auth()->user()->role == 'WALI MURID')
        @if ($billing->thePayment->isEmpty() || $diff > 0)
        <x-page.edit-button>
            Unggah Bukti Pembayaran
            <x-slot name='route'>
                {{route('student.billing.upload', ['id' => $billing->id])}}
            </x-slot>
        </x-page.edit-button>
        {{-- @elseif ($billing->thePayment->confirm_date == null)
        <x-page.edit-button target='_blank'>
            Inquiry Konfirmasi Pembayaran
            <x-slot name='route'>
                https://wa.me/6285179824064?text=Inquiry Konfirmasi Pembayaran Invoice nomor
                {{str_pad($billing->invoice_id, 5, '0', STR_PAD_LEFT)}}
            </x-slot>
        </x-page.edit-button> --}}
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
            <x-page.notification />

            <x-page.notification0 />
            <div
                class=" min-h-[100vh] flex flex-col w-full gap-4 p-4 bg-white border border-gray-200 rounded-lg md:flex-row dark:border-gray-700 dark:bg-gray-800">
                <div class="w-1/3 p-6">
                    <div class="text-2xl font-bold">
                        Status Pembayaran Billing
                    </div>

                    <ol class="relative border-s border-gray-200 dark:border-gray-700 mt-6">
                        {{-- @isset($billing->theClass)
                        <x-flowbite.timeline-vertical-item title='Kelas dijadwalkan' :latest='false'
                            :time='$course->created_at' description='' :link="route('kbm.show', ['id' => $course->id])"
                            linkDesc='Detail Kelas'>
                        </x-flowbite.timeline-vertical-item>
                        @endisset

                        @isset($billing->tutor_attendance)
                        <x-flowbite.timeline-vertical-item title='Kelas dilaksanakan' :latest='false'
                            :time='$course->date_of_event' description='' link='haha' linkDesc='Detail Kelas'>
                        </x-flowbite.timeline-vertical-item>
                        @endisset --}}

                        @isset($billing)
                        <x-flowbite.timeline-vertical-item title='Billing dibuat' :latest='false'
                            :time='$billing->created_at'
                            description="Tagihan #{{str_pad($billing->invoice_id, 5, '0', STR_PAD_LEFT)}} <br> Total Rp.{{number_format($billing->amount, 2, ',', '.')}}"
                            link='' linkDesc="">
                        </x-flowbite.timeline-vertical-item>

                        @if (auth()->user()->role == 'ADMIN' || auth()->user()->role == 'SUPERADMIN')
                        <x-flowbite.timeline-vertical-item title=' Billing ditagihkan' :latest='false'
                            :time='$billing->bill_date' description='Klik tombol untuk mengunduh tagihan'
                            target='_blank' link='{{route("billing.download", ["id" => $billing->id])}}'
                            linkDesc='Unduh Tagihan #{{str_pad($billing->invoice_id, 5, "0", STR_PAD_LEFT)}}'>
                        </x-flowbite.timeline-vertical-item>
                        @elseif (auth()->user()->role == 'MURID' || auth()->user()->role == 'WALI MURID')
                        <x-flowbite.timeline-vertical-item title=' Billing ditagihkan' :latest='false'
                            :time='$billing->bill_date' description='Klik tombol untuk mengunduh tagihan'
                            target='_blank' link='{{route("student.billing.download", ["id" => $billing->id])}}'
                            linkDesc='Unduh Tagihan #{{str_pad($billing->invoice_id, 5, "0", STR_PAD_LEFT)}}'>
                        </x-flowbite.timeline-vertical-item>
                        @endif
                        @endisset

                        @isset($billing->thePayment)
                        @foreach ($billing->thePayment as $item)
                        @if (auth()->user()->role == 'ADMIN' || auth()->user()->role == 'SUPERADMIN')
                        <x-flowbite.timeline-vertical-item title='Billing dibayar' :latest='false'
                            :time='$item->pay_date'
                            description="Pembayaran #{{str_pad($item->id, 5, '0', STR_PAD_LEFT)}}, nominal Rp.{{number_format($item->amount, 2, ',', '.')}}"
                            link="{{$item->confirm_date == null ? route('payment.student.confirm', ['id' => $item->id]) : null}}"
                            linkDesc="{{$item->confirm_date == null ? 'Konfirmasi Pembayaran' : null}}">
                        </x-flowbite.timeline-vertical-item>
                        @else
                        <x-flowbite.timeline-vertical-item title='Billing dibayar' :latest='false'
                            :time='$item->pay_date' target='_blank'
                            description="Pembayaran #{{str_pad($item->id, 5, '0', STR_PAD_LEFT)}}, nominal Rp.{{number_format($item->amount, 2, ',', '.')}}"
                            link="{{$item->confirm_date == null ? 'https://wa.me/'.$setting->where('key', 'whatsapp')->value('value').'?text='.$setting->where('key', 'inquiryConfirmPayment')->value('value').str_pad($item->id, 5, '0', STR_PAD_LEFT) : null}}"
                            linkDesc="{{$item->confirm_date == null ? 'Inquiry Konfirmasi Pembayaran' : null}}">
                        </x-flowbite.timeline-vertical-item>
                        @endif

                        @isset($item->confirm_date)
                        <x-flowbite.timeline-vertical-item title='Pembayaran dikonfirmasi' :latest='false'
                            :time='$item->confirm_date'
                            description="Pembayaran #{{str_pad($item->id, 5, '0', STR_PAD_LEFT)}}"
                            link="{{route('file.payment.student', ['nim' => $item->payment_file])}}"
                            linkDesc='Bukti Pembayaran'>>
                        </x-flowbite.timeline-vertical-item>
                        @endisset
                        @endforeach
                        @endisset

                        @isset($billing->theRefund)
                        @foreach ($billing->theRefund as $item)
                        <x-flowbite.timeline-vertical-item title='Pengembalian dana dibuat' :latest='false'
                            :time='$item->created_at' description='' link='#' linkDesc="Pengembalian dana #{{str_pad($item->id, 5, '0', STR_PAD_LEFT)}}">
                        </x-flowbite.timeline-vertical-item>
                        @isset($item->spent_date)
                        <x-flowbite.timeline-vertical-item title='Pengembalian dana dikirim' :latest='false' target='_blank'
                            :time='$item->spent_date' description='' link="{{route('file.payment.refund', ['file' => $item->payment_file])}}" linkDesc="Bukti #{{str_pad($item->id, 5, '0', STR_PAD_LEFT)}}">
                        </x-flowbite.timeline-vertical-item>
                        @endisset
                        @endforeach
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
                                    Informasi Murid/Wali Murid
                            <li class="me-2">
                                <button id="statistics-tab" data-tabs-target="#statistics" type="button" role="tab"
                                    aria-controls="statistics" aria-selected="false"
                                    class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                                    Informasi Pembayaran
                                </button>
                            </li>
                            <li class="me-2">
                                <button id="refund-tab" data-tabs-target="#refund" type="button" role="tab"
                                    aria-controls="refund" aria-selected="false"
                                    class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                                    Informasi Pengembalian Dana
                                    @if($diff < 0) <span
                                        class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                        <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                                        </span>
                                        @endif
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
                                        Data Murid
                                    </label>
                                    <div class="mb-4 font-light sm:mb-5 d">
                                        <div class="flex items-center">
                                            @php
                                            $words = preg_split("/\s+/", $billing->theStudent->userData->name);
                                            $acronym = '';
                                            $acronymPlus = '';
                                            foreach ($words as $w) {
                                            $acronym .= mb_substr($w, 0, 1);
                                            $acronymPlus .= mb_substr($w, 0, 1).'+';
                                            }
                                            // dd($profile_photo);
                                            @endphp
                                            @if ($billing->theStudent->userData->profile_photo_path == '')
                                            <img class="h-14 w-14 rounded-full object-cover"
                                                src="https://ui-avatars.com/api/?name={{substr($acronymPlus, 0, 3)}}&color=7F9CF5&background=EBF4FF"
                                                alt="{{$acronym}}">
                                            @else
                                            <img class="w-14 h-14 rounded-full" src="{{asset($billing->theStudent->userData->profile_photo_path)}}"
                                                alt="{{$acronym}}">
                                            @endif
                                            <div class="pl-3 space-y-2">
                                                <a href="{{route('student.show', ['nim' => $billing->theStudent->nim])}}" class="hover:underline">
                                                    <div class="text-base font-semibold bg-white-100/50 rounded-sm px-2 py-1">
                                                        {{$billing->theStudent->userData->nickname}}
                                                    </div>
                                                    <div class="font-thin text-xs text-gray-900 px-2 py-1">
                                                        {{$billing->theStudent->userData->name}}
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-fit">
                                    <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                        for="name">
                                        Data Wali Murid
                                    </label>
                                    <div class="mb-4 flex items-center font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                        @if ($billing->theStudent->theGuardian !== null)
                                        @php
                                        $words = preg_split("/\s+/", $item->theStudent->theGuardian->userData->name);
                                        $acronym = '';
                                        $acronymPlus = '';
                                        foreach ($words as $w) {
                                        $acronym .= mb_substr($w, 0, 1);
                                        $acronymPlus .= mb_substr($w, 0, 1).'+';
                                        }
                                        // dd($profile_photo);
                                        @endphp
                                        @if ($billing->theStudent->theGuardian->userData->profile_photo_path == '')
                                        <img class="h-14 w-14 rounded-full object-cover"
                                            src="https://ui-avatars.com/api/?name={{substr($acronymPlus, 0, 3)}}&color=7F9CF5&background=EBF4FF"
                                            alt="{{$acronym}}">
                                        @else
                                        <img class="w-14 h-14 rounded-full"
                                            src="{{asset($billing->theStudent->theGuardian->userData->profile_photo_path)}}" alt="{{$acronym}}">
                                        @endif
                                        <div class="pl-3 space-y-2">
                                            <a href="{{route('guardian.show', ['slug' => $billing->theStudent->theGuardian->userData->slug])}}"
                                                class="hover:underline">
                                                <div class="text-base font-semibold bg-white-100/50 rounded-sm px-2 py-1">
                                                    {{$billing->theStudent->theGuardian->userData->nickname}}
                                                </div>
                                                <div class="font-thin text-xs text-gray-800 px-2 py-1">
                                                    {{$billing->theStudent->theGuardian->userData->name}}
                                                </div>
                                            </a>
                                        </div>
                                        @else
                                        <p class="italic">N/A</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hidden bg-white rounded-lg dark:bg-gray-800" id="statistics" role="tabpanel"
                            aria-labelledby="statistics-tab">
                            <x-table.table search='false'>
                                <x-slot name="title">
                                    Daftar pembayaran ({{$billing->thePayment->count()}})
                                </x-slot>

                                <x-slot name="caption">
                                    Per {{date('d F Y H:i T')}}
                                </x-slot>

                                <x-slot name="head">
                                    <x-table.head>
                                        Nomor Pembayaran
                                    </x-table.head>
                                    <x-table.head>
                                        Metode Pembayaran
                                    </x-table.head>
                                    <x-table.head>
                                        Jumlah
                                    </x-table.head>
                                    <x-table.head>
                                        Tanggal Transaksi
                                    </x-table.head>
                                    <x-table.head>
                                        Bukti Pembayaran
                                    </x-table.head>
                                </x-slot>

                                <x-slot name="body">
                                    @php
                                    // dd($billing->thePayment);
                                    @endphp
                                    @forelse ($billing->thePayment as $i => $item)
                                    <x-table.row-billing-payment wire:loading.class.delay.longest='opacity-80'
                                        class='{{$item->confirm_date == null ? "bg-red-100" : "bg-gray-50"}}'
                                        :data='$item'>
                                    </x-table.row-billing-payment>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="px-2 py-3 italic">
                                            Tidak ada data pembayaran
                                        </td>
                                    </tr>
                                    @endforelse
                                </x-slot>
                                <x-slot name="foot">
                                </x-slot>
                            </x-table.table>
                        </div>
                        <div class="hidden bg-white rounded-lg dark:bg-gray-800" id="refund" role="tabpanel"
                            aria-labelledby="refund-tab">
                            <div class="m-7">
                                @if ($diff < 0)
                                    
                                <x-page.button-with-confirm route='#'
                                    confirmMessage='Konfirmasi pembuatan entri pengembalian dana?'
                                    wire:click.prevent='makeRefund'>
                                    Buat Pengembalian Dana
                                </x-page.button-with-confirm>
                                @endif
                            </div>
                            <x-table.classes search='false'>
                                <x-slot name="title">
                                    Daftar pengembalian dana ({{$billing->theRefund->count()}})
                                </x-slot>

                                <x-slot name="caption">
                                    Per {{date('d F Y H:i T')}}
                                </x-slot>

                                <x-slot name="head">
                                    <x-table.head>
                                        Nomor Pembayaran
                                    </x-table.head>
                                    <x-table.head>
                                        Metode Pembayaran
                                    </x-table.head>
                                    <x-table.head>
                                        Jumlah
                                    </x-table.head>
                                    <x-table.head>
                                        Jatuh Tempo
                                    </x-table.head>
                                    <x-table.head>
                                        Bukti Pembayaran
                                    </x-table.head>
                                </x-slot>

                                <x-slot name="body">
                                    @php
                                    // dd($billing->theRefund);
                                    @endphp
                                    @forelse ($billing->theRefund as $i => $item)
                                    <x-table.row-billing-refund wire:loading.class.delay.longest='opacity-80'
                                        class='{{$item->spent_date == null ? "bg-red-100" : "bg-gray-50"}}'
                                        :data='$item'>
                                    </x-table.row-billing-refund>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="px-2 py-3 italic">
                                            Tidak ada data pengembalian dana
                                        </td>
                                    </tr>
                                    @endforelse
                                </x-slot>
                                <x-slot name="foot">
                                </x-slot>
                            </x-table.classes>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-page.content-white>
</div>