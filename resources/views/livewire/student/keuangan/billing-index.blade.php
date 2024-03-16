<div>
    <x-page.header>
        {{__('Billing List (Invoice)')}}
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
                    {{__('Active/Unpaid Invoice')}} ({{$active->total()}})
                </x-slot>

                <x-slot name="caption">
                    {{date('d F Y H:i T')}}
                </x-slot>

                <x-slot name="head">
                    <x-table.head>
                        {{__('#')}}
                    </x-table.head>
                    <x-table.head>
                        {{__('Student Information')}}
                    </x-table.head>
                    <x-table.head>
                        {{__('Guardian Information')}}
                    </x-table.head>
                    <x-table.head>
                        {{__('Amount')}}
                    </x-table.head>
                    <x-table.head>
                        Status
                    </x-table.head>
                    <x-table.head>
                        {{__('Option')}}
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
                            {{__('No Data')}}
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
                    {{__('Waiting for Confirmation by KASI')}} ({{$confirm->total()}})
                </x-slot>

                <x-slot name="caption">
                    {{date('d F Y H:i T')}}
                </x-slot>

                <x-slot name="head">
                    <x-table.head>
                        #
                    </x-table.head>
                    <x-table.head>
                        {{__('Student Information')}}
                    </x-table.head>
                    <x-table.head>
                        {{__('Guardian Information')}}
                    </x-table.head>
                    <x-table.head>
                        {{__('Amount')}}
                    </x-table.head>
                    <x-table.head>
                        Status
                    </x-table.head>
                    <x-table.head>
                        {{__('Option')}}
                    </x-table.head>
                </x-slot>

                <x-slot name="body">
                    @php
                    // dd($today);
                    @endphp
                    @forelse ($confirm as $i => $item)
                    <x-table.row-billing-confirm wire:loading.class.delay.longest='opacity-80' :item='$item'>
                        <x-slot name="sequence">
                            {{$i+1}}
                        </x-slot>
                    </x-table.row-billing-confirm>
                    @empty
                    <tr>
                        <td colspan="5" class="px-2 py-3 italic">
                            {{__('No Data')}}
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
                    {{__('Paid Invoice')}} ({{$paid->total()}})
                </x-slot>

                <x-slot name="caption">
                    {{date('d F Y H:i T')}}
                </x-slot>

                <x-slot name="head">
                    <x-table.head>
                        #
                    </x-table.head>
                    <x-table.head>
                        {{__('Student Information')}}
                    </x-table.head>
                    <x-table.head>
                        {{__('Guardian Information')}}
                    </x-table.head>
                    <x-table.head>
                        {{__('Amount')}}
                    </x-table.head>
                    <x-table.head>
                        {{__('Payment')}}
                    </x-table.head>
                    <x-table.head>
                        {{__('Option')}}
                    </x-table.head>
                </x-slot>

                <x-slot name="body">
                    @forelse ($paid as $i => $item)
                    @php
                    // dd($item);
                    @endphp
                    <x-table.row-billing-paid wire:loading.class.delay.longest='opacity-80' :item='$item' class='{{$item->amount > $item->thePayment->sum("amount") ? "bg-red-100" : "bg-green-100"}}'>
                        <x-slot name="sequence">
                            {{$i+1}}
                        </x-slot>
                    </x-table.row-billing-paid>
                    @empty
                    <tr>
                        <td colspan="5" class="px-2 py-3 italic">
                            {{__('No Data')}}
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