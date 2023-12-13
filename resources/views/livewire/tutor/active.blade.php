<div>
    <x-page.header>
        Daftar Tutor Aktif
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
            <x-table.tutor>
                <x-slot name="title">
                    Daftar Tutor Aktif KASI ({{$tutors->count()}})
                </x-slot>

                <x-slot name="caption">
                    Per {{date('d F Y H:i T')}} 
                </x-slot>

                <x-slot name="head">
                    <x-table.head>
                        Nama
                    </x-table.head>
                    <x-table.head>
                        Bergabung Sejak
                    </x-table.head>
                    <x-table.head>
                        Domisili
                    </x-table.head>
                    <x-table.head>
                        Opsi
                    </x-table.head>
                </x-slot>

                <x-slot name="body">
                    @php
                    // dd($tutors);
                    @endphp
                    @forelse ($tutors as $item)
                    <x-table.row-tutor-active wire:loading.class.delay.longest='opacity-80'>
                        <x-slot name="slug">
                            {{$item->slug}}
                        </x-slot>
                        <x-slot name="name">
                            {{$item->userData->name}}
                        </x-slot>
                        <x-slot name="email">
                            {{$item->userData->email}}
                        </x-slot>
                        <x-slot name="tel">
                            {{$item->userData->mobile_number}}
                        </x-slot>
                        <x-slot name="id">
                            {{$item->userData->id}}
                        </x-slot>
                        <x-slot name="profile_photo">
                            {!!$item->userData->profile_photo_path!!}
                        </x-slot>
                        </x-table.row>
                        @empty
                        <x-table.row-tutor-active
                            wire:loading.class.delay='opacity-50 transition ease-in-out duration-150'>
                            <x-slot name="slug">
                                N/A
                            </x-slot>
                            <x-slot name="name">
                                N/A
                            </x-slot>
                            <x-slot name="email">
                                N/A
                            </x-slot>
                            <x-slot name="tel">
                                N/A
                            </x-slot>
                            <x-slot name="id">
                                N/A
                            </x-slot>
                            <x-slot name="profile_photo">
                            </x-slot>
                            </x-table.row>
                            @endforelse
                </x-slot>
                <x-slot name="foot">
                    {{$tutors->links()}}
                </x-slot>
            </x-table.student>

        </div>
    </x-page.content-white>
</div>