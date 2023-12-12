<div>
    <x-page.header>
        Registrasi Tutor Baru
    </x-page.header>

    <x-page.style>
        <style>
            label {
                font-weight: 600 !important;
            }

            .no-resize {
                resize: none !important;
            }
        </style>
        {{--
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
        <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script> --}}
    </x-page.style>

    <x-page.content-white>
        <div class="px-4 py-2">
            <form wire:submit.prevent='register' class="grid grid-cols-2 gap-4">
                {{-- Photo --}}
                <div class="mb-6">
                    <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                        <!-- Profile Photo File Input -->
                        <input type="file" id="photo" class="hidden" wire:model.live="avatar" x-ref="photo" x-on:change="
                                            photoName = $refs.photo.files[0].name;
                                            const reader = new FileReader();
                                            reader.onload = (e) => {
                                                photoPreview = e.target.result;
                                            };
                                            reader.readAsDataURL($refs.photo.files[0]);
                                    " />

                        <x-label for="photo" value="{{ __('Photo') }}" />

                        <!-- New Profile Photo Preview -->
                        <div class="mt-2" x-show="photoPreview" style="display: none;">
                            <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                                x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                            </span>
                        </div>

                        <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                            Tambah Foto Tutor
                        </x-secondary-button>

                        @error('avatar')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{$message}}</p>
                        @enderror
                    </div>
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
                        <input type="text" id="bank_account" name="bankAccount"
                            wire:model.live.debounce.500ms='bankAccount'
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
                    <input type="text" id="workSite" wire:model.live.debounce.500ms='workSite'
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="Masukkan tempat bekerja">
                    @error('workSite')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                        {{$message}}</p>
                    @enderror

                </div>
                @endif

                <div class="block col-span-2">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 16 12">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5.917 5.724 10.5 15 1.5" />
                        </svg>
                        Simpan
                        {{-- <input wire:click='' type="submit" value="" class="hidden"> --}}
                    </button>
                    <a href="{{route('tutor.active')}}" wire:navigate
                        class="text-white bg-yellow-500 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                        <svg class="w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 18 15">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 7.5h11m0 0L8 3.786M12 7.5l-4 3.714M12 1h3c.53 0 1.04.196 1.414.544.375.348.586.82.586 1.313v9.286c0 .492-.21.965-.586 1.313A2.081 2.081 0 0 1 15 14h-3" />
                        </svg>
                        Batal
                    </a>
                </div>
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

        $(document).ready( function () {
           
        });
    </script>
</div>