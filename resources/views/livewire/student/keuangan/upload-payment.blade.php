<div>
    <x-page.header>
        {{__('Upload Payment Proof')}}
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
            <form wire:submit.prevent='uploadPayment' class="grid grid-cols-2 gap-4">
                <div class="mt-6">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        {{__('Transaction Detail')}}
                    </label>
                    Invoice # : {{str_pad($theBillData->invoice_id, 5, '0', STR_PAD_LEFT)}}
                    <p>{{__("Amount")}} : {{$theBillData->theStudent->nationality == 'KOREAN' ? 'KRW' :
                        'Rp.'}}{{number_format($theBillData->amount, 2, ',', '.')}}</p>
                    @if (auth()->user()->theStudent->nationality != 'KOREAN')
                    <p class="italic">Terbilang : {{Terbilang::make($theBillData->amount, ' rupiah')}}</p>
                    @endif
                </div>
                <div class="mb-6" wire:ignore>
                    <label for="eduStatus" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        {{__('Payment Method')}}
                        @error('eduStatus')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{$message}}</p>
                        @enderror
                    </label>
                    <select wire:model.live='payMethod' id="payMethod"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value=""></option>
                        @if ($packageData != null)
                        @if ($packageData->remaining > 0)
                        <option value="package">Kuota Paket Kelas : sisa {{$packageData->remaining}} menit</option>
                        @else
                        <option value="bank_transfer">Transfer Bank</option>
                        <option value="other">Metode pembayaran lainnya</option>
                        <option value="package" disabled>Kuota Paket Kelas (tidak ada kuota aktif)</option>
                        @endif
                        @else
                        <option value="bank_transfer">{{__('Bank Transfer')}}</option>
                        <option value="other">{{__('Other Payment Method')}}</option>
                        <option value="package" disabled>Kuota Paket Kelas (tidak ada kuota aktif)</option>
                        @endif
                    </select>
                </div>
                @if ($payMethod == 'bank_transfer')
                <div class="mt-4 text-gray-800 text-sm">
                    @if (auth()->user()->theStudent->nationality == 'KOREAN')
                    Please transfer the payment to
                    <p class="font-semibold">BANK BCA (Indonesia) 0240920395</p>
                    <p class="text-sm italic"> Firstya Andreas Pandega</p>
                    before <span class="font-bold">{{$theBillData->due_date->format('d/m/Y')}}</span>.
                    Passing this date will incur additional fees.
                    @endif
                    @if (auth()->user()->theStudent->nationality == 'INDONESIAN')
                    Pembayaran dapat dilakukan melalui transfer ke
                    <p class="font-semibold">BANK BCA 0240920395</p>
                    <p class="text-sm italic">a.n. Firstya Andreas Pandega</p>
                    maksimal pada tanggal <span class="font-bold">{{$theBillData->due_date->format('d/m/Y')}}</span>.
                    Keterlambatan pembayaran dapat mengakibatkan denda.
                    @endif
                </div>
                @else
                <div class=""></div>
                @endif
                @if ($payMethod == 'bank_transfer' || $payMethod == 'other')
                <div x-data="{photoName: null, photoPreview: null}" class="">
                    <!-- Profile Photo File Input -->
                    <input type="file" id="photo" class="hidden" wire:model.live="receipt" x-ref="photo" x-on:change="
                                            photoName = $refs.photo.files[0].name;
                                            const reader = new FileReader();
                                            reader.onload = (e) => {
                                                photoPreview = e.target.result;
                                            };
                                            reader.readAsDataURL($refs.photo.files[0]);
                                    " />

                    <x-label for="photo" value="Bukti Pembayaran" />

                    <!-- New Profile Photo Preview -->
                    <div class="mt-2" x-show="photoPreview" style="display: none;">
                        <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                            x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                        </span>
                    </div>

                    <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                        Pilih Bukti Pembayaran
                    </x-secondary-button>

                    @error('avatar')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                        {{$message}}</p>
                    @enderror
                </div>
                @endif

                <div class="block col-span-2 mt-6">
                    <button type="submit" wire:loading.remove
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 16 12">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5.917 5.724 10.5 15 1.5" />
                        </svg>
                        {{__('Save')}}
                        {{-- <input wire:click='' type="submit" value="" class="hidden"> --}}
                    </button>
                    <div role="status" wire:loading>
                        <svg aria-hidden="true"
                            class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
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
                    <a href="{{route('student.billing.index')}}" wire:navigate wire:loading.remove
                        class="text-white bg-yellow-500 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                        <svg class="w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 18 15">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 7.5h11m0 0L8 3.786M12 7.5l-4 3.714M12 1h3c.53 0 1.04.196 1.414.544.375.348.586.82.586 1.313v9.286c0 .492-.21.965-.586 1.313A2.081 2.081 0 0 1 15 14h-3" />
                        </svg>
                        {{__('Cancel')}}
                    </a>
                </div>
            </form>
        </div>
    </x-page.content-white>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // $(document).ready(function () {
        //     $('#payMethod').select2();
        // });

        // $('#payMethod').on('change', function (e) {
        //     var data = $('#payMethod').select2("val");
        //     console.log(data);
        //     @this.set("payMethod", data);
        // });

        // $('#payMethod').on('select2:close', function (e) {
        //     var data = $('#payMethod').select2("val");
        //     console.log(data);
        //     @this.set("payMethod", data);
        // });

        $(document).ready(function() {
            $('#payMethod').select2({
                placeholder: '{{__("Select Payment Method")}}',
            }).on('change', function(e){
                @this.set('payMethod', e.target.value);
            });
        });
        // $('#payMethod').select2({
        //     }).on('change', function(e){
        //         @this.set('payMethod', e.target.value);
        // });
        $('#payMethod').on('select2:close', function(e){
                @this.set('payMethod', e.target.value);
        });
        document.addEventListener("livewire:load", function (event) {
            window.livewire.hook('afterDomUpdate', () => {
                $('#payMethod').select2({
                    placeholder: 'Pilih metode pembayaran',
                });
            });
        });
    </script>
</div>