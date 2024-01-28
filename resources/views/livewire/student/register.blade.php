<div>
    <x-page.header>
        Registrasi Murid Baru
    </x-page.header>

    <x-page.style>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
            <form wire:submit.prevent='register' class="grid grid-cols-2 gap-4">
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
                            Tambah Foto Murid
                        </x-secondary-button>

                        @error('avatar')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="mb-6">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Email murid
                        @error('email')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{$message}}</p>
                        @enderror
                    </label>
                    <input type="email" id="email" wire:model.live.debounce='email'
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="Masukkan email murid untuk login">
                </div>

                <div class="mb-6">
                    <label for="whatsapp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Nomor WhatsApp Murid
                        @error('whatsapp')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{$message}}</p>
                        @enderror
                    </label>
                    <input type="tel" id="whatsapp" name="whatsapp" wire:model.live.debounce='whatsapp'
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="Masukkan nomor whatsapp murid">
                </div>
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Nama Murid
                        @error('name')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{$message}}</p>
                        @enderror
                    </label>
                    <input type="text" id="name" name="name" wire:model.live.debounce='name'
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="Masukkan nama murid">
                </div>

                <div class="mb-6 grid">
                    <div class="w-full block">
                        <label for="nickname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Nama Panggilan Murid
                            @error('nickname')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                    class="font-medium">Oops!</span>
                                {{$message}}</p>
                            @enderror
                        </label>
                        <input type="text" id="nickname" name="nickname" wire:model.live.debounce='nickname'
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                            placeholder="Masukkan nama panggilan murid">
                    </div>
                    <div class="w-full">
                        <label for="religion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Agama Murid
                            @error('religion')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                    class="font-medium">Oops!</span>
                                {{$message}}</p>
                            @enderror
                        </label>
                        <input type="text" id="religion" name="religion" wire:model.live.debounce='religion'
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                            placeholder="Masukkan agama murid">
                    </div>
                </div>

                <div class="mb-6">
                    <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Alamat Murid
                    </label>
                    <textarea id="address" rows="4" name="address" wire:model.live.debounce='address'
                        class="no-resize block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Masukkan alamat murid"></textarea>
                    @error('address')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                        {{$message}}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="birthday" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Ulang Tahun Murid
                        @error('birthday')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
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
                            placeholder="Pilih tanggal ulang tahun murid" id="birthday" onblur="callme(this);">
                    </div>
                </div>

                <div class="mb-6">
                    <label for="nationality" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Kewarganegaraan
                        @error('nationality')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{$message}}</p>
                        @enderror
                    </label>
                    <select wire:model.live='nationality' id="nationality"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="INDONESIAN">Indonesia</option>
                        <option value="KOREAN">Korea</option>
                    </select>
                </div>

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

                @if ($eduStatus == 'educating')
                <div class="mb-6">
                    <label for="eduLevel" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Jenjang pendidikan yang sedang ditempuh
                        @error('eduLevel')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{$message}}</p>
                        @enderror
                    </label>
                    <select wire:model.live='eduLevel' id="eduLevel"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" disabled>Pilih jenjang pendidikan</option>
                        <option value="tk">Taman Kanak-Kanak</option>
                        <option value="sd">Sekolah Dasar</option>
                        <option value="smp">Sekolah Menengah Pertama/Ekuivalen</option>
                        <option value="sma">Sekolah Menengah Atas/Ekuivalen</option>
                        <option value="smk">Sekolah Menengah Kejuruan/Ekuivalen</option>
                        <option value="s1">Studi S1</option>
                        <option value="s2">Studi S2</option>
                        <option value="s3">Studi S3</option>
                    </select>
                </div>
                @elseif ($eduStatus == 'finished')
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
                @endif

                @if ($eduStatus == 'educating')
                <div class="mb-6">
                    <label for="eduSite" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Tempat Studi
                        <input type="text" id="eduSite" wire:model.live.debounce='eduSite'
                            class="shadow-sm bg-gray-50 mt-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                            placeholder="Masukkan tempat studi">
                        @error('eduSite')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{$message}}</p>
                        @enderror
                    </label>

                </div>
                @endif

                @if ($eduStatus == 'finished' && ($workTitle != 'unemployed' && $workTitle != 'housewife'))
                <div class="mb-6">
                    <label for="workSite" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Tempat Bekerja
                        <input type="text" id="workSite" wire:model.live.debounce='workSite'
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                            placeholder="Masukkan tempat bekerja">
                        @error('workSite')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{$message}}</p>
                        @enderror
                    </label>

                </div>
                @endif
                <div class="col-span-2">
                    <label class="relative inline-flex items-center mb-5 cursor-pointer">
                        <input wire:model.live='hasGuardian' type="checkbox" value='true' class="sr-only peer"
                            name="has_guardian">
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                        </div>
                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Punya Wali Murid
                        </span>
                    </label>
                </div>

                <div wire:ignore class="col-span-2">
                    <select class="w-full" id="guardians">
                        <option value="">Pilih Wali Murid</option>
                        @foreach($guardians as $item)
                        <option value="{{ $item->id }}">{{$item->userData->name}}
                            ({{$item->userData->mobile_number}})
                        </option>
                        @endforeach
                    </select>
                </div>
                @if ($hasGuardian == true)
                {{-- <div class="mb-6">
                    <label for="guardian_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Nama Wali Murid
                    </label>
                    <input type="text" id="guardian_name" wire:model.live.debounce='guardianName'
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="Masukkan nama wali murid">
                    @error('guardianName')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                        {{$message}}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="guardian_whatsapp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Nomor WhatsApp Wali Murid
                    </label>
                    <input type="tel" id="guardian_whatsapp" wire:model.live.debounce='guardianWhatsapp'
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="Masukkan nomor whatsapp wali murid">
                    @error('guardianWhatsapp')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                        {{$message}}</p>
                    @enderror
                </div> --}}

                @endif
                <div class="block">
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
                    <a href="{{route('student.active')}}" wire:navigate
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        function callme(field) {
            // alert("field:" + field.value);
            // console.log("field:" + field.value);
            @this.set('birthday', field.value);
        }

        $(document).ready(function () {
            $('#guardians').select2();
        });

        $('#guardians').on('change', function (e) {
            var data = $('#guardians').select2("val");
            console.log(data);
            @this.set("guardian", data);
        });
    </script>
</div>