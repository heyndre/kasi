<div>
    <x-page.header>
        Jadwalkan Kelas
    </x-page.header>

    <x-page.style>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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
            <div class="w-full">
                @if($availability == 'available')
                <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-green-800 dark:text-green-400"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">INFO | </span> Jadwal tersedia, silakan isi data kelas
                    </div>
                </div>
                @endif
                @if($availability == 'not available')
                <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-red-800 dark:text-red-400"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Error</span>
                    <div>
                        <span class="font-medium">Kesalahan | </span> Jadwal tidak tersedia untuk tutor dan murid di jam terpilih, silakan cari jadwal lain
                    </div>
                </div>
                @endif
                @if($availability == 'waiting')
                <div class="flex items-center p-4 mb-4 text-sm text-orange-800 rounded-lg bg-orange-50 dark:bg-orange-800 dark:text-orange-400"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Warning</span>
                    <div>
                        <span class="font-medium">Peringatan | </span> Pilih tutor, murid, tanggal kelas serta isi durasi kemudian pilih Cek Ketersediaan
                    </div>
                </div>
                @endif
            </div>

            <form wire:submit.prevent='scheduleClass' class="grid grid-cols-2 gap-4">
                <div class="mb-6">
                    <label for="student" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Pilih Murid
                        @error('student')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{$message}}</p>
                        @enderror
                    </label>
                    @php
                    // dd($student);
                    @endphp
                    <div class="" wire:ignore>
                        <select wire:model.live='student' id="student"
                            class="bg-gray-50 h-full border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value=""></option>
                            @foreach ($students as $item)
                            <option value="{{$item->nim}}">{{$item->nim}} {{$item->userData->nickname}}
                                ({{$item->userData->name}})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @php
                // dd($tutor);
                @endphp
                <div class="mb-6">
                    <label for="tutor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Pilih Tutor
                        @error('tutor')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{$message}}</p>
                        @enderror
                    </label>
                    <div class="" wire:ignore>
                        <select wire:model.live='tutor' id="tutor"
                            class="bg-gray-50 h-full border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value=""></option>
                            @foreach ($tutors as $item)
                            <option value="{{$item->userData->slug}}">{{$item->userData->nickname}}
                                ({{$item->userData->name}})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex items-end gap-x-4 mb-6">
                    <div class="">
                        <label for="dateOfEvent" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Tanggal Pelaksanaan
                            @error('dateOfEvent')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                    class="font-medium">Oops!</span>
                                {{$message}}</p>
                            @enderror
                        </label>
                        <div class="relative max-w-sm">
                            <div
                                class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none transition">
                                @if (empty($dateOfEvent))
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>

                                @endif
                            </div>
                            {{-- <input datepicker datepicker-format="yyyy-mm-dd" type="text" name="dateOfEvent"
                                wire:model.live='dateOfEvent'
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Pilih tanggal pelaksanaan kelas" id="birthday" onblur="callme(this);"> --}}
                            @props(['options' => "{dateFormat:'Y-m-d H:i', altFormat:'F j, Y H:i', altInput:true,
                            enableTime: true, }"])
                            <div wire:ignore>
                                <input x-data x-init="flatpickr($refs.input, {{ $options }} );" x-ref="input"
                                    type="text" data-input {{ $attributes->merge(['class' => 'block w-full
                                disabled:bg-gray-200 p-2
                                border border-gray-300 rounded-md focus:border-blue-300 focus:ring focus:ring-blue-200
                                focus:ring-opacity-50 sm:text-sm sm:leading-5']) }} onChange="callme(this);"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <label for="length" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Durasi Kelas (menit)
                            @error('length')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                    class="font-medium">Oops!</span>
                                {{$message}}</p>
                            @enderror
                        </label>
                        <input type="number" id="length" name="length" wire:model.live.debounce='length' step="15" min="0"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                            placeholder="Masukkan durasi (menit)">
                    </div>
                    <div wire:click='checkAvailability' wire:loading.remove
                        class="cursor-pointer p-2 bg-amber-600 text-white font-semibold text-sm rounded-md shadow-md hover:bg-amber-700 transition">
                        Cek ketersediaan
                    </div>
                    <div role="status" wire:loading wire:target='checkAvailability'>
                        <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div class=""></div>
                <div class="mb-6 {{$availability == 'available' ? '' : 'hidden'}}">
                    <label for="selectedCourse" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Mata Pelajaran
                        @error('selectedCourse')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{$message}}</p>
                        @enderror
                    </label>
                    <select wire:model.live='selectedCourse' id="selectedCourse"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" disabled>Pilih mata pelajaran</option>
                        @isset($courseBase)
                        @foreach ($courseBase->theSkill as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                        @endisset
                    </select>
                </div>
                {{-- <div class="mb-6 {{$availability == 'available' ? '' : 'hidden'}}">
                    <label for="topic" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Topik Kelas
                        @error('topic')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{$message}}</p>
                        @enderror
                    </label>
                    <input type="text" id="topic" name="topic" wire:model.live.debounce='topic' {{$availability ? '' : 'disabled'}}
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm disabled:cursor-not-allowed disabled:bg-red-50 disabled:border-red-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="Masukkan topik kelas">
                        <hr class="col-span-2">
                </div> --}}

                {{-- Lesson --}}
                {{-- <div class="mb-6 col-span-2 {{$availability == 'available' ? '' : 'hidden'}}">
                    <label for="teaching_exp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Materi Kelas
                        @error('teachingExp')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{$message}}</p>
                        @enderror
                    </label>
                    <x-page.mce >
                        <x-slot name="name">
                            lesson
                        </x-slot>
                    </x-page.mce>
                    <hr class="col-span-2">
                </div> --}}


                {{-- <div class="mb-6 {{$availability == 'available' ? '' : 'hidden'}} col-span-2" >
                    <div class="" wire:ignore>
                        <label for="reference" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Link Referensi Tambahan
                        @error('reference')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{$message}}</p>
                            @enderror
                        </label>
                        <select wire:model.live='reference' id="reference" multiple='multiple'
                        class="bg-gray-50 h-full border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </select>
                    </div>
                </div> --}}

                

                <div class="block col-span-2 {{$availability == 'available' ? '' : 'hidden'}}">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 16 12">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5.917 5.724 10.5 15 1.5" />
                        </svg>
                        Jadwalkan
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
            @this.set('dateOfEvent', field.value);
        }

        $(document).ready(function () {
            $('#student').select2({
                placeholder: 'Pilih murid',
            });
            $('#tutor').select2({
                placeholder: 'Pilih tutor',
            });
            $('#reference').select2({
                placeholder: 'Masukkan link untuk referensi',
                tags: true,
            });
        });

        $('#student').on('change', function (e) {
            var data = $('#student').select2("val");
            console.log(data);
            @this.set("student", data);
        });
        $('#tutor').on('change', function (e) {
            var data = $('#tutor').select2("val");
            console.log(data);
            @this.set("tutor", data);
        });
        $('#reference').on('change', function (e) {
            var data = $('#reference').select2("val");
            console.log(data);
            @this.set("reference", data);
        });
    </script>
</div>