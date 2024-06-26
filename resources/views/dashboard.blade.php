<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if (auth()->user()->isManagement())
                <section class="bg-white dark:bg-gray-900">
                    <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12">
                        {{-- <a href="#"
                            class="inline-flex justify-between items-center py-1 px-1 pr-4 mb-7 text-sm text-gray-700 bg-gray-100 rounded-full dark:bg-gray-800 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700"
                            role="alert">
                            <span class="text-xs bg-primary-600 rounded-full text-white px-4 py-1.5 mr-3">New</span>
                            <span class="text-sm font-medium">Flowbite is out! See what's new</span>
                            <svg class="ml-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a> --}}
                        <h1
                            class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                            {{__('word.welcome')}}
                        </h1>
                        <p
                            class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">
                            {{__('motto')}}
                        </p>
                        <div
                            class="flex flex-col mb-8 lg:mb-16 space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
                            <a href="{{route('kbm.index')}}"
                                class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-amber-700 hover:bg-amber-800 focus:ring-4 focus:ring-amber-300 dark:focus:ring-amber-900">
                                Lihat Jadwal Kelas
                                <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                            {{-- <a href="#"
                                class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-gray-900 rounded-lg border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                                <svg class="mr-2 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z">
                                    </path>
                                </svg>
                                Watch video
                            </a> --}}
                        </div>

                        @inject('ctr', 'App\Http\Controllers\DashboardController')
                        <div class="mb-6">
                            <div class="flex flex-wrap">
                                <div
                                    class="w-1/3 p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                                    <div class="flex items-center justify-between mb-4">
                                        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">
                                            Statistik Kelas Keseluruhan
                                        </h5>
                                        <!-- <a href="#"
                                            class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                                            View all
                                        </a> -->
                                    </div>
                                    <div class="flow-root">
                                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                            <li class="py-3 sm:py-4">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0">
                                                        <svg class="w-6 h-6 text-gray-800 dark:text-white"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" fill="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd"
                                                                d="M6 2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 1 0 0-2h-2v-2h2a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2h-8v16h5v2H7a1 1 0 1 1 0-2h1V2H6Z"
                                                                clip-rule="evenodd" />
                                                        </svg>

                                                    </div>
                                                    <div class="flex-1 min-w-0 ms-4">
                                                        <p
                                                            class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                            Kelas Terlaksana
                                                        </p>
                                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                            Keseluruhan
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                        {{$ctr->getClasses('CONDUCTED')}} kelas
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="py-3 sm:py-4">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0">
                                                        <svg class="w-6 h-6 text-gray-800 dark:text-white"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" fill="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd"
                                                                d="M6 2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 1 0 0-2h-2v-2h2a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2h-8v16h5v2H7a1 1 0 1 1 0-2h1V2H6Z"
                                                                clip-rule="evenodd" />
                                                        </svg>

                                                    </div>
                                                    <div class="flex-1 min-w-0 ms-4">
                                                        <p
                                                            class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                            Kelas Menunggu Konfirmasi
                                                        </p>
                                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                            Keseluruhan
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                        {{$ctr->getClasses('NEEDCONFIRMATION')}} kelas
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="py-3 sm:py-4">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0">
                                                        <svg class="w-6 h-6 text-gray-800 dark:text-white"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" fill="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd"
                                                                d="M6 2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 1 0 0-2h-2v-2h2a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2h-8v16h5v2H7a1 1 0 1 1 0-2h1V2H6Z"
                                                                clip-rule="evenodd" />
                                                        </svg>

                                                    </div>
                                                    <div class="flex-1 min-w-0 ms-4">
                                                        <p
                                                            class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                            Kelas Dibatalkan
                                                        </p>
                                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                            Keseluruhan
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                        {{$ctr->getClasses('CANCELLED')}} kelas
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="py-3 sm:py-4">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0">
                                                        <svg class="w-6 h-6 text-gray-800 dark:text-white"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" fill="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd"
                                                                d="M6 2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 1 0 0-2h-2v-2h2a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2h-8v16h5v2H7a1 1 0 1 1 0-2h1V2H6Z"
                                                                clip-rule="evenodd" />
                                                        </svg>

                                                    </div>
                                                    <div class="flex-1 min-w-0 ms-4">
                                                        <p
                                                            class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                            Kelas Menunggu Pelaksanaan
                                                        </p>
                                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                            Keseluruhan
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                        {{$ctr->getClasses('WAITING')}} kelas
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div
                                    class="w-1/3 p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                                    <div class="flex items-center justify-between mb-4">
                                        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">
                                            Statistik Kelas Periode Ini
                                        </h5>
                                        <!-- <a href="#"
                                            class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                                            View all
                                        </a> -->
                                    </div>
                                    <div class="flow-root">
                                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                            <li class="py-3 sm:py-4">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0">
                                                        <svg class="w-6 h-6 text-gray-800 dark:text-white"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" fill="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd"
                                                                d="M6 2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 1 0 0-2h-2v-2h2a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2h-8v16h5v2H7a1 1 0 1 1 0-2h1V2H6Z"
                                                                clip-rule="evenodd" />
                                                        </svg>

                                                    </div>
                                                    <div class="flex-1 min-w-0 ms-4">
                                                        <p
                                                            class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                            Kelas Terlaksana
                                                        </p>
                                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                            Keseluruhan
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                        {{$ctr->getPeriodClasses('CONDUCTED')}} kelas
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="py-3 sm:py-4">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0">
                                                        <svg class="w-6 h-6 text-gray-800 dark:text-white"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" fill="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd"
                                                                d="M6 2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 1 0 0-2h-2v-2h2a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2h-8v16h5v2H7a1 1 0 1 1 0-2h1V2H6Z"
                                                                clip-rule="evenodd" />
                                                        </svg>

                                                    </div>
                                                    <div class="flex-1 min-w-0 ms-4">
                                                        <p
                                                            class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                            Kelas Menunggu Konfirmasi
                                                        </p>
                                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                            Keseluruhan
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                        {{$ctr->getPeriodClasses('NEEDCONFIRMATION')}} kelas
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="py-3 sm:py-4">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0">
                                                        <svg class="w-6 h-6 text-gray-800 dark:text-white"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" fill="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd"
                                                                d="M6 2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 1 0 0-2h-2v-2h2a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2h-8v16h5v2H7a1 1 0 1 1 0-2h1V2H6Z"
                                                                clip-rule="evenodd" />
                                                        </svg>

                                                    </div>
                                                    <div class="flex-1 min-w-0 ms-4">
                                                        <p
                                                            class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                            Kelas Dibatalkan
                                                        </p>
                                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                            Keseluruhan
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                        {{$ctr->getPeriodClasses('CANCELLED')}} kelas
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="py-3 sm:py-4">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0">
                                                        <svg class="w-6 h-6 text-gray-800 dark:text-white"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" fill="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd"
                                                                d="M6 2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 1 0 0-2h-2v-2h2a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2h-8v16h5v2H7a1 1 0 1 1 0-2h1V2H6Z"
                                                                clip-rule="evenodd" />
                                                        </svg>

                                                    </div>
                                                    <div class="flex-1 min-w-0 ms-4">
                                                        <p
                                                            class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                            Kelas Menunggu Pelaksanaan
                                                        </p>
                                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                            Keseluruhan
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                        {{$ctr->getPeriodClasses('WAITING')}} kelas
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="shrink-0"></div>

                                <div
                                    class="w-1/3 p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                                    <div class="flex items-center justify-between mb-4">
                                        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">
                                            Statistik Keuangan Keseluruhan
                                        </h5>
                                        <!-- <a href="#"
                                            class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                                            View all
                                        </a> -->
                                    </div>
                                    <div class="flow-root">
                                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                            <li class="py-3 sm:py-4">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0">
                                                        <svg class="w-6 h-6 text-gray-800 dark:text-white"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" fill="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd"
                                                                d="M6 2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 1 0 0-2h-2v-2h2a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2h-8v16h5v2H7a1 1 0 1 1 0-2h1V2H6Z"
                                                                clip-rule="evenodd" />
                                                        </svg>

                                                    </div>
                                                    <div class="flex-1 min-w-0 ms-4">
                                                        <p
                                                            class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                            Pendapatan Kotor Kelas
                                                        </p>
                                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                            Keseluruhan
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                        Rp.{{number_format($ctr->getFinance('GROSSPROFIT'), 2, ',',
                                                        '.')}}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="py-3 sm:py-4">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0">
                                                        <svg class="w-6 h-6 text-gray-800 dark:text-white"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" fill="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd"
                                                                d="M6 2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 1 0 0-2h-2v-2h2a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2h-8v16h5v2H7a1 1 0 1 1 0-2h1V2H6Z"
                                                                clip-rule="evenodd" />
                                                        </svg>

                                                    </div>
                                                    <div class="flex-1 min-w-0 ms-4">
                                                        <p
                                                            class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                            Dana Diteruskan Ke Tutor
                                                        </p>
                                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                            Keseluruhan
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                        Rp.{{number_format($ctr->getFinance('TUTORPAYMENT'), 2, ',',
                                                        '.')}}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="py-3 sm:py-4">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0">
                                                        <svg class="w-6 h-6 text-gray-800 dark:text-white"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" fill="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd"
                                                                d="M6 2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 1 0 0-2h-2v-2h2a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2h-8v16h5v2H7a1 1 0 1 1 0-2h1V2H6Z"
                                                                clip-rule="evenodd" />
                                                        </svg>

                                                    </div>
                                                    <div class="flex-1 min-w-0 ms-4">
                                                        <p
                                                            class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                            Pendapatan Bersih Kelas
                                                        </p>
                                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                            Keseluruhan
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                        Rp.{{number_format($ctr->getFinance('NETPROFIT'), 2, ',', '.')}}
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div
                                    class="w-1/3 p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                                    <div class="flex items-center justify-between mb-4">
                                        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">
                                            Statistik Keuangan Periode Ini
                                        </h5>
                                        <!-- <a href="#"
                                            class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                                            View all
                                        </a> -->
                                    </div>
                                    <div class="flow-root">
                                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                            <!-- PERIOD -->
                                            <li class="py-3 sm:py-4">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0">
                                                        <svg class="w-6 h-6 text-gray-800 dark:text-white"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" fill="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd"
                                                                d="M6 2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 1 0 0-2h-2v-2h2a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2h-8v16h5v2H7a1 1 0 1 1 0-2h1V2H6Z"
                                                                clip-rule="evenodd" />
                                                        </svg>

                                                    </div>
                                                    <div class="flex-1 min-w-0 ms-4">
                                                        <p
                                                            class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                            Pendapatan Kotor Kelas
                                                        </p>
                                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                            Periode {{now()->format('F Y')}}
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                        Rp.{{number_format($ctr->getFinance('GROSSPROFITPERIOD'), 2,
                                                        ',', '.')}}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="py-3 sm:py-4">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0">
                                                        <svg class="w-6 h-6 text-gray-800 dark:text-white"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" fill="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd"
                                                                d="M6 2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 1 0 0-2h-2v-2h2a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2h-8v16h5v2H7a1 1 0 1 1 0-2h1V2H6Z"
                                                                clip-rule="evenodd" />
                                                        </svg>

                                                    </div>
                                                    <div class="flex-1 min-w-0 ms-4">
                                                        <p
                                                            class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                            Dana Diteruskan Ke Tutor
                                                        </p>
                                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                            Periode {{now()->format('F Y')}}
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                        Rp.{{number_format($ctr->getFinance('TUTORPAYMENTPERIOD'), 2,
                                                        ',', '.')}}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="py-3 sm:py-4">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0">
                                                        <svg class="w-6 h-6 text-gray-800 dark:text-white"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" fill="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd"
                                                                d="M6 2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 1 0 0-2h-2v-2h2a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2h-8v16h5v2H7a1 1 0 1 1 0-2h1V2H6Z"
                                                                clip-rule="evenodd" />
                                                        </svg>

                                                    </div>
                                                    <div class="flex-1 min-w-0 ms-4">
                                                        <p
                                                            class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                            Pendapatan Bersih Kelas
                                                        </p>
                                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                            Periode {{now()->format('F Y')}}
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                        Rp.{{number_format($ctr->getFinance('NETPROFITPERIOD'), 2, ',',
                                                        '.')}}
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div
                                    class="w-1/3 p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                                    <div class="flex items-center justify-between mb-4">
                                        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">
                                            Statistik Keuangan Periode Sebelumnya
                                        </h5>
                                        <!-- <a href="#"
                                            class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                                            View all
                                        </a> -->
                                    </div>
                                    <div class="flow-root">
                                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                            <li class="py-3 sm:py-4">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0">
                                                        <svg class="w-6 h-6 text-gray-800 dark:text-white"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" fill="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd"
                                                                d="M6 2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 1 0 0-2h-2v-2h2a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2h-8v16h5v2H7a1 1 0 1 1 0-2h1V2H6Z"
                                                                clip-rule="evenodd" />
                                                        </svg>

                                                    </div>
                                                    <div class="flex-1 min-w-0 ms-4">
                                                        <p
                                                            class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                            Pendapatan Kotor Kelas
                                                        </p>
                                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                            Periode {{now()->subMonthNoOverflow()->format('F Y')}}
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                        Rp.{{number_format($ctr->getFinance('LASTGROSSPROFIT'), 2, ',',
                                                        '.')}}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="py-3 sm:py-4">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0">
                                                        <svg class="w-6 h-6 text-gray-800 dark:text-white"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" fill="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd"
                                                                d="M6 2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 1 0 0-2h-2v-2h2a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2h-8v16h5v2H7a1 1 0 1 1 0-2h1V2H6Z"
                                                                clip-rule="evenodd" />
                                                        </svg>

                                                    </div>
                                                    <div class="flex-1 min-w-0 ms-4">
                                                        <p
                                                            class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                            Dana Diteruskan Ke Tutor
                                                        </p>
                                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                            Periode {{now()->subMonthNoOverflow()->format('F Y')}}
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                        Rp.{{number_format($ctr->getFinance('LASTTUTORPAYMENT'), 2, ',',
                                                        '.')}}
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="py-3 sm:py-4">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0">
                                                        <svg class="w-6 h-6 text-gray-800 dark:text-white"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" fill="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd"
                                                                d="M6 2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 1 0 0-2h-2v-2h2a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2h-8v16h5v2H7a1 1 0 1 1 0-2h1V2H6Z"
                                                                clip-rule="evenodd" />
                                                        </svg>

                                                    </div>
                                                    <div class="flex-1 min-w-0 ms-4">
                                                        <p
                                                            class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                            Pendapatan Bersih Kelas
                                                        </p>
                                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                            Periode {{now()->subMonthNoOverflow()->format('F Y')}}
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                        Rp.{{number_format($ctr->getFinance('LASTNETPROFIT'), 2, ',',
                                                        '.')}}
                                                    </div>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 mx-auto text-center md:max-w-screen-md lg:max-w-screen-lg lg:px-36">
                            <span class="font-semibold text-gray-400">Belajar Dulu, Menginspirasi Kemudian!
                                <br>
                                Cek juga
                            </span>
                            <div
                                class="flex flex-wrap justify-center items-center mt-8 text-gray-500 sm:justify-between">
                                <a href="https://kasi.web.id"
                                    class="flex items-center mr-5 mb-5 lg:mb-0 hover:text-gray-800 dark:hover:text-gray-400">
                                    <svg class="w-8 h-8 text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                        <path
                                            d="M9 1.334C7.06.594 1.646-.84.293.653a1.158 1.158 0 0 0-.293.77v13.973c0 .193.046.383.134.55.088.167.214.306.366.403a.932.932 0 0 0 .5.147c.176 0 .348-.05.5-.147 1.059-.32 6.265.851 7.5 1.65V1.334ZM19.707.653C18.353-.84 12.94.593 11 1.333V18c1.234-.799 6.436-1.968 7.5-1.65a.931.931 0 0 0 .5.147.931.931 0 0 0 .5-.148c.152-.096.279-.235.366-.403.088-.167.134-.357.134-.55V1.423a1.158 1.158 0 0 0-.293-.77Z" />
                                    </svg>
                                    <p class="pl-2">
                                        Blog eduKASI
                                    </p>
                                </a>

                            </div>
                        </div>
                    </div>
                </section>
                @elseif (auth()->user()->isTutor())
                <section class="bg-white dark:bg-gray-900">
                    <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12">
                        {{-- <a href="#"
                            class="inline-flex justify-between items-center py-1 px-1 pr-4 mb-7 text-sm text-gray-700 bg-gray-100 rounded-full dark:bg-gray-800 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700"
                            role="alert">
                            <span class="text-xs bg-primary-600 rounded-full text-white px-4 py-1.5 mr-3">New</span>
                            <span class="text-sm font-medium">Flowbite is out! See what's new</span>
                            <svg class="ml-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a> --}}
                        <h1
                            class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                            {{__('word.welcome')}}
                        </h1>
                        <p
                            class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">
                            {{__('motto')}}
                        </p>
                        <div
                            class="flex flex-col mb-8 lg:mb-16 space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
                            <a href="{{route('tutor.classes')}}"
                                class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-amber-700 hover:bg-amber-800 focus:ring-4 focus:ring-amber-300 dark:focus:ring-amber-900">
                                Lihat Jadwal Kelas
                                <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                            {{-- <a href="#"
                                class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-gray-900 rounded-lg border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                                <svg class="mr-2 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z">
                                    </path>
                                </svg>
                                Watch video
                            </a> --}}
                        </div>
                        <div class="px-4 mx-auto text-center md:max-w-screen-md lg:max-w-screen-lg lg:px-36">
                            <span class="font-semibold text-gray-400">Belajar Dulu, Menginspirasi Kemudian!
                                <br>
                                Cek juga
                            </span>
                            <div
                                class="flex flex-wrap justify-center items-center mt-8 text-gray-500 sm:justify-between">
                                <a href="https://kasi.web.id"
                                    class="flex items-center mr-5 mb-5 lg:mb-0 hover:text-gray-800 dark:hover:text-gray-400">
                                    <svg class="w-8 h-8 text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                        <path
                                            d="M9 1.334C7.06.594 1.646-.84.293.653a1.158 1.158 0 0 0-.293.77v13.973c0 .193.046.383.134.55.088.167.214.306.366.403a.932.932 0 0 0 .5.147c.176 0 .348-.05.5-.147 1.059-.32 6.265.851 7.5 1.65V1.334ZM19.707.653C18.353-.84 12.94.593 11 1.333V18c1.234-.799 6.436-1.968 7.5-1.65a.931.931 0 0 0 .5.147.931.931 0 0 0 .5-.148c.152-.096.279-.235.366-.403.088-.167.134-.357.134-.55V1.423a1.158 1.158 0 0 0-.293-.77Z" />
                                    </svg>
                                    <p class="pl-2">
                                        Blog eduKASI
                                    </p>
                                </a>

                            </div>
                        </div>
                    </div>
                </section>
                @elseif (auth()->user()->isStudent())
                <section class="bg-white dark:bg-gray-900">
                    <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12">
                        {{-- <a href="#"
                            class="inline-flex justify-between items-center py-1 px-1 pr-4 mb-7 text-sm text-gray-700 bg-gray-100 rounded-full dark:bg-gray-800 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700"
                            role="alert">
                            <span class="text-xs bg-primary-600 rounded-full text-white px-4 py-1.5 mr-3">New</span>
                            <span class="text-sm font-medium">Flowbite is out! See what's new</span>
                            <svg class="ml-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a> --}}
                        <h1
                            class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                            {{__('word.welcome')}}
                        </h1>
                        <p
                            class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">
                            {{__('motto')}}
                        </p>
                        <div
                            class="flex flex-col mb-8 lg:mb-16 space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
                            <a href="{{route('student.classes')}}"
                                class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-amber-700 hover:bg-amber-800 focus:ring-4 focus:ring-amber-300 dark:focus:ring-amber-900">
                                {{__('see.class.schedule')}}
                                <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                            {{-- <a href="#"
                                class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-gray-900 rounded-lg border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                                <svg class="mr-2 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z">
                                    </path>
                                </svg>
                                Watch video
                            </a> --}}
                        </div>
                        <div class="px-4 mx-auto text-center md:max-w-screen-md lg:max-w-screen-lg lg:px-36">
                            <span class="font-semibold text-gray-400">Belajar Dulu, Menginspirasi Kemudian!
                                <br>
                                {{__('See Also')}}
                            </span>
                            <div
                                class="flex flex-wrap justify-center items-center mt-8 text-gray-500 sm:justify-between">
                                <a href="https://kasi.web.id"
                                    class="flex items-center mr-5 mb-5 lg:mb-0 hover:text-gray-800 dark:hover:text-gray-400">
                                    <svg class="w-8 h-8 text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                        <path
                                            d="M9 1.334C7.06.594 1.646-.84.293.653a1.158 1.158 0 0 0-.293.77v13.973c0 .193.046.383.134.55.088.167.214.306.366.403a.932.932 0 0 0 .5.147c.176 0 .348-.05.5-.147 1.059-.32 6.265.851 7.5 1.65V1.334ZM19.707.653C18.353-.84 12.94.593 11 1.333V18c1.234-.799 6.436-1.968 7.5-1.65a.931.931 0 0 0 .5.147.931.931 0 0 0 .5-.148c.152-.096.279-.235.366-.403.088-.167.134-.357.134-.55V1.423a1.158 1.158 0 0 0-.293-.77Z" />
                                    </svg>
                                    <p class="pl-2">
                                        Blog eduKASI
                                    </p>
                                </a>

                            </div>
                        </div>
                    </div>
                </section>
                @elseif (auth()->user()->isGuardian())
                <section class="bg-white dark:bg-gray-900">
                    <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12">
                        {{-- <a href="#"
                            class="inline-flex justify-between items-center py-1 px-1 pr-4 mb-7 text-sm text-gray-700 bg-gray-100 rounded-full dark:bg-gray-800 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700"
                            role="alert">
                            <span class="text-xs bg-primary-600 rounded-full text-white px-4 py-1.5 mr-3">New</span>
                            <span class="text-sm font-medium">Flowbite is out! See what's new</span>
                            <svg class="ml-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a> --}}
                        <h1
                            class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                            {{__('word.welcome')}}
                        </h1>
                        <p
                            class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">
                            {{__('motto')}}
                        </p>
                        <div
                            class="flex flex-col mb-8 lg:mb-16 space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
                            <a href="{{route('guardian.classes')}}"
                                class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-amber-700 hover:bg-amber-800 focus:ring-4 focus:ring-amber-300 dark:focus:ring-amber-900">
                                Lihat Jadwal Kelas
                                <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                            {{-- <a href="#"
                                class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-gray-900 rounded-lg border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                                <svg class="mr-2 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z">
                                    </path>
                                </svg>
                                Watch video
                            </a> --}}
                        </div>
                        <div class="px-4 mx-auto text-center md:max-w-screen-md lg:max-w-screen-lg lg:px-36">
                            <span class="font-semibold text-gray-400">Belajar Dulu, Menginspirasi Kemudian!
                                <br>
                                Cek juga
                            </span>
                            <div
                                class="flex flex-wrap justify-center items-center mt-8 text-gray-500 sm:justify-between">
                                <a href="https://kasi.web.id"
                                    class="flex items-center mr-5 mb-5 lg:mb-0 hover:text-gray-800 dark:hover:text-gray-400">
                                    <svg class="w-8 h-8 text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                        <path
                                            d="M9 1.334C7.06.594 1.646-.84.293.653a1.158 1.158 0 0 0-.293.77v13.973c0 .193.046.383.134.55.088.167.214.306.366.403a.932.932 0 0 0 .5.147c.176 0 .348-.05.5-.147 1.059-.32 6.265.851 7.5 1.65V1.334ZM19.707.653C18.353-.84 12.94.593 11 1.333V18c1.234-.799 6.436-1.968 7.5-1.65a.931.931 0 0 0 .5.147.931.931 0 0 0 .5-.148c.152-.096.279-.235.366-.403.088-.167.134-.357.134-.55V1.423a1.158 1.158 0 0 0-.293-.77Z" />
                                    </svg>
                                    <p class="pl-2">
                                        Blog eduKASI
                                    </p>
                                </a>

                            </div>
                        </div>
                    </div>
                </section>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>