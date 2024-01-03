<tr {{ $attributes->merge(['class' => '', 'style' => '']) }}
    >
    {{-- <td class="w-4 p-4">
        <div class="flex items-center">
            <input id="checkbox-table-search-1" type="checkbox"
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
        </div>
    </td> --}}
    <td class="px-6 py-4">
        <a href="{{route('payment.student.confirm', ['id' => $data->id])}}" class="hover:underline">
            {{str_pad($data->id, 5, '0', STR_PAD_LEFT)}}
        </a>
    </td>
    <td class="px-6 py-4">
        {{$data->pay_method}}
    </td>
    <td class="px-6 py-4">
        @if ($data->confirm_date == null)
            Menunggu konfirmasi
        @else
        {{number_format($data->amount, 2, ',', '.')}}
        @endif
    </td>
    <td class="px-6 py-4  whitespace-nowrap dark:text-white">
        @php
            // dd($data);
        @endphp
        {{$data->pay_date->format('d/m/Y H:i:s T')}}

        @isset($data->confirm_date)
        <p>
            Valid {{$data->confirm_date->format('d/m/Y H:i:s T')}}
        </p>
        @endisset

    </td>

    <td class="px-6 py-4">
        <a href="{{route('file.payment.student', ['nim' => $data->payment_file])}}" target="_blank"
            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Lihat bukti</a>
        {{-- @if (auth()->user()->role == 'MURID')
        <a href="{{route('student.billing.status', ['id' => $data->id])}}"
            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Lihat rincian</a>
        @else
        <a href="{{route('payment.student.status', ['id' => $item->id])}}"
            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Lihat rincian</a>
        @endif --}}
    </td>
</tr>