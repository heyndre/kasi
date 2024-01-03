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
        <a href="{{route('payment.student.confirm.refund', ['id' => $data->id])}}" class="hover:underline">
            {{str_pad($data->id, 5, '0', STR_PAD_LEFT)}}
        </a>
    </td>
    <td class="px-6 py-4">
        {{$data->pay_method}}
    </td>
    <td class="px-6 py-4">
        {{number_format($data->amount, 2, ',', '.')}}
    </td>
    <td class="px-6 py-4 dark:text-white">
        {{$data->due_date->format('d/m/Y H:i:s T')}}
        @isset($data->spent_date)
        <br>
        Lunas dibayar pada {{$data->spent_date->format('d/m/Y H:i:s T')}}
        @endisset
    </td>

    <td class="px-6 py-4">
        @isset($data->payment_file)
        <a href="{{route('file.payment.refund', ['file' => $data->payment_file])}}" target="_blank"
            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Lihat bukti</a>
            @else
        Belum ada pengiriman dana

        @endisset
        {{-- @empty($data->payment_file)
        Belum ada pengiriman dana
        @endempty --}}
    </td>
</tr>