<div>
    <x-page.header>
        Ubah Detail Murid - {{$nim}}
    </x-page.header>
    <x-slot name='button'>
        <x-page.back-button>
            Kembali
            <x-slot name='route'>
                {{route('student.show', ['nim' => $nim])}}
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

                <!-- Email -->
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="email">
                        Email
                    </label>
                    <input
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        id="email" type="email" wire:model="email" required="required" autocomplete="username">
                    <!--[if BLOCK]><![endif]-->
                    <!--[if ENDBLOCK]><![endif]-->

                    <!--[if BLOCK]><![endif]-->
                    <!--[if ENDBLOCK]><![endif]-->
                </div>

                <div class="mb-6">
                    <label for="whatsapp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Nomor WhatsApp Murid
                        @error('whatsapp')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{$message}}</p>
                        @enderror
                    </label>
                    <input type="tel" id="whatsapp" name="whatsapp" wire:model.live.debounce.500ms='whatsapp'
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
                    <input type="text" id="name" name="name" wire:model.live.debounce.500ms='name'
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="Masukkan nama murid">
                </div>

                <div class="mb-6">
                    <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Alamat Murid
                    </label>
                    <textarea id="address" rows="4" name="address" wire:model.live.debounce.500ms='address'
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
                        <input datepicker datepicker-format="yyyy-mm-dd" type="text" name="birthday" wire:model='birthday'
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Pilih tanggal ulang tahun murid" onblur="callme(this);">
                    </div>
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
                        <option value="1">Sedang Menempuh Studi</option>
                        <option value="0">Sudah Menyelesaikan Studi</option>
                    </select>
                </div>

                @if ($eduStatus == '1')
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
                @elseif ($eduStatus == '0')
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

                @if ($eduStatus == '1')
                <div class="mb-6">
                    <label for="eduSite" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Tempat Studi
                        <input type="text" id="eduSite" wire:model.live.debounce.500ms='eduSite'
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                            placeholder="Masukkan tempat studi">
                        @error('eduSite')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{$message}}</p>
                        @enderror
                    </label>

                </div>
                @endif

                @if ($eduStatus == '0' && ($workTitle != 'unemployed' && $workTitle != 'housewife'))
                <div class="mb-6">
                    <label for="workSite" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Tempat Bekerja
                        <input type="text" id="workSite" wire:model.live.debounce.500ms='workSite'
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

                @if ($hasGuardian == true)
                <div class="mb-6">
                    <label for="guardian_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Nama Wali Murid
                    </label>
                    <input type="text" id="guardian_name" wire:model.live.debounce.500ms='guardianName'
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
                    <input type="tel" id="guardian_whatsapp" wire:model.live.debounce.500ms='guardianWhatsapp'
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="Masukkan nomor whatsapp wali murid">
                    @error('guardianWhatsapp')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                        {{$message}}</p>
                    @enderror
                </div>

                @endif

                <!--[if BLOCK]><![endif]-->
                <div
                    class="col-span-2 flex items-center justify-end px-4 py-3 bg-gray-50 text-end sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
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
    
    <script>
        function callme(field) {
            // alert("field:" + field.value);
            // console.log("field:" + field.value);
            @this.set('birthday', field.value);
        }
    </script>
</div>