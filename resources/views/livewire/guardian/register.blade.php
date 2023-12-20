<div>
    <x-page.header>
        Registrasi Wali Murid Baru
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
                            Tambah Foto Wali Murid
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
                        Email wali murid
                        @error('email')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{$message}}</p>
                        @enderror
                    </label>
                    <input type="email" id="email" wire:model.live.debounce='email'
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="Masukkan email wali murid untuk login">
                </div>
                {{-- WhatsApp --}}
                <div class="mb-6">
                    <label for="whatsapp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Nomor WhatsApp Wali Murid
                        @error('whatsapp')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{$message}}</p>
                        @enderror
                    </label>
                    <input type="tel" id="whatsapp" name="whatsapp" wire:model.live.debounce='whatsapp'
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="Masukkan nomor whatsapp wali murid">
                </div>
                {{-- Name --}}
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Nama Wali Murid
                        @error('name')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{$message}}</p>
                        @enderror
                    </label>
                    <input type="text" id="name" name="name" wire:model.live.debounce='name'
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="Masukkan nama wali murid">
                </div>

                {{-- Address --}}
                <div class="mb-6">
                    <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Alamat Wali Murid
                    </label>
                    <textarea id="address" rows="4" name="address" wire:model.live.debounce='address'
                        class="no-resize block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Masukkan alamat wali murid"></textarea>
                    @error('address')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                        {{$message}}</p>
                    @enderror
                </div>
                {{-- Religion --}}
                <div class="mb-6">
                    <label for="religion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Agama Wali Murid
                        @error('religion')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{$message}}</p>
                        @enderror
                    </label>
                    <input type="text" id="religion" name="religion" wire:model.live.debounce='religion'
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="Masukkan agama wali murid">
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
                    <input type="text" id="eduSite" wire:model.live.debounce='eduSite'
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
                    <input type="text" id="eduMajor" wire:model.live.debounce='eduMajor'
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
                    <input type="text" id="workSite" wire:model.live.debounce='workSite'
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
                    <a href="{{route('guardian.index')}}" wire:navigate
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