<div>
    <x-page.header>
        Daftar Billing (Invoice)
    </x-page.header>


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
            {{-- Active billings --}}
            <x-table.billing model='searchActive'>
                <x-slot name="title">
                    Daftar Billing Aktif ({{$active->count()}})
                </x-slot>

                <x-slot name="caption">
                    Per {{date('d F Y H:i T')}}
                </x-slot>

                <x-slot name="head">
                    <x-table.head>
                        Nomor
                    </x-table.head>
                    <x-table.head>
                        Identitas Murid
                    </x-table.head>
                    <x-table.head>
                        Identitas Wali Murid
                    </x-table.head>
                    <x-table.head>
                        Nominal
                    </x-table.head>
                    <x-table.head>
                        Status
                    </x-table.head>
                    <x-table.head>
                        Opsi
                    </x-table.head>
                </x-slot>

                <x-slot name="body">
                    @php
                    // dd($today);
                    @endphp
                    @forelse ($active as $i => $item)
                    <x-table.row-billing-active wire:loading.class.delay.longest='opacity-80' :item='$item'>
                        <x-slot name="sequence">
                            {{$i+1}}
                        </x-slot>
                    </x-table.row-billing-active>
                    @empty
                    <tr>
                        <td colspan="5" class="px-2 py-3 italic">
                            Tidak ada data
                        </td>
                    </tr>
                    @endforelse
                </x-slot>
                <x-slot name="foot">
                    {{$active->links()}}
                </x-slot>
            </x-table.billing>

            {{-- Need Confirmation billings --}}
            <x-table.billing model='searchConfirm'>
                <x-slot name="title">
                    Daftar Tagihan Menunggu Konfirmasi Pembayaran ({{$confirm->count()}})
                </x-slot>

                <x-slot name="caption">
                    Per {{date('d F Y H:i T')}}
                </x-slot>

                <x-slot name="head">
                    <x-table.head>
                        Nomor
                    </x-table.head>
                    <x-table.head>
                        Identitas Murid
                    </x-table.head>
                    <x-table.head>
                        Identitas Wali Murid
                    </x-table.head>
                    <x-table.head>
                        Nominal
                    </x-table.head>
                    <x-table.head>
                        Status
                    </x-table.head>
                    <x-table.head>
                        Opsi
                    </x-table.head>
                </x-slot>

                <x-slot name="body">
                    @php
                    // dd($today);
                    @endphp
                    @forelse ($confirm as $i => $item)
                    <x-table.row-billing-active wire:loading.class.delay.longest='opacity-80' :item='$item'>
                        <x-slot name="sequence">
                            {{$i+1}}
                        </x-slot>
                    </x-table.row-billing-active>
                    @empty
                    <tr>
                        <td colspan="5" class="px-2 py-3 italic">
                            Tidak ada data
                        </td>
                    </tr>
                    @endforelse
                </x-slot>
                <x-slot name="foot">
                    {{$confirm->links()}}
                </x-slot>
            </x-table.billing>
            
            {{-- Past Classes --}}
            <x-table.billing model='searchPaid'>
                <x-slot name="title">
                    Daftar Biling Lunas ({{$paid->count()}})
                </x-slot>

                <x-slot name="caption">
                    Per {{date('d F Y H:i T')}}
                </x-slot>

                <x-slot name="head">
                    <x-table.head>
                        Nomor
                    </x-table.head>
                    <x-table.head>
                        Identitas Murid
                    </x-table.head>
                    <x-table.head>
                        Identitas Wali Murid
                    </x-table.head>
                    <x-table.head>
                        Nominal
                    </x-table.head>
                    <x-table.head>
                        Pembayaran
                    </x-table.head>
                    <x-table.head>
                        Opsi
                    </x-table.head>
                </x-slot>

                <x-slot name="body">
                    @forelse ($paid as $i => $item)
                    @php
                    // dd($item);
                    @endphp
                    <x-table.row-billing-paid wire:loading.class.delay.longest='opacity-80' :item='$item'>
                        <x-slot name="sequence">
                            {{$i+1}}
                        </x-slot>
                    </x-table.row-billing-paid>
                    @empty
                    <tr>
                        <td colspan="5" class="px-2 py-3 italic">
                            Tidak ada data
                        </td>
                    </tr>
                    @endforelse
                </x-slot>
                <x-slot name="foot">
                    {{$paid->links()}}
                </x-slot>
            </x-table.classes-past>
        </div>
    </x-page.content-white>
</div>