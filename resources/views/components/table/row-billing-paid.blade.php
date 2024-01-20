<tr {{ $attributes->merge(['class' => 'border-b hover:bg-gray-50', 'style' => '']) }}
    >
    {{-- <td class="w-4 p-4">
        <div class="flex items-center">
            <input id="checkbox-table-search-1" type="checkbox"
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
        </div>
    </td> --}}
    <td class="px-6 py-4">
        {{str_pad($item->invoice_id, 5, '0', STR_PAD_LEFT)}}
    </td>
    <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
        <div class="flex items-center">
            @php
            $words = preg_split("/\s+/", $item->theStudent->userData->name);
            $acronym = '';
            $acronymPlus = '';
            foreach ($words as $w) {
            $acronym .= mb_substr($w, 0, 1);
            $acronymPlus .= mb_substr($w, 0, 1).'+';
            }
            // dd($profile_photo);
            @endphp
            @if ($item->theStudent->userData->profile_photo_path == '')
            <img class="h-14 w-14 rounded-full object-cover"
                src="https://ui-avatars.com/api/?name={{substr($acronymPlus, 0, 3)}}&color=7F9CF5&background=EBF4FF"
                alt="{{$acronym}}">
            @else
            <img class="w-14 h-14 rounded-full" src="{{asset($item->theStudent->userData->profile_photo_path)}}"
                alt="{{$acronym}}">
            @endif
            <div class="pl-3 space-y-2">
                <a href="{{route('student.show', ['nim' => $item->theStudent->nim])}}" class="hover:underline">
                    <div class="text-base font-semibold bg-white-100/50 rounded-sm px-2 py-1">
                        {{$item->theStudent->userData->nickname}}
                    </div>
                    <div class="font-thin text-xs text-gray-800 px-2 py-1">
                        {{$item->theStudent->userData->name}}
                    </div>
                </a>
            </div>
        </div>
    </td>
    <td>
        <div class="flex items-center">
            @if ($item->theStudent->theGuardian !== null)
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
            @if ($item->theStudent->theGuardian->userData->profile_photo_path == '')
            <img class="h-14 w-14 rounded-full object-cover"
                src="https://ui-avatars.com/api/?name={{substr($acronymPlus, 0, 3)}}&color=7F9CF5&background=EBF4FF"
                alt="{{$acronym}}">
            @else
            <img class="w-14 h-14 rounded-full"
                src="{{asset($item->theStudent->theGuardian->userData->profile_photo_path)}}" alt="{{$acronym}}">
            @endif
            <div class="pl-3 space-y-2">
                <a href="{{route('guardian.show', ['slug' => $item->theStudent->theGuardian->userData->slug])}}"
                    class="hover:underline">
                    <div class="text-base font-semibold bg-white-100/50 rounded-sm px-2 py-1">
                        {{$item->theStudent->theGuardian->userData->nickname}}
                    </div>
                    <div class="font-thin text-xs text-gray-800 px-2 py-1">
                        {{$item->theStudent->theGuardian->userData->name}}
                    </div>
                </a>
            </div>
            @else
            <p class="italic">N/A</p>
            @endif
        </div>
    </td>
    <td>
        Rp.{{number_format($item->amount, 0, ',', '.')}}
        <p class="italic">({{Terbilang::make($item->amount, ' rupiah')}})</p>
        <p>Tanggal penagihan: {{$item->bill_date->format('d-m-Y')}}</p>
        {{-- <p>Tenggat pembayaran: {{$item->due_date->format('d-m-Y')}}</p> --}}
    </td>

    <td>
        Rp.{{number_format($item->thePayment->sum('amount'), 0, ',', '.')}}
        <p class="italic">({{Terbilang::make($item->thePayment->sum('amount'), ' rupiah')}})</p>
        {{-- <p>Melalui : {{$item->thePayment->pay_method}}</p> --}}
        {{-- <p>Dibayarkan pada: {{$item->thePayment->pay_date->format('d-m-Y H:i T')}}</p> --}}
        {{-- <p>Konfirmasi pada: {{$item->thePayment->confirm_date->format('d-m-Y H:i T')}}</p> --}}
    </td>

    <td class="px-6 py-4">
        @if (auth()->user()->isStudent())
        <a href="{{route('student.billing.status', ['id' => $item->id])}}"
            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Lihat rincian</a>
        @elseif (auth()->user()->isGuardian())
        <a href="{{route('guardian.billing.status', ['id' => $item->id])}}"
            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Lihat rincian</a>
        @else
        <a href="{{route('payment.student.status', ['id' => $item->id])}}"
            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Lihat rincian</a>
        @endif
    </td>
</tr>