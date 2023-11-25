<div>
    <x-page.header>
        Detail Murid - {{$nim}}
    </x-page.header>
    <x-slot name='button'>
        <x-page.edit-button>
            Ubah
            <x-slot name='route'>
                {{route('student.edit', ['nim' => $nim])}}
            </x-slot>
        </x-page.edit-button>
        <x-page.back-button>
            Kembali
            <x-slot name='route'>
                {{route('student.active')}}
            </x-slot>
        </x-page.back-button>
    </x-slot>

    <x-page.style>
        <style>
            label {
                font-weight: 600 !important;
            }

            .no-resize {
                resize: none !important;
            }
        </style>

    </x-page.style>

    <x-page.content-white>
        <div class="px-4 py-2">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1 flex justify-between">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium text-gray-900">Informasi Murid</h3>

                        <p class="mt-1 text-sm text-gray-600">
                            Registrasi sejak {{$registeredAt->format('d-m-Y H:i:s T')}}
                        </p>

                        <p class="mt-1 text-sm text-gray-600">
                            Login terakhir pada {{$lastLoginAt->format('d-m-Y H:i:s T')}}
                            <br>
                            <span class="italic">({{$lastLoginAt->diffForHumans()}})</span>
                        </p>

                        <p class="mt-1 text-sm text-gray-600">
                            Aktivitas terakhir pada {{$lastActiveAt->format('d-m-Y H:i:s T')}}
                            <br>
                            <span class="italic">({{$lastActiveAt->diffForHumans()}})</span>
                        </p>

                        <!-- Profile Photo -->
                        <!--[if BLOCK]><![endif]-->
                        <div x-data="{photoName: null, photoPreview: null}">
                            <!-- Profile Photo File Input -->
                            {{-- <input type="file" id="photo" class="hidden" wire:model.live="photo" x-ref="photo"
                                x-on:change="
                                                photoName = $refs.photo.files[0].name;
                                                const reader = new FileReader();
                                                reader.onload = (e) => {
                                                    photoPreview = e.target.result;
                                                };
                                                reader.readAsDataURL($refs.photo.files[0]);
                                        "> --}}

                            <label class="block font-medium text-sm text-gray-700" for="photo">
                                {{-- Photo --}}
                            </label>
                            <!-- Current Profile Photo -->
                            @php
                            $words = preg_split("/\s+/", $name);
                            $acronym = '';
                            $acronymPlus = '';
                            foreach ($words as $w) {
                            $acronym .= mb_substr($w, 0, 1);
                            $acronymPlus .= mb_substr($w, 0, 1).'+';
                            }
                            // dd($profile_photo);
                            @endphp

                            <div class="mt-2" x-show="! photoPreview">
                                @if ($photo == '')
                                <img class="h-20 w-20 rounded-full object-cover"
                                    src="https://ui-avatars.com/api/?name={{$acronymPlus}}&color=7F9CF5&background=EBF4FF"
                                    alt="{{$acronym}}">
                                @else
                                <img class="w-25 h-25 rounded-full" src="{{asset($photo)}}" alt="{{$acronym}}">
                                @endif
                            </div>

                            <!-- New Profile Photo Preview -->
                            {{-- <div class="mt-2" x-show="photoPreview" style="display: none;">
                                <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                                    x-bind:style="'background-image: url(\'' + photoPreview + '\');'"
                                    style="background-image: url('null');">
                                </span>
                            </div>

                            <button type="button"
                                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 mt-2 me-2"
                                x-on:click.prevent="$refs.photo.click()">
                                Select A New Photo
                            </button> --}}

                            <!--[if BLOCK]><![endif]-->
                            <!--[if ENDBLOCK]><![endif]-->

                            <!--[if BLOCK]><![endif]-->
                            <!--[if ENDBLOCK]><![endif]-->
                        </div>
                        <!--[if ENDBLOCK]><![endif]-->
                    </div>

                    <div class="px-4 sm:px-0">

                    </div>
                </div>

                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="px-4 py-5 bg-white ">
                        <div class="grid grid-rows-4 grid-flow-col gap-4">
                            <div>
                                <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white" for="name">
                                    Nama Murid
                                </label>
                                <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                    {{$name}}
                                </div>
                            </div>
                            <div>
                                <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white" for="name">
                                    Nomor Telepon/WhatsApp Murid
                                </label>
                                <a href="https://wa.me/{{$whatsapp}}" target="_blank">
                                    <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                        +{{$whatsapp}}
                                    </div>
                                </a>
                            </div>
                            <div>
                                <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white" for="name">
                                    Tanggal Ulang Tahun Murid
                                </label>
                                <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                    {{$birthday->format('d F Y')}}
                                </div>
                            </div>
                            <div>
                                <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white" for="name">
                                    Alamat Murid
                                </label>
                                <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                    {{$address}}
                                </div>
                            </div>
                            <div>
                                <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white" for="name">
                                    Status Wali Murid
                                </label>
                                <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                    {{$hasGuardian != null && $hasGuardian != '' && $hasGuardian == 1 ? 'Punya Wali
                                    Murid' : 'Tidak Punya Wali Murid'}}
                                </div>
                            </div>
                            <div>
                                <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white" for="name">
                                    Nama Wali Murid
                                </label>
                                <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                    {{$guardianName != null && $guardianName != '' ? $guardianName : '-'}}
                                </div>
                            </div>
                            <div>
                                <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white" for="name">
                                    Nomor Telepon/WhatsApp Wali Murid
                                </label>
                                <a href="https://wa.me/{{$guardianWhatsapp}}" target="_blank">
                                    <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                        @if ($guardianWhatsapp != null && $guardianWhatsapp !== '')
                                        +{{$guardianWhatsapp}}
                                        @else
                                        -
                                        @endif
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-page.content-white>
</div>