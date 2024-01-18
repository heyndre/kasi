<tr {{ $attributes->merge(['class' => 'bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50
    dark:hover:bg-gray-600']) }}
    >
    {{-- <td class="w-4 p-4">
        <div class="flex items-center">
            <input id="checkbox-table-search-1" type="checkbox"
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
        </div>
    </td> --}}
    <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
        @php
        $words = preg_split("/\s+/", $data->userData->name);
        $acronym = '';
        $acronymPlus = '';
        foreach ($words as $w) {
        $acronym .= mb_substr($w, 0, 1);
        $acronymPlus .= mb_substr($w, 0, 1).'+';
        }
        // dd($profile_photo);
        @endphp
        @if ($data->userData->profile_photo_path == '' || $data->userData->profile_photo_path == null)
        <img class="h-14 w-14 rounded-full object-cover"
            src="https://ui-avatars.com/api/?name={{substr($acronymPlus, 0, 3)}}&color=7F9CF5&background=EBF4FF"
            alt="{{$acronym}}">
        @else
        <img class="w-14 h-14 rounded-full" src="{{asset($data->userData->profile_photo_path)}}" alt="{{$acronym}}">
        @endif
        <div class="pl-3 space-y-2">
            <a href="{{route('student.show', ['nim' => $data->nim])}}"
                class="text-base font-semibold bg-sky-100/50 hover:underline rounded-sm px-2 py-1">
                {{$data->userData->name}}
            </a>
            <div class="font-normal underline px-2 py-1">
                @if ($data->userData->email)
                <a href="mailto:{{$data->userData->email}}" class="text-gray-700 hover:text-gray-500" target="_blank"
                    rel="noopener noreferrer">
                    {{$data->userData->email}}
                </a>
                <br>
                @endif
                <a href="https://wa.me/{{$data->userData->mobile_number}}" class="text-green-700 hover:text-green-500"
                    target="_blank" rel="noopener noreferrer">
                    WhatsApp : {{$data->userData->mobile_number}}
                </a>
            </div>
        </div>
    </th>
    <td class="px-6 py-4">
        {{$data->nim}}
    </td>
    <td class="px-6 py-4">
        @if ($data->has_guardian == '1')
        <div class="flex items-center">
            <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div>
            {{$data->theGuardian->userData->name}}

        </div>
        <a href="https://wa.me/{{$data->theGuardian->userData->mobile_number}}"
            class="text-green-700 underline hover:text-green-600" target="_blank">
            WhatsApp : {{$data->theGuardian->userData->mobile_number}}
        </a>
        {{-- <br>
        <a href="tel:{{$guardian_contact}}" class="text-sky-700 underline hover:text-sky-600" target="_blank">
            Telepon {{$guardian_contact}}
        </a> --}}
        @else
        <div class="h-2.5 w-2.5 rounded-full bg-orange-500 mr-2"></div>
        N/A
        @endif
    </td>
    <td class="px-6 py-4">
        @if (auth()->user()->isManagement())
        <a href="{{route('student.show', ['nim' => $data->nim])}}"
            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Detail murid</a>

        @elseif (auth()->user()->isTutor())
        <a href="{{route('tutor.student.show', ['nim' => $data->nim])}}"
            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Detail murid</a>

        @endif
    </td>
</tr>