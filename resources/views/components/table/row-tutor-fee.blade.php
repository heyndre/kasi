<tr {{ $attributes->merge(['class' => 'bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50
    dark:hover:bg-gray-600', 'style' => '']) }}
    >
    {{-- <td class="w-4 p-4">
        <div class="flex items-center">
            <input id="checkbox-table-search-1" type="checkbox"
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
        </div>
    </td> --}}
    <td class="px-6 py-4">
        {{str_pad($item->payment_number, 5, '0', STR_PAD_LEFT)}}
    </td>
    <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
        <div class="flex items-center">
            @php
            $words = preg_split("/\s+/", $item->theTutor->userData->name);
            $acronym = '';
            $acronymPlus = '';
            foreach ($words as $w) {
            $acronym .= mb_substr($w, 0, 1);
            $acronymPlus .= mb_substr($w, 0, 1).'+';
            }
            // dd($profile_photo);
            @endphp
            @if ($item->theTutor->userData->profile_photo_path == '')
            <img class="h-14 w-14 rounded-full object-cover"
                src="https://ui-avatars.com/api/?name={{substr($acronymPlus, 0, 3)}}&color=7F9CF5&background=EBF4FF"
                alt="{{$acronym}}">
            @else
            <img class="w-14 h-14 rounded-full" src="{{asset($item->theTutor->userData->profile_photo_path)}}"
                alt="{{$acronym}}">
            @endif
            <div class="pl-3 space-y-2">
                <a href="{{route('student.show', ['nim' => $item->theTutor->userData->slug])}}" class="hover:underline">
                    <div class="text-base font-semibold bg-white-100/50 rounded-sm px-2 py-1">
                        {{$item->theTutor->userData->nickname}}
                    </div>
                    <div class="font-thin text-xs text-gray-800 px-2 py-1">
                        {{$item->theTutor->userData->name}}
                    </div>
                </a>
            </div>
        </div>
    </td>
    <td>
        {{$item->due_date->format('F Y')}}
    </td>
    <td>
        Rp.{{number_format($item->total, 0, ',', '.')}}
        <p class="italic">({{Terbilang::make($item->total, ' rupiah')}})</p>
        <p>Tanggal pembayaran: {{$item->pay_date ? $item->pay_date->format('d-m-Y') : 'Belum ada pembayaran'}}</p>
    </td>

    <td>
        @if ($item->pay_date)
        Lunas
        @else
        Menunggu <b>pembayaran</b>

        @endif
    </td>

    <td class="px-6 py-4">
        @if (auth()->user()->isTutor())
        <a href="{{route('tutor.fee.download', ['id' => $item->payment_number])}}"
            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Lihat rincian</a>
            <br>
        @endif
        @if (auth()->user()->isManagement())
        <a href="{{route('admin.tutor.fee.download', ['id' => $item->payment_number])}}"
            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Lihat rincian</a>
            <br>
        @endif
        @if ($item->pay_date)
        <a href="{{route('file.payment.tutor', ['slug' => $item->payment_proof])}}"
            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Lihat bukti</a>
        @else
        @if (auth()->user()->isManagement())
        <a href="{{route('finance.tutor.fee.receipt', ['id' => $item->payment_number])}}"
            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Unggah pembayaran</a>
        @endif
        @endif
    </td>
</tr>