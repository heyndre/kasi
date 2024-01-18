<div>
    <x-page.header>
        Ubah Data Kelas
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

            </div>

            <form wire:submit.prevent='updateClass' class="grid grid-cols-2 gap-4">
                <div class="mb-6 ">
                    <label for="topic" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Topik Kelas
                        @error('topic')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{$message}}</p>
                        @enderror
                    </label>
                    <input type="text" id="topic" name="topic" wire:model.live.debounce='topic'
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm disabled:cursor-not-allowed disabled:bg-red-50 disabled:border-red-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="Masukkan topik kelas">
                    <hr class="col-span-2">
                </div>

                {{-- Lesson --}}
                <div class="mb-6 col-span-2 ">
                    <label for="teaching_exp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Materi Kelas
                        @error('lesson')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{$message}}</p>
                        @enderror
                    </label>
                    <x-page.mce>
                        <x-slot name="name">
                            lesson
                        </x-slot>
                    </x-page.mce>
                    <hr class="col-span-2">
                </div>


                <div class="mb-6  col-span-2">
                    <div class="" wire:ignore>
                        <label for="reference" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Link Referensi Tambahan
                            @error('reference')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                    class="font-medium">Oops!</span>
                                {{$message}}</p>
                            @enderror
                        </label>
                        <select wire:model.live='reference' id="reference" multiple='multiple'
                            class="bg-gray-50 h-full border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach (json_decode($links) as $item)
                            <option value="{{$item}}" selected>{{$item}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- <div class="mb-6  col-span-2">
                    <div class="">
                        @foreach ($files as $item)
                        <a href=""></a>
                        @endforeach
                    </div>
                    <div class="">
                        <label for="files" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Unggah File Kelas
                            @error('files')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                    class="font-medium">Oops!</span>
                                {{$message}}</p>
                            @enderror
                        </label>
                        <x-page.filepond wire:model='files' multiple />
                    </div>
                </div> --}}

                <div class="mb-6 ">
                    <div class="">
                        @foreach ($files as $item)
                        <a href=""></a>
                        @endforeach
                    </div>
                    <div class="">
                        <label for="recording" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Unggah Rekaman Kelas
                            @error('recording')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                    class="font-medium">Oops!</span>
                                {{$message}}</p>
                            @enderror
                        </label>
                        <input type="text" id="recording" name="recording" wire:model.live.debounce='recording'
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm disabled:cursor-not-allowed disabled:bg-red-50 disabled:border-red-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                            placeholder="Masukkan link rekaman kelas">
                        {{-- <input type="file" wire:model='files'> --}}
                        {{--
                        <x-page.filepond wire:model='recording' multiple /> --}}
                    </div>
                </div>
                <div class="mb-6">
                    <div class="">
                        @if ($currentPhoto)
                        <a class="example-image-link" href="{{route('file.class.photo', ['file' => $currentPhoto])}}"
                            data-lightbox="foto-pelaksanaan-kelas" data-title="">
                            <img src="{{route('file.class.photo', ['file' => $currentPhoto])}}" alt="">
                        </a>
                        @endif
                    </div>
                    <div class="">
                        <label for="photo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Unggah Foto Kelas
                            <div class="text-sm">
                                Unggah foto baru akan menghapus foto yang lama
                            </div>
                            @error('photo')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                    class="font-medium">Oops!</span>
                                {{$message}}</p>
                            @enderror
                        </label>
                        <x-page.filepond-image-resize-720 wire:model='photo' />
                    </div>
                </div>


                <div class="block col-span-2 " wire:loading.remove>
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
                    <a href="{{url()->previous()}}"
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
            $('#reference').val(@json(json_decode($links)));
            $('#reference').trigger('change.select2');

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