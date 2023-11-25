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
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1 flex justify-between">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium text-gray-900">Profile Information</h3>

                        <p class="mt-1 text-sm text-gray-600">
                            Update your account's profile information and email address.
                        </p>
                    </div>

                    <div class="px-4 sm:px-0">

                    </div>
                </div>

                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form wire:submit="updateProfileInformation">
                        <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                            <div class="grid grid-cols-6 gap-6">
                                <!-- Profile Photo -->
                                <!--[if BLOCK]><![endif]-->
                                <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                                    <!-- Profile Photo File Input -->
                                    <input type="file" id="photo" class="hidden" wire:model.live="photo" x-ref="photo"
                                        x-on:change="
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
                                        src="https://ui-avatars.com/api/?name={{$acronymPlus}}&color=7F9CF5&background=EBF4FF" alt="{{$acronym}}">
                                    @else
                                    <img class="w-14 h-14 rounded-full" src="{{asset($user->userData->profile_photo_path)}}" alt="{{$acronym}}">
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

                                    <!--[if BLOCK]><![endif]-->
                                    <!--[if ENDBLOCK]><![endif]-->

                                    <!--[if BLOCK]><![endif]-->
                                    <!--[if ENDBLOCK]><![endif]-->
                                </div>
                                <!--[if ENDBLOCK]><![endif]-->

                                <!-- Name -->
                                <div class="col-span-6 sm:col-span-4">
                                    <label class="block font-medium text-sm text-gray-700" for="name">
                                        Nama Murid
                                    </label>
                                    <input
                                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                        id="name" type="text" wire:model="name" required="required"
                                        autocomplete="name">
                                    <!--[if BLOCK]><![endif]-->
                                    <!--[if ENDBLOCK]><![endif]-->
                                </div>

                                <!-- Email -->
                                <div class="col-span-6 sm:col-span-4">
                                    <label class="block font-medium text-sm text-gray-700" for="email">
                                        Email
                                    </label>
                                    <input
                                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                        id="email" type="email" wire:model="email" required="required"
                                        autocomplete="username">
                                    <!--[if BLOCK]><![endif]-->
                                    <!--[if ENDBLOCK]><![endif]-->

                                    <!--[if BLOCK]><![endif]-->
                                    <!--[if ENDBLOCK]><![endif]-->
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    <label class="block font-medium text-sm text-gray-700" for="guardian_name">
                                        Nama Wali Murid
                                    </label>
                                    <input
                                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                        id="guardian_name" type="text" wire:model="guardianName" required="required"
                                        autocomplete="name">
                                    <!--[if BLOCK]><![endif]-->
                                    <!--[if ENDBLOCK]><![endif]-->
                                </div>
                            </div>
                        </div>

                        <!--[if BLOCK]><![endif]-->
                        <div
                            class="flex items-center justify-end px-4 py-3 bg-gray-50 text-end sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
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
            </div>
        </div>
    </x-page.content-white>
</div>