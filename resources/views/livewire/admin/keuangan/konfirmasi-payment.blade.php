<div>
    <x-page.header>
        Unggah Bukti Pembayaran
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
            <form wire:submit.prevent='validatePayment' class="grid grid-cols-2 gap-4">
                <div class="mt-6 space-y-4">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Detail Transaksi
                    </label>
                    Nomor Invoice : {{str_pad($payment->theBill->invoice_id, 5, '0', STR_PAD_LEFT)}}
                    <p>Jumlah ditagihkan : Rp.{{number_format($payment->theBill->amount, 2, ',', '.')}}</p>
                    <p class="italic">Terbilang : {{Terbilang::make($payment->theBill->amount, ' rupiah')}}</p>
                    <label for="validStatus" class="block mb-2text-sm font-medium text-gray-900 dark:text-white">
                        Validasi Pembayaran
                        @error('validStatus')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                            {{$message}}</p>
                        @enderror
                    </label>
                    <select wire:model.live='validStatus' id="validStatus"
                        class="w-full">
                        <option value="" disabled>Pilih status validasi</option>
                        <option value="invalid">Pembayaran tidak valid</option>
                        <option value="valid">Pembayaran valid</option>
                    </select>
                    <div class="mt-6">
                        <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Jumlah yang dibayarkan berdasarkan bukti pembayaran
                            @error('amount')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                                {{$message}}</p>
                            @enderror
                        </label>
                        <input type="number" id="amount" name="amount" wire:model.live='amount'
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                            placeholder="Masukkan jumlah pembayaran">
                    </div>
                </div>
                <div class="mb-6">
                    <img src="{{route('file.payment.student', ['nim' => $payment->payment_file])}}" class="max-h-screen h-screen" alt="" srcset="">
                </div>
                   
               

                <div class="block col-span-2 mt-6">
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
                    <a href="{{route('student.billing.index')}}" wire:navigate
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
        // $(document).ready(function () {
        //     $('#validStatus').select2();
        // });

        // $('#validStatus').on('change', function (e) {
        //     var data = $('#validStatus').select2("val");
        //     console.log(data);
        //     @this.set("validStatus", data);
        // });
    </script>
</div>