<div>
    <x-page.header>
        Daftar Status Billing Kelas KASI
    </x-page.header>


    <x-page.content-white>
        {{-- <div class="p-4 w-fit text-sm">
            <a href="#PastTable" class="px-3 py-2 bg-gray-700 text-white shadow-md rounded-md">Ke Tabel Kelas Yang Lalu</a>
            <a href="#TomorrowTable" class="px-3 py-2 bg-gray-700 text-white shadow-md rounded-md">Ke Tabel Kelas Yang Akan Datang</a>
        </div> --}}
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
            {{-- Today Classes --}}
            <x-table.classes search='true'>
                <x-slot name="title">
                    Daftar Kelas Belum Masuk Billing ({{$unbilled->count()}})
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
                        Nama Murid
                    </x-table.head>
                    <x-table.head>
                        Opsi
                    </x-table.head>
                </x-slot>

                <x-slot name="body">
                    @php
                    // dd($today);
                    @endphp
                    @forelse ($unbilled as $i => $item)
                    <x-table.row-class-today wire:loading.class.delay.longest='opacity-80' :tutor='$item->theTutor'
                        :student='$item->theStudent' :course='$item->theCourse'>
                        <x-slot name="id">
                            {{$item->id}}
                        </x-slot>
                        <x-slot name="time">
                            {{$item->date_of_event->format('d M Y H:i T')}}
                        </x-slot>
                        <x-slot name="topic">
                            {{$item->topic}}
                        </x-slot>
                    </x-table.row-class-today>
                    @empty
                    <tr>
                        <td colspan="5" class="px-2 py-3 italic">
                            Tidak ada data kelas
                        </td>
                    </tr>
                    @endforelse
                </x-slot>
                <x-slot name="foot">
                    {{$unbilled->links()}}
                </x-slot>
            </x-table.classes>

            {{-- Tomorrow Classes --}}
            <x-table.classes-tomorrow>
                <x-slot name="title">
                    Daftar Kelas Sudah Masuk Billing ({{$billed->count()}})
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
                        Nama Murid
                    </x-table.head>
                    <x-table.head>
                        Opsi
                    </x-table.head>
                </x-slot>

                <x-slot name="body">
                    @php
                    // dd($today);
                    @endphp
                    @forelse ($billed as $i => $item)
                    <x-table.row-class-today wire:loading.class.delay.longest='opacity-80' :tutor='$item->theTutor'
                        :student='$item->theStudent' :course='$item->theCourse'>
                        <x-slot name="id">
                            {{$item->id}}
                        </x-slot>
                        <x-slot name="time">
                            {{$item->date_of_event->format('d M Y H:i T')}}
                        </x-slot>
                        <x-slot name="topic">
                            {{$item->topic}}
                        </x-slot>
                    </x-table.row-class-today>
                    @empty
                    <tr>
                        <td colspan="5" class="px-2 py-3 italic">
                            Tidak ada kelas yang akan datang
                        </td>
                    </tr>
                    @endforelse
                </x-slot>
                <x-slot name="foot">
                    {{$billed->links()}}
                </x-slot>
            </x-table.classes-tomorrow>
        </div>
    </x-page.content-white>
</div>