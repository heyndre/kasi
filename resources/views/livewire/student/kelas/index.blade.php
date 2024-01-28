<div>
    <x-page.header>
        {{__('KASI Class Schedule')}}
    </x-page.header>


    <x-page.content-white>
        <div class="p-4 w-fit text-sm">
            <a href="#PastTable" class="px-3 py-2 bg-gray-700 text-white shadow-md rounded-md">
                {{__('Past Classes')}}
            </a>
            <a href="#TomorrowTable" class="px-3 py-2 bg-gray-700 text-white shadow-md rounded-md">
                {{__('Future Classes')}}
            </a>
        </div>
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
                    {{__('Today Schedule')}} ({{$today->count()}})
                </x-slot>

                <x-slot name="caption">
                    Per {{date('d F Y H:i T')}}
                </x-slot>

                <x-slot name="head">
                    <x-table.head>
                        {{__('Time of Event')}}
                    </x-table.head>
                    <x-table.head>
                        {{__('Course')}}
                    </x-table.head>
                    <x-table.head>
                        {{__('Tutor Name')}}
                    </x-table.head>
                    <x-table.head>
                        {{__('Student Name')}}
                    </x-table.head>
                    <x-table.head>
                        {{__('Option')}}
                    </x-table.head>
                </x-slot>

                <x-slot name="body">
                    @php
                    // dd($today);
                    @endphp
                    @forelse ($today as $i => $item)
                    @php
                    $hash = md5(Str::random(25));
                    $r = hexdec(substr($hash, 0, 2)); // r
                    $g = hexdec(substr($hash, 2, 2)); // g
                    $b = hexdec(substr($hash, 4, 2)); //b

                    if ($i == 0) {
                    $color = 'rgba('.$r. ','. $g. ','. $b. ',.1)';
                    } else {
                    if ($today[$i-1]->date_of_event == $item->date_of_event) {
                    $color = $lastColor;
                    } else {
                    while ($lastColor == $color) {
                    $hash = md5(Str::random(25));
                    $r = hexdec(substr($hash, 0, 2)); // r
                    $g = hexdec(substr($hash, 2, 2)); // g
                    $b = hexdec(substr($hash, 4, 2)); //b
                    $color = 'rgba('.$r. ','. $g. ','. $b. ',.1)';
                    }
                    }
                    // dd($color);
                    }
                    $lastColor = $color;
                    @endphp
                    <x-table.row-class-today wire:loading.class.delay.longest='opacity-80' :tutor='$item->theTutor'
                        :student='$item->theStudent' :course='$item->theCourse' :data='$item'
                        style='background-color: {{$color}}'>
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
                            {{__('No Data')}}
                        </td>
                    </tr>
                    @endforelse
                </x-slot>
                <x-slot name="foot">
                </x-slot>
            </x-table.classes>

            {{-- Tomorrow Classes --}}
            <x-table.classes-tomorrow>
                <x-slot name="title">
                    {{__('Future Classes')}} ({{$tomorrow->count()}})
                </x-slot>

                <x-slot name="caption">
                    Per {{date('d F Y H:i T')}}
                </x-slot>

                <x-slot name="head">
                    <x-table.head>
                        {{__('Time of Event')}}
                    </x-table.head>
                    <x-table.head>
                        {{__('Course')}}
                    </x-table.head>
                    <x-table.head>
                        {{__('Tutor Name')}}
                    </x-table.head>
                    <x-table.head>
                        {{__('Student Name')}}
                    </x-table.head>
                    <x-table.head>
                        {{__('Option')}}
                    </x-table.head>
                </x-slot>

                <x-slot name="body">
                    @php
                    // dd($today);
                    @endphp
                    @forelse ($tomorrow as $i => $item)
                    @php
                    $hash = md5(Str::random(25));
                    $r = hexdec(substr($hash, 0, 2)); // r
                    $g = hexdec(substr($hash, 2, 2)); // g
                    $b = hexdec(substr($hash, 4, 2)); //b

                    if ($i == 0) {
                    $color = 'rgba('.$r. ','. $g. ','. $b. ',.1)';
                    } else {
                    if ($tomorrow[$i-1]->date_of_event == $item->date_of_event) {
                    $color = $lastColor;
                    } else {
                    while ($lastColor == $color) {
                    $hash = md5(Str::random(25));
                    $r = hexdec(substr($hash, 0, 2)); // r
                    $g = hexdec(substr($hash, 2, 2)); // g
                    $b = hexdec(substr($hash, 4, 2)); //b
                    $color = 'rgba('.$r. ','. $g. ','. $b. ',.1)';
                    }
                    }
                    // dd($color);
                    }
                    $lastColor = $color;
                    @endphp
                    <x-table.row-class-today wire:loading.class.delay.longest='opacity-80' :tutor='$item->theTutor'
                        :student='$item->theStudent' :course='$item->theCourse' :data='$item'
                        style='background-color: {{$color}}'>
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
                            {{__('No Data')}}
                        </td>
                    </tr>
                    @endforelse
                </x-slot>
                <x-slot name="foot">
                    {{$tomorrow->links()}}
                </x-slot>
            </x-table.classes-tomorrow>

            {{-- Past Classes --}}
            <x-table.classes-past>
                <x-slot name="title">
                    {{__('Past Classes')}} ({{$past->count()}})
                </x-slot>

                <x-slot name="caption">
                    Per {{date('d F Y H:i T')}}
                </x-slot>

                <x-slot name="head">
                    <x-table.head>
                        {{__('Time of Event')}}
                    </x-table.head>
                    <x-table.head>
                        {{__('Course')}}
                    </x-table.head>
                    <x-table.head>
                        {{__('Tutor Name')}}
                    </x-table.head>
                    <x-table.head>
                        {{__('Student Name')}}
                    </x-table.head>
                    <x-table.head>
                        {{__('Option')}}
                    </x-table.head>
                </x-slot>

                <x-slot name="body">
                    @php
                    // dd($past);
                    @endphp
                    @forelse ($past as $i => $item)
                    @php
                    // dd($i);
                    if ($item->status == 'CONDUCTED') {
                    $color = 'rgba(76,200,80,.1)';
                    } else if ($item->status == 'BURNED') {
                    $color = 'rgba(76,0,153,.1)';
                    } else if ($item->status == 'CANCELLED') {
                    $color = 'rgba(153,0,76,.1)';
                    } else {
                    $color = 'rgba(100,200,100,.1)';
                    }
                    @endphp
                    <x-table.row-class-today wire:loading.class.delay.longest='opacity-80' :tutor='$item->theTutor'
                        :student='$item->theStudent' :course='$item->theCourse' :data='$item'
                        style='background-color: {{$color}}'>
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
                            {{__('No Data')}}
                        </td>
                    </tr>
                    @endforelse
                </x-slot>
                <x-slot name="foot">
                    {{$past->links()}}
                </x-slot>
            </x-table.classes-past>
        </div>
    </x-page.content-white>
</div>