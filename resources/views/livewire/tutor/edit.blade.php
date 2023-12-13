<div>
    <x-page.header>
        Ubah Detail Tutor - {{$name}}
    </x-page.header>
    <x-slot name='button'>
        <x-page.back-button>
            Kembali
            <x-slot name='route'>
                {{route('tutor.show', ['slug' => $slug])}}
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
            <form wire:submit="update" class="grid grid-cols-2 gap-4">
                <!-- Profile Photo -->
                <div x-data="{photoName: null, photoPrview: null}" class="">
                    <!-- Profile Photo File Input -->
                    <input type="file" id="photo" class="hidden" wire:model.live="photo" x-ref="photo" x-on:change="
                                                photoName = $refs.photo.files[0].name;
                                                const reader = new FileReader();
                                                reader.onload = (e) => {
                                                    photoPreview = e.target.result;
                                                };
                                                reader.readAsDataURL($refs.photo.files[0]);
                                        ">

                    <label class="block font-medium text-sm text-gray-700" for="photo">
                        Photo
                    </label>

                    <!-- Current Profile Photo -->
                    @php
                    // dd($user);
                    $words = preg_split("/\s+/", $user->userData->name);
                    $acronym = '';
                    $acronymPlus = '';
                    foreach ($words as $w) {
                    $acronym .= mb_substr($w, 0, 1);
                    $acronymPlus .= mb_substr($w, 0, 1).'+';
                    }
                    // dd($profile_photo);
                    @endphp
                    @if ($user->userData->profile_photo_path == '')
                    <img class="h-14 w-14 rounded-full object-cover"
                        src="https://ui-avatars.com/api/?name={{$acronymPlus}}&color=7F9CF5&background=EBF4FF"
                        alt="{{$acronym}}">
                    @else
                    <img class="w-14 h-14 rounded-full" src="{{asset($user->userData->profile_photo_path)}}"
                        alt="{{$acronym}}">
                    @endif
                    {{-- <div class="mt-2" x-show="! photoPreview">
                        <img src="{{ $this->user->profile_photo_path }}" alt="{{ $this->user->name }}"
                            alt="{{$user->name}}" class="rounded-full h-20 w-20 object-cover">
                    </div> --}}

                    <!-- New Profile Photo Preview -->
                    <div class="mt-2" x-show="photoPreview" style="display: none;">
                        <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                            x-bind:style="'background-image: url(\'' + photoPreview + '\');'"
                            style="background-image: url('null');">
                        </span>
                    </div>

                    <button type="button"
                        class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 mt-2 me-2"
                        x-on:click.prevent="$refs.photo.click()">
                        Select A New Photo
                    </button>
                </div>

                {{-- Email --}}
                <div class="mb-6">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Email tutor
                        @error('email')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{$message}}</p>
                        @enderror
                    </label>
                    <input type="email" id="email" wire:model.live.debounce.500ms='email'
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="Masukkan email tutor untuk login">
                </div>
                {{-- WhatsApp --}}
                <div class="mb-6">
                    <label for="whatsapp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Nomor WhatsApp Tutor
                        @error('whatsapp')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{$message}}</p>
                        @enderror
                    </label>
                    <input type="tel" id="whatsapp" name="whatsapp" wire:model.live.debounce.500ms='whatsapp'
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="Masukkan nomor whatsapp tutor">
                </div>
                {{-- Name --}}
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Nama Tutor
                        @error('name')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{$message}}</p>
                        @enderror
                    </label>
                    <input type="text" id="name" name="name" wire:model.live.debounce.500ms='name'
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="Masukkan nama tutor">
                </div>

                <div class="mb-6 col-span-2 grid grid-cols-3 gap-4">
                    {{-- Address --}}
                    <div class="mb-6">
                        <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Alamat Tutor
                        </label>
                        <textarea id="address" rows="4" name="address" wire:model.live.debounce.500ms='address'
                            class="no-resize block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Masukkan alamat tutor"></textarea>
                        @error('address')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{$message}}</p>
                        @enderror
                    </div>
                    {{-- Birthday --}}
                    <div class="mb-6">
                        <label for="birthday" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Ulang Tahun Tutor
                            @error('birthday')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                    class="font-medium">Oops!</span>
                                {{$message}}</p>
                            @enderror
                        </label>
                        <div class="relative max-w-sm">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                {{-- <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg> --}}
                            </div>
                            <input datepicker datepicker-format="yyyy-mm-dd" type="text" name="birthday"
                                wire:model.live='birthday'
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Pilih tanggal ulang tahun tutor" id="birthday" onblur="callme(this);">
                        </div>
                    </div>
                    {{-- Religion --}}
                    <div class="mb-6">
                        <label for="religion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Agama Tutor
                            @error('religion')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                    class="font-medium">Oops!</span>
                                {{$message}}</p>
                            @enderror
                        </label>
                        <input type="text" id="religion" name="religion" wire:model.live.debounce.500ms='religion'
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                            placeholder="Masukkan agama tutor">
                    </div>
                </div>

                {{-- Hobi, Motto, Passion --}}
                <div class="mb-6 col-span-2 grid grid-cols-3 gap-4">
                    <div class="">
                        <label for="hobbies" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Hobi Tutor
                            @error('hobbies')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                    class="font-medium">Oops!</span>
                                {{$message}}</p>
                            @enderror
                        </label>
                        <input type="text" id="hobbies" name="hobbies" wire:model.live.debounce.500ms='hobbies'
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                            placeholder="Masukkan hobi tutor, gunakan tanda koma untuk memasukkan banyak hobi">
                    </div>

                    <div class="">
                        <label for="passion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            <i>Passion</i> Tutor
                            @error('passion')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                    class="font-medium">Oops!</span>
                                {{$message}}</p>
                            @enderror
                        </label>
                        <input type="text" id="passion" name="passion" wire:model.live.debounce.500ms='passion'
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                            placeholder="Masukkan passion tutor, gunakan tanda koma untuk memasukkan banyak passion">
                    </div>

                    <div class="">
                        <label for="motto" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            <i>Motto</i> Tutor
                            @error('motto')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                    class="font-medium">Oops!</span>
                                {{$message}}</p>
                            @enderror
                        </label>
                        <input type="text" id="motto" name="motto" wire:model.live.debounce.500ms='motto'
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                            placeholder="Masukkan motto tutor">
                    </div>

                </div>

                <hr class="col-span-2">
                {{-- Teaching Exp --}}
                <div class="mb-6 col-span-2">
                    <label for="teaching_exp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Pengalaman Mengajar Tutor
                        @error('teachingExp')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{$message}}</p>
                        @enderror
                    </label>
                    <x-page.mce>
                        <x-slot name="name">
                            teachingExp
                        </x-slot>
                    </x-page.mce>
                </div>

                {{-- Leadership Exp --}}
                <div class="mb-6 col-span-2">
                    <label for="leadership_exp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Pengalaman Kepemimpinan Tutor
                        @error('leadershipExp')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{$message}}</p>
                        @enderror
                    </label>
                    <x-page.mce>
                        <x-slot name="name">
                            leadershipExp
                        </x-slot>
                    </x-page.mce>
                </div>

                {{-- Competition Exp --}}
                <div class="mb-6 col-span-2">
                    <label for="competition_exp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Pengalaman Kompetisi Tutor
                        @error('competition_exp')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{$message}}</p>
                        @enderror
                    </label>
                    <x-page.mce>
                        <x-slot name="name">
                            competitionExp
                        </x-slot>
                    </x-page.mce>
                </div>

                <hr class="col-span-2">

                {{-- Bank --}}
                <div class="row-span-2">
                    <div class="mb-6">
                        <label for="bank_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Nama Bank Tutor
                            @error('bankName')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                    class="font-medium">Oops!</span>
                                {{$message}}</p>
                            @enderror
                        </label>
                        <input type="text" id="bank_name" name="bankName" wire:model.live.debounce.500ms='bankName'
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                            placeholder="Masukkan nama bank tutor">
                    </div>

                    <div class="mb-6">
                        <label for="bank_account" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Nomor Rekening Tutor
                            @error('bankAccount')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                    class="font-medium">Oops!</span>
                                {{$message}}</p>
                            @enderror
                        </label>
                        <input type="text" id="bank_account" name="bankNumber"
                            wire:model.live.debounce.500ms='bankNumber'
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                            placeholder="Masukkan nomor rekening tutor">
                    </div>
                </div>

                <div class="mb-6 row-span-2">
                    <label for="bank_info" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Info Tambahan Mengenai Data Bank Tutor
                    </label>
                    <textarea id="bank_info" rows="4" name="bankAdditionalInfo"
                        wire:model.live.debounce.500ms='bankAdditionalInfo'
                        class="no-resize block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Masukkan data tambahan jika tersedia"></textarea>
                    @error('bankAdditionalInfo')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                        {{$message}}</p>
                    @enderror
                </div>

                <hr class="col-span-2">
                {{-- Study and Work Status --}}
                <div class="mb-6">
                    <label for="eduStatus" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Status Studi
                        @error('eduStatus')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{$message}}</p>
                        @enderror
                    </label>
                    <select wire:model.live='eduStatus' id="eduStatus"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="educating">Sedang Menempuh Studi</option>
                        <option value="finished">Sudah Menyelesaikan Studi</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label for="eduLevel" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Jenjang pendidikan yang sedang/terakhir ditempuh
                        @error('eduLevel')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{$message}}</p>
                        @enderror
                    </label>
                    <select wire:model.live='eduLevel' id="eduLevel"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" disabled>Pilih jenjang pendidikan</option>
                        <option value="sma">Sekolah Menengah Atas/Ekuivalen</option>
                        <option value="smk">Sekolah Menengah Kejuruan/Ekuivalen</option>
                        <option value="s1">Studi S1</option>
                        <option value="s2">Studi S2</option>
                        <option value="s3">Studi S3</option>
                    </select>
                </div>
                <div class="mb-6">
                    <label for="eduSite" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Tempat Studi
                    </label>
                    <input type="text" id="eduSite" wire:model.live.debounce.500ms='eduSite'
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="Masukkan tempat studi">
                    @error('eduSite')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                        {{$message}}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="eduMajor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Jurusan Studi
                    </label>
                    <input type="text" id="eduMajor" wire:model.live.debounce.500ms='eduMajor'
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="Masukkan jurusan studi">
                    @error('eduMajor')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                        {{$message}}</p>
                    @enderror
                </div>
                {{-- <div class=""></div> --}}


                <div class="mb-6">
                    <label for="workTitle" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Status Pekerjaan
                        @error('workTitle')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{$message}}</p>
                        @enderror
                    </label>
                    <select wire:model.live='workTitle' id="workTitle"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" disabled>Pilih pekerjaan</option>
                        <option value="unemployed">Tidak Memiliki Pekerjaan</option>
                        <option value="housewife">Ibu Rumah Tangga</option>
                        <option value="privateemployee">Karyawan Swasta</option>
                        <option value="civilemployee">Pegawai Negeri Sipil</option>
                        <option value="freelance">Freelance</option>
                        <option value="teacher">Guru/Tenaga Pengajar</option>
                        <option value="other">Lain-lain</option>
                    </select>
                </div>

                @if ($workTitle != 'unemployed' && $workTitle != 'housewife')
                <div class="mb-6">
                    <label for="workSite" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Tempat Bekerja
                    </label>
                    <input type="text" id="workSite" wire:model.live='workSite'
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="Masukkan tempat bekerja">
                    @error('workSite')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                        {{$message}}</p>
                    @enderror

                </div>
                @endif

                <div
                    class="col-span-2 flex items-center justify-end px-4 py-3 bg-gray-50 text-end sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                    <div wire:loading wire:target="update" class="mr-4">
                        <div role="status">
                            <svg aria-hidden="true"
                                class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-yellow-400"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <div x-data="{ shown: false, timeout: null }"
                        x-init="window.Livewire.find('AUDFuqdDyOf3RHmA7y7x').on('saved', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 2000); })"
                        x-show.transition.out.opacity.duration.1500ms="shown"
                        x-transition:leave.opacity.duration.1500ms="" style="display: none;"
                        class="text-sm text-gray-600 me-3">
                        Saved.
                    </div>

                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                        wire:loading.attr="disabled" wire:target="photo">
                        Save
                    </button>
                </div>
                <!--[if ENDBLOCK]><![endif]-->
            </form>
        </div>
    </x-page.content-white>
    <script src="{{asset('tinymce/js/tinymce/tinymce.min.js')}}"></script>

    <script>
        function callme(field) {
            // alert("field:" + field.value);
            // console.log("field:" + field.value);
            @this.set('birthday', field.value);
        }
    </script>
</div>