<div>
    <x-page.header>
        Daftar Murid Aktif
    </x-page.header>

    <x-page.content-white>
        <div class="px-4 py-2">
            <x-table.student>
                <x-slot name="title">
                    Daftar Murid Aktif KASI
                </x-slot>

                <x-slot name="caption">
                    Per 3 November 17:35 WIB
                </x-slot>

                <x-slot name="head">
                    <x-table.head>
                        Nama
                    </x-table.head>
                    <x-table.head>
                        NIM
                    </x-table.head>
                    <x-table.head>
                        Wali Murid
                    </x-table.head>
                    <x-table.head>
                        Opsi
                    </x-table.head>
                </x-slot>

                <x-slot name="body">
                    @php
                    // dd($students);
                    @endphp
                    @forelse ($students as $item)
                    <x-table.row-student-active
                        wire:loading.class.delay='opacity-50 transition ease-in-out duration-150'>
                        <x-slot name="nim">
                            {{$item->nim}}
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
                        <x-slot name="guardian">
                            {!!$item->parent_name!!}
                        </x-slot>
                        <x-slot name="guardian_status">
                            {{$item->has_guardian}}
                        </x-slot>
                        <x-slot name="guardian_contact">
                            {{$item->guardian_contact}}
                        </x-slot>
                        <x-slot name="profile_photo">
                            {!!$item->userData->profile_photo_path!!}
                        </x-slot>
                        </x-table.row>
                        @empty
                        <x-table.row-student-active
                            wire:loading.class.delay='opacity-50 transition ease-in-out duration-150'>
                            <x-slot name="nim">
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
                            <x-slot name="guardian">
                                N/A
                            </x-slot>
                            <x-slot name="guardian_status">
                                N/A
                            </x-slot>
                            <x-slot name="guardian_contact">
                                N/A
                            </x-slot>
                            <x-slot name="profile_photo">
                            </x-slot>
                            </x-table.row>
                            @endforelse
                </x-slot>
                <x-slot name="foot">
                    {{$students->links()}}
                </x-slot>
            </x-table.student>

        </div>
    </x-page.content-white>
</div>