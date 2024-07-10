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
    @php
        $avg_technical = ( $course->audio_video + $course->punctual + $course->greeting + $course->documentation + $course->pre_info + $course->post_info ) / 6;
        $avg_teaching = ( $course->course_data + $course->explanation + $course->guidance + $course->friendliness + $course->exercise + $course->questions + $course->recap) / 7;
    @endphp
    <td class="px-6 py-4">
        {{$time}}
    </td>
    <td class="px-6 py-4 dark:text-white">
        {{ number_format($avg_technical, 1, ',', '.')}}
    </td>
    
    <td class="px-6 py-4 dark:text-white">
        {{ number_format($avg_teaching, 1, ',', '.')}}
    </td>

    <td class="px-6 py-4 dark:text-white">
        {{ number_format(($avg_teaching + $avg_technical) / 2, 1, ',', '.')}}
    </td>

    <td class="px-6 py-4">
        @if (auth()->user()->role == 'ADMIN' || auth()->user()->role == 'SUPERADMIN')
        <a href="{{route('kbm.show', ['id' => $courseId])}}"
            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Lihat rincian</a>
        @elseif (auth()->user()->role == 'MURID' || auth()->user()->role == 'WALI MURID')
        <a href="{{route('student.classes.show', ['id' => $courseId])}}"
            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Lihat rincian</a>
        @elseif (auth()->user()->role == 'TUTOR')
        <a href="{{route('student.classes.show', ['id' => $courseId])}}"
            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Lihat rincian</a>
        @endif
    </td>
</tr>