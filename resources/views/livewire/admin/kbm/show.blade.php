@push('title')
    Detail Kelas #{{$course->id}}
@endpush
<div>
    <x-page.header>
        Detail Kelas
    </x-page.header>
    <x-slot name='button'>
        @if (auth()->user()->role == 'ADMIN' || auth()->user()->role == 'SUPERADMIN')
        <x-page.edit-button>
            Ubah Data Kelas
            <x-slot name='route'>
                {{route('kbm.edit', ['id' => $course->id])}}
            </x-slot>
        </x-page.edit-button>

        @if ($course->status == 'WAITING')
        <x-page.edit-button>
            Ubah Jadwal Kelas
            <x-slot name='route'>
                {{route('kbm.edit.reschedule', ['id' => $course->id])}}
            </x-slot>
        </x-page.edit-button>
        @endif
        @if ($billingStatus == 'Belum ditagih')
        <x-page.button-with-confirm confirmMessage='Konfirmasi penambahan kelas ke billing?'>
            Masukkan ke billing
            <x-slot name='route'>
                {{route('billing.add', ['id' => $course->id])}}
            </x-slot>
        </x-page.button-with-confirm>
        @endif

        @if ($billingStatus == 'Ditagih')
        <x-page.edit-button>
            Cek Pembayaran
            <x-slot name='route'>
                {{route('payment.student.status', ['id' => $billing->id])}}
            </x-slot>
        </x-page.edit-button>
        @endif

        @elseif (auth()->user()->isStudent())
        @if ($billingStatus == 'Ditagih')
        <x-page.edit-button>
            {{__('View Billing Status')}}
            <x-slot name='route'>
                {{route('student.billing.status', ['id' => $billing->id])}}
            </x-slot>
        </x-page.edit-button>
        @endif
        @if ($course->status == 'WAITING')
        {{-- <x-page.green-button-message message='Terima kasih telah konfirmasi kehadiran, selamat belajar di KASI!'>
            Konfirmasi Selesai
            <x-slot name='route'>
                {{route('student.classes.attendance', ['id' => $course->id])}}
            </x-slot>
        </x-page.green-button-message> --}}
        @endif
        @elseif (auth()->user()->isGuardian())
        @if ($billingStatus == 'Ditagih')
        <x-page.edit-button>
            Cek Pembayaran
            <x-slot name='route'>
                {{route('guardian.billing.status', ['id' => $billing->id])}}
            </x-slot>
        </x-page.edit-button>
        @endif
        @elseif (auth()->user()->role == 'TUTOR')
        <x-page.edit-button>
            Ubah Data Kelas
            <x-slot name='route'>
                {{route('tutor.classes.edit', ['id' => $course->id])}}
            </x-slot>
        </x-page.edit-button>
        {{-- @if ($course->status == 'WAITING')
        <x-page.green-button-message message='Terima kasih telah konfirmasi kehadiran, selamat mengajar di KASI!'>
            Konfirmasi Selesai
            <x-slot name='route'>
                {{route('tutor.classes.attendance', ['id' => $course->id])}}
            </x-slot>
        </x-page.green-button-message>
        @endif --}}
        @endif

        {{-- <x-page.back-button>
            Kembali
            <x-slot name='route'>
                {{route('kbm.index')}}
            </x-slot>
        </x-page.back-button> --}}
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
            <x-page.notification />
            <div
                class=" min-h-[100vh] flex flex-col w-full gap-4 p-4 bg-white border border-gray-200 rounded-lg md:flex-row dark:border-gray-700 dark:bg-gray-800">
                <div class="w-1/3 p-6">
                    <div class="text-2xl font-bold">
                        {{__('Class Data')}}
                    </div>
                    <div class="grid gap-y-2">
                        <div class="border-b-1">
                            {{__('Date and Time')}}
                            <div class="font-thin">
                                {{$course->date_of_event->format('l d M Y H:i T')}}
                            </div>
                        </div>
                        <div class="border-b-1">
                            {{__('Duration')}}
                            <div class="font-thin">
                                {{$course->length}} {{__('minutes')}}
                            </div>
                        </div>
                        @if (auth()->user()->isTutor() || auth()->user()->isManagement())
                        <div class="border-b-1">
                            Perkiraan pendapatan Tutor
                            <div class="font-thin">
                                Rp.{{number_format($course->length / 60 * $course->price * $course->tutor_percentage / 100, 2, ',', '.')}} 
                            </div>
                        </div>
                        @endif
                        @if (auth()->user()->isManagement())
                        <div class="border-b-1">
                            Perkiraan pendapatan KASI
                            <div class="font-thin">
                                Rp.{{number_format($course->length / 60 * $course->price * (100 - $course->tutor_percentage) / 100, 2, ',', '.')}} 
                            </div>
                        </div>
                        @endif


                        <hr class="p-3">
                        <div class="border-b-1">
                            {{__('Student Attendance')}}
                            <div class="font-thin">
                                @if ($course->student_attendance !== null)
                                {{$course->student_attendance->format('l d M Y H:i T')}}
                                <p class="italic font-thin">
                                    {{$course->student_attendance->diffForHumans($course->date_of_event,
                                    Carbon\CarbonInterface::DIFF_RELATIVE_AUTO, false, 2)}}
                                </p>
                                @if (auth()->user()->role == 'MURID' && ($course->status == 'WAITING' || $course->status
                                == 'RUNNING'))
                                <a href="{{$meetingLink}}" target="_blank"
                                    class="text-white bg-green-500 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                    {{__('Click to open the meeting')}}
                                </a>
                                @endif
                                @else
                                <p class="italic font-thin">
                                    {{__('No Data')}}
                                </p>
                                @if (auth()->user()->role == 'MURID')
                                <div>
                                    <div wire:click='studentAttendance'
                                        onclick="return alert('Kehadiran akan dicatat, selamat belajar di KASI! Silakan klik OK untuk melanjutkan')"
                                        class="cursor-pointer text-white bg-green-500 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                        <svg class="w-3.5 h-3.5 me-2" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                            <path
                                                d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z" />
                                            <path
                                                d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z" />
                                        </svg>
                                       {{__('Mark Attendance')}}
                                    </div>
                                </div>
                                @endif
                                @if (auth()->user()->isGuardian())
                                <div>
                                    <div wire:click='studentAttendanceByGuardian'
                                        onclick="return alert('Kehadiran akan dicatat, selamat belajar di KASI! Silakan klik OK untuk melanjutkan')"
                                        class="cursor-pointer text-white bg-green-500 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                        <svg class="w-3.5 h-3.5 me-2" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                            <path
                                                d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z" />
                                            <path
                                                d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z" />
                                        </svg>
                                        Tandai Kehadiran Murid & Masuk ke Kelas
                                    </div>
                                </div>
                                @endif
                                @endif
                            </div>
                        </div>
                        <div class="border-b-1">
                            {{__('Tutor Attendance')}}
                            <div class="font-thin">
                                @if ($course->tutor_attendance !== null)
                                {{$course->tutor_attendance->format('l d M Y H:i T')}}
                                <p class="italic font-thin">
                                    {{$course->tutor_attendance->diffForHumans($course->date_of_event,
                                    Carbon\CarbonInterface::DIFF_RELATIVE_AUTO, false, 2)}}
                                </p>
                                @if (auth()->user()->role == 'TUTOR' && ($course->status == 'WAITING' || $course->status
                                == 'RUNNING'))
                                <a href="{{$meetingLink}}" target="_blank"
                                    class="mb-3 text-white bg-green-500 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                    Klik untuk masuk ke kelas
                                </a>
                                <div>
                                    <div wire:click='tutorConfirmFinish'
                                        onclick="return confirm('Pastikan kelas sudah selesai, jika ya Admin KASI akan mendapat notifikasi')"
                                        class="cursor-pointer text-white bg-green-500 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                        <svg class="w-3.5 h-3.5 me-2" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                            <path
                                                d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z" />
                                            <path
                                                d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z" />
                                        </svg>
                                        Kirim Notifikasi Kelas Selesai
                                    </div>
                                </div>
                                @endif
                                @else
                                <p class="italic font-thin">
                                    Tidak ada data
                                </p>

                                @if (auth()->user()->role == 'TUTOR')
                                <div>
                                    <div wire:click='tutorAttendance'
                                        onclick="return alert('Kehadiran akan dicatat, selamat mengajar di KASI! Silakan klik OK untuk melanjutkan')"
                                        class="cursor-pointer text-white bg-green-500 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                        <svg class="w-3.5 h-3.5 me-2" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                            <path
                                                d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z" />
                                            <path
                                                d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z" />
                                        </svg>
                                        Tandai Kehadiran & Masuk ke Kelas
                                    </div>
                                </div>
                                @endif
                                @endif
                            </div>
                        </div>
                        <hr class="p-3">
                        {{-- <div class="border-b-1">
                            Billing Status
                            <div class="font-thin">
                                <a href="">
                                    {{$billingStatus}}
                                </a>
                            </div>
                        </div>
                        <div class="border-b-1">
                            Status Pembayaran dari Murid
                            <div class="font-thin">
                                <a href="">
                                    {{$studentPayment}}
                                </a>
                            </div>
                        </div>
                        <div class="border-b-1">
                            Status Pembayaran Ke Tutor
                            <div class="font-thin">
                                <a href="">
                                    {{$tutorPayment}}
                                </a>
                            </div>
                        </div> --}}

                        @if (auth()->user()->role == 'ADMIN' || auth()->user()->role == 'SUPERADMIN')
                        <hr class="p-3">
                        <div class="border-b-1">
                            Manajemen Status Kelas
                        </div>
                        @if ($course->status != 'CANCELLED')
                        <div wire:click='cancelClass' wire:confirm='Ubah status kelas menjadi dibatalkan?'
                            class="text-white cursor-pointer bg-red-500 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                            <svg class="w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 18">
                                <path
                                    d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z" />
                                <path
                                    d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z" />
                            </svg>
                            Batalkan Kelas
                        </div>
                        @endif
                        @if ($course->status != 'CONDUCTED')
                        <div wire:click='finishClass' wire:confirm='Ubah status kelas menjadi dilaksanakan?'
                            class="text-white cursor-pointer bg-sky-500 hover:bg-sky-800 focus:ring-4 focus:outline-none focus:ring-sky-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-sky-600 dark:hover:bg-sky-700 dark:focus:ring-sky-800">
                            <svg class="w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 18">
                                <path
                                    d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z" />
                                <path
                                    d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z" />
                            </svg>
                            Selesaikan Kelas
                        </div>
                        @endif
                        @if ($course->status != 'BURNED')
                        <div wire:click='burnClass'
                            wire:confirm='Ubah status kelas menjadi dilaksanakan tanpa kehadiran murid?'
                            class="text-white cursor-pointer bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 18">
                                <path
                                    d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z" />
                                <path
                                    d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z" />
                            </svg>
                            Selesaikan Kelas tanpa murid
                        </div>
                        @endif
                        @endif
                    </div>
                </div>
                <div class="flex flex-col  leading-normal w-2/3">
                    {{-- @if ($course->tutor_attendance !== null && $course->student_attendance !== null)
                    <div
                        class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        Kehadiran Lengkap
                    </div>
                    @elseif ($course->tutor_attendance == null && $course->student_attendance !== null)
                    <div
                        class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        Murid sudah hadir, tutor belum hadir
                    </div>
                    @elseif ($course->tutor_attendance !== null && $course->student_attendance == null)
                    <div
                        class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        Murid belum hadir, tutor sudah hadir
                    </div>
                    @elseif ($course->tutor_attendance == null && $course->student_attendance == null)
                    <div
                        class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        Belum ada kehadiran
                    </div>
                    @else
                    @endif --}}
                    @if ($course->status == 'WAITING')
                    <div
                        class="text-cyan-700 bg-gradient-to-r from-cyan-100 to-blue-100 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        {{$course->statusName()}}
                    </div>
                    @elseif ($course->status == 'RUNNING')
                    <div
                        class="text-cyan-700 bg-gradient-to-r from-cyan-100 to-blue-100 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        {{$course->statusName()}}
                    </div>
                    @elseif ($course->status == 'BURNED')
                    <div
                        class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        {{$course->statusName()}}
                    </div>
                    @elseif ($course->status == 'NEEDCONFIRMATION')
                    <div
                        class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        {{$course->statusName()}}
                    </div>
                    @elseif ($course->status == 'CONDUCTED')
                    <div
                        class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        {{$course->statusName()}}
                    </div>
                    @elseif ($course->status == 'CANCELLED')
                    <div
                        class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        {{$course->statusName()}}
                    </div>
                    @endif
                    <div wire:ignore
                        class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 rounded-t-lg bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800"
                            id="defaultTab" data-tabs-toggle="#defaultTabContent" role="tablist">
                            <li class="me-2">
                                <button id="about-tab" data-tabs-target="#about" type="button" role="tab"
                                    aria-controls="about" aria-selected="true"
                                    class="inline-block p-4 text-blue-600 rounded-ss-lg hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-blue-500">
                                    {{__('Class Information')}}
                                </button>
                            </li>
                            <li class="me-2">
                                <button id="services-tab" data-tabs-target="#services" type="button" role="tab"
                                    aria-controls="services" aria-selected="false"
                                    class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                                    {{__('Student Information')}}
                                </button>
                            </li>
                            <li class="me-2">
                                <button id="statistics-tab" data-tabs-target="#statistics" type="button" role="tab"
                                    aria-controls="statistics" aria-selected="false"
                                    class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                                    {{__('Tutor Information')}}
                                </button>
                            </li>
                        </ul>
                        <div id="defaultTabContent">
                            <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800 w-full" id="about"
                                role="tabpanel" aria-labelledby="about-tab">
                                <div class="grid grid-cols-2 grid-flow-auto gap-4">
                                    <div class="w-fit">
                                        <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                            for="name">
                                            Course
                                        </label>
                                        <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                            {{$course->theCourse->name}}
                                        </div>
                                    </div>
                                    <div class="w-fit">
                                        <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                            for="name">
                                            {{__('Topic')}}
                                        </label>
                                        <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                            {{$course->topic}}
                                        </div>
                                    </div>
                                    <div class="w-fit">
                                        <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                            for="name">
                                            {{__('Tutor Notes for Student')}}
                                        </label>
                                        <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                            {{$course->tutor_notes}}
                                        </div>
                                    </div>
                                    @if (auth()->user()->isTutor() || auth()->user()->isManagement())
                                    <div class="w-fit">
                                        <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                            for="name">
                                            Catatan Tutor (Internal)
                                        </label>
                                        <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                            {{$course->tutor_notes_to_admin}}
                                        </div>
                                    </div>
                                    @endif
                                    <div class="w-fit">
                                        <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                            for="name">
                                            {{__('Additional References')}}
                                        </label>
                                        <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                            @php
                                            // dd(json_decode($course->additional_links))
                                            @endphp
                                            <ul class="">
                                                @forelse (json_decode($course->additional_links) as $item)
                                                <li class="text-wrap break-all hover:underline hover:text-sky-600 mb-2">
                                                    <a href="{{$item}}" target="_blank" class="">
                                                        {{$item}}
                                                    </a>
                                                </li>
                                                @empty
                                                @endforelse
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="w-fit">
                                        <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                            for="name">
                                            {{__('Class Recording')}}
                                        </label>
                                        <div
                                            class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400 text-wrap break-all hover:underline hover:text-sky-600">
                                            <a href="{{$recording}}">{{$recordingSource}}</a>
                                        </div>
                                    </div>
                                    <div class="w-fit">
                                        <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                            for="name">
                                            {{__('Class Photo')}}
                                        </label>
                                        <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                            @if ($course->photo)
                                            <a class="example-image-link"
                                                href="{{route('file.class.photo', ['file' => $course->photo])}}"
                                                data-lightbox="foto-pelaksanaan-kelas" data-title="">
                                                <img src="{{route('file.class.photo', ['file' => $course->photo])}}"
                                                    alt="">
                                            </a>
                                            @else
                                            {{__('No Photo')}}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="w-fit col-span-2">
                                        <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                            for="name">
                                            {{__('Class Matter')}}
                                        </label>
                                        <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                            {!!$course->lesson_matter!!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="services"
                            role="tabpanel" aria-labelledby="services-tab">
                            <div class="grid grid-cols-2 grid-flow-auto gap-4">
                                <div class="w-fit col-span-2">
                                    <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                        for="name">
                                        {{__('Student Data')}}
                                    </label>
                                    <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                        <div class="mb-4 font-light sm:mb-5 d">
                                            <div class="flex items-center">
                                                @php
                                                $words = preg_split("/\s+/", $course->theStudent->userData->name);
                                                $acronym = '';
                                                $acronymPlus = '';
                                                foreach ($words as $w) {
                                                $acronym .= mb_substr($w, 0, 1);
                                                $acronymPlus .= mb_substr($w, 0, 1).'+';
                                                }
                                                // dd($profile_photo);
                                                @endphp
                                                @if ($course->theStudent->userData->profile_photo_path == '')
                                                <img class="h-14 w-14 rounded-full object-cover"
                                                    src="https://ui-avatars.com/api/?name={{substr($acronymPlus, 0, 3)}}&color=7F9CF5&background=EBF4FF"
                                                    alt="{{$acronym}}">
                                                @else
                                                <img class="w-14 h-14 rounded-full"
                                                    src="{{asset($course->theStudent->userData->profile_photo_path)}}"
                                                    alt="{{$acronym}}">
                                                @endif
                                                <div class="pl-3 space-y-2">
                                                    <a href="{{route('student.show', ['nim' => $course->theStudent->nim])}}"
                                                        class="hover:underline">
                                                        <div
                                                            class="text-base font-semibold bg-white-100/50 rounded-sm px-2 py-1">
                                                            {{$course->theStudent->userData->nickname}}
                                                        </div>
                                                        <div class="font-thin text-xs text-gray-900 px-2 py-1">
                                                            {{$course->theStudent->userData->name}}
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="statistics"
                            role="tabpanel" aria-labelledby="statistics-tab">
                            <div class="grid grid-cols-2 grid-flow-auto gap-4">
                                <div class="w-fit col-span-2">
                                    <label class="mb-2 font-semibold leading-none text-gray-900 dark:text-white"
                                        for="name">
                                        {{__('Tutor Data')}}
                                    </label>
                                    <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                        <div class="mb-4 font-light sm:mb-5 d">
                                            <div class="flex items-center">
                                                @php
                                                $words = preg_split("/\s+/", $course->theTutor->userData->name);
                                                $acronym = '';
                                                $acronymPlus = '';
                                                foreach ($words as $w) {
                                                $acronym .= mb_substr($w, 0, 1);
                                                $acronymPlus .= mb_substr($w, 0, 1).'+';
                                                }
                                                // dd($profile_photo);
                                                @endphp
                                                @if ($course->theTutor->userData->profile_photo_path == '')
                                                <img class="h-14 w-14 rounded-full object-cover"
                                                    src="https://ui-avatars.com/api/?name={{substr($acronymPlus, 0, 3)}}&color=7F9CF5&background=EBF4FF"
                                                    alt="{{$acronym}}">
                                                @else
                                                <img class="w-14 h-14 rounded-full"
                                                    src="{{asset($course->theTutor->userData->profile_photo_path)}}"
                                                    alt="{{$acronym}}">
                                                @endif
                                                <div class="pl-3 space-y-2">
                                                    <a href="{{route('tutor.show', ['slug' => $course->theTutor->userData->slug])}}"
                                                        class="hover:underline">
                                                        <div
                                                            class="text-base font-semibold bg-white-100/50 rounded-sm px-2 py-1">
                                                            {{$course->theTutor->userData->nickname}}
                                                        </div>
                                                        <div class="font-thin text-xs text-gray-900 px-2 py-1">
                                                            {{$course->theTutor->userData->name}}
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-page.content-white>
</div>