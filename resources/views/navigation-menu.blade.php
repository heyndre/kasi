<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 z-20 top-0 sticky">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('root') }}">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @if (auth()->user()->role == 'ADMIN' || auth()->user()->role == 'SUPERADMIN')
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <!-- Settings Dropdown -->
                        <div class="ms-3 relative">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-gray-900 bg-white hover:text-gray-700 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                            Keuangan
                                            <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </span>
                                </x-slot>

                                <x-slot name="content">
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Billing
                                    </div>
                                    <x-dropdown-link href="{{ route('payment.student.billing') }}">
                                        Daftar Billing
                                    </x-dropdown-link>

                                    <x-dropdown-link href="{{ route('profile.show') }}">
                                        {{ __('Konfirmasi Pembayaran') }}
                                    </x-dropdown-link>

                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Pembayaran
                                    </div>

                                    <x-dropdown-link href="{{ route('profile.show') }}">
                                        {{ __('Status Pembayaran') }}
                                    </x-dropdown-link>

                                    <x-dropdown-link href="{{ route('profile.show') }}">
                                        {{ __('Konfirmasi Pembayaran') }}
                                    </x-dropdown-link>

                                    <div class="border-t border-gray-200"></div>

                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Internal') }}
                                    </div>

                                    <x-dropdown-link href="{{ route('profile.show') }}">
                                        {{ __('Status Keuangan') }}
                                    </x-dropdown-link>

                                    <x-dropdown-link href="{{ route('profile.show') }}">
                                        {{ __('Transaksi') }}
                                    </x-dropdown-link>


                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <div class="ms-3 relative">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-gray-900 bg-white hover:text-gray-700 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                            KBM
                                            <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </span>
                                </x-slot>

                                <x-slot name="content">
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Pembelajaran') }}
                                    </div>

                                    <x-dropdown-link href="{{ route('kbm.index') }}">
                                        {{ __('Jadwal Kelas') }}
                                    </x-dropdown-link>

                                    <x-dropdown-link href="{{ route('kbm.billing.status') }}">
                                        Status Billing Kelas
                                    </x-dropdown-link>

                                    <x-dropdown-link href="{{ route('profile.show') }}">
                                        {{ __('Laporan Kelas') }}
                                    </x-dropdown-link>
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Penjadwalan
                                    </div>

                                    <x-dropdown-link href="{{ route('kbm.add') }}">
                                        Jadwalkan Kelas
                                    </x-dropdown-link>

                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Evaluasi') }}
                                    </div>

                                    <x-dropdown-link href="{{ route('profile.show') }}">
                                        {{ __('Jadwal Evaluasi') }}
                                    </x-dropdown-link>

                                    <x-dropdown-link href="{{ route('profile.show') }}">
                                        {{ __('Status Evaluasi') }}
                                    </x-dropdown-link>

                                    <div class="border-t border-gray-200"></div>

                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <div class="ms-3 relative">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-gray-900 bg-white hover:text-gray-700 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                            Murid
                                            <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </span>
                                </x-slot>

                                <x-slot name="content">
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Daftar Murid
                                    </div>

                                    <x-dropdown-link href="{{ route('student.active') }}" wire:navigate>
                                        {{ __('Daftar Murid Aktif') }}
                                    </x-dropdown-link>

                                    <x-dropdown-link href="{{ route('student.inactive') }}" wire:navigate>
                                        {{ __('Daftar Murid Inaktif') }}
                                    </x-dropdown-link>

                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Wali Murid
                                    </div>

                                    <x-dropdown-link href="{{ route('guardian.index') }}" wire:navigate>
                                        Daftar Wali Murid
                                    </x-dropdown-link>

                                    
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Registrasi
                                    </div>
                                    
                                    <x-dropdown-link href="{{ route('guardian.register') }}" wire:navigate>
                                        Registrasi Wali Murid
                                    </x-dropdown-link>
                                    <x-dropdown-link href="{{ route('student.register') }}">
                                        {{ __('Registrasi') }}
                                    </x-dropdown-link>

                                    <x-dropdown-link href="{{ route('student.birthday') }}" wire:navigate>
                                        {{ __('Kalender Ulang Tahun') }}
                                    </x-dropdown-link>

                                    <div class="border-t border-gray-200"></div>

                                </x-slot>
                            </x-dropdown>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <div class="ms-3 relative">
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <span class="inline-flex rounded-md">
                                            <button type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-gray-900 bg-white hover:text-gray-700 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                Tutor
                                                <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </button>
                                        </span>
                                    </x-slot>

                                    <x-slot name="content">
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Daftar Tutor') }}
                                        </div>
                                        <x-dropdown-link href="{{ route('tutor.active') }}">
                                            {{ __('Daftar Tutor Aktif') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link href="{{ route('tutor.inactive') }}">
                                            {{ __('Daftar Tutor Inaktif') }}
                                        </x-dropdown-link>

                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Manajemen Tutor') }}
                                        </div>
                                        <x-dropdown-link href="{{ route('tutor.register') }}">
                                            {{ __('Registrasi Tutor') }}
                                        </x-dropdown-link>

                                        <div class="border-t border-gray-200"></div>

                                    </x-slot>
                                </x-dropdown>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if (auth()->user()->role == 'TUTOR')
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <!-- Settings Dropdown -->
                        <div class="ms-3 relative">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-gray-900 bg-white hover:text-gray-700 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                            Keuangan
                                            <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </span>
                                </x-slot>

                                <x-slot name="content">
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Billing
                                    </div>
                                    <x-dropdown-link href="{{ route('payment.student.billing') }}">
                                        Daftar Billing
                                    </x-dropdown-link>

                                    <x-dropdown-link href="{{ route('profile.show') }}">
                                        {{ __('Konfirmasi Pembayaran') }}
                                    </x-dropdown-link>

                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Pembayaran
                                    </div>

                                    <x-dropdown-link href="{{ route('profile.show') }}">
                                        Status Pembayaran Saya
                                    </x-dropdown-link>

                                    <x-dropdown-link href="{{ route('profile.show') }}">
                                        Konfirmasi Penerimaan Pembayaran
                                    </x-dropdown-link>

                                    <div class="border-t border-gray-200"></div>

                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Internal') }}
                                    </div>

                                    <x-dropdown-link href="{{ route('profile.show') }}">
                                        {{ __('Status Keuangan') }}
                                    </x-dropdown-link>

                                    <x-dropdown-link href="{{ route('profile.show') }}">
                                        {{ __('Transaksi') }}
                                    </x-dropdown-link>


                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <div class="ms-3 relative">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-gray-900 bg-white hover:text-gray-700 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                            KBM
                                            <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </span>
                                </x-slot>

                                <x-slot name="content">
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Pembelajaran') }}
                                    </div>

                                    <x-dropdown-link href="{{ route('tutor.classes') }}">
                                        Jadwal Kelas Saya
                                    </x-dropdown-link>

                                    <x-dropdown-link href="{{ route('kbm.billing.status') }}">
                                        Status Billing Kelas
                                    </x-dropdown-link>

                                    <x-dropdown-link href="{{ route('profile.show') }}">
                                        {{ __('Laporan Kelas') }}
                                    </x-dropdown-link>
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Penjadwalan
                                    </div>

                                    <x-dropdown-link href="{{ route('kbm.add') }}">
                                        Jadwalkan Kelas
                                    </x-dropdown-link>

                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Evaluasi') }}
                                    </div>

                                    <x-dropdown-link href="{{ route('profile.show') }}">
                                        {{ __('Jadwal Evaluasi') }}
                                    </x-dropdown-link>

                                    <x-dropdown-link href="{{ route('profile.show') }}">
                                        {{ __('Status Evaluasi') }}
                                    </x-dropdown-link>

                                    <div class="border-t border-gray-200"></div>

                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <div class="ms-3 relative">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-gray-900 bg-white hover:text-gray-700 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                            Murid
                                            <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </span>
                                </x-slot>

                                <x-slot name="content">
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Daftar Murid
                                    </div>

                                    <x-dropdown-link href="{{ route('student.active') }}" wire:navigate>
                                        Daftar Murid Saya
                                    </x-dropdown-link>

                                    <x-dropdown-link href="{{ route('student.inactive') }}" wire:navigate>
                                        Daftar Murid Inaktif
                                    </x-dropdown-link>

                                    <div class="border-t border-gray-200"></div>

                                </x-slot>
                            </x-dropdown>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <div class="ms-3 relative">
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <span class="inline-flex rounded-md">
                                            <button type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-gray-900 bg-white hover:text-gray-700 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                Tutor
                                                <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </button>
                                        </span>
                                    </x-slot>

                                    <x-slot name="content">
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Daftar Tutor') }}
                                        </div>
                                        <x-dropdown-link href="{{ route('tutor.active') }}">
                                            {{ __('Daftar Tutor Aktif') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link href="{{ route('tutor.inactive') }}">
                                            {{ __('Daftar Tutor Inaktif') }}
                                        </x-dropdown-link>

                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Manajemen Tutor') }}
                                        </div>
                                        <x-dropdown-link href="{{ route('tutor.register') }}">
                                            {{ __('Registrasi Tutor') }}
                                        </x-dropdown-link>

                                        <div class="border-t border-gray-200"></div>

                                    </x-slot>
                                </x-dropdown>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if (auth()->user()->role == 'MURID')
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <!-- Keuangan -->
                        <div class="ms-3 relative">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-gray-900 bg-white hover:text-gray-700 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                            Keuangan
                                            <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </span>
                                </x-slot>

                                <x-slot name="content">
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Billing & Pembayaran
                                    </div>
                                    <x-dropdown-link href="{{ route('student.billing.index') }}">
                                        Tagihan Saya
                                    </x-dropdown-link>

                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Bantuan
                                    </div>
                                    <x-dropdown-link target='_blank'
                                        href="https://wa.me/{{$setting->where('key','whatsapp')->value('value')}}?text=Halo%2C saya butuh bantuan tentang Portal KASI bagian Billing/Tagihan dan Pembayaran">
                                        Hubungi Admin KASI
                                    </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <!-- Keuangan -->
                        <div class="ms-3 relative">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-gray-900 bg-white hover:text-gray-700 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                            Kelas
                                            <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </span>
                                </x-slot>

                                <x-slot name="content">
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Jadwal
                                    </div>
                                    <x-dropdown-link href="{{ route('student.classes') }}">
                                        Jadwal Kelas Saya
                                    </x-dropdown-link>

                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Bantuan
                                    </div>
                                    <x-dropdown-link target='_blank'
                                        href="https://wa.me/{{$setting->where('key','whatsapp')->value('value')}}?text=Halo%2C saya butuh bantuan tentang Portal KASI bagian Kelas">
                                        Hubungi Admin KASI
                                    </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                    @endif
                </div>
            </div>



            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="60">
                        <x-slot name="trigger">
                            <span class="inline-flex rounded-md">
                                <button type="button"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                    {{ Auth::user()->currentTeam->name }}

                                    <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                    </svg>
                                </button>
                            </span>
                        </x-slot>

                        <x-slot name="content">
                            <div class="w-60">
                                <!-- Team Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Team') }}
                                </div>

                                <!-- Team Settings -->
                                <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                    {{ __('Team Settings') }}
                                </x-dropdown-link>

                                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                <x-dropdown-link href="{{ route('teams.create') }}">
                                    {{ __('Create New Team') }}
                                </x-dropdown-link>
                                @endcan

                                <!-- Team Switcher -->
                                @if (Auth::user()->allTeams()->count() > 1)
                                <div class="border-t border-gray-200"></div>

                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Switch Teams') }}
                                </div>

                                @foreach (Auth::user()->allTeams() as $team)
                                <x-switchable-team :team="$team" />
                                @endforeach
                                @endif
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>
                @endif

                <!-- Settings Dropdown -->
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button
                                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                <img class="h-8 w-8 rounded-full object-cover"
                                    src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                            @else
                            <span class="inline-flex rounded-md">
                                <button type="button"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                    {{ Auth::user()->name }}

                                    <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                            </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-dropdown-link href="{{ route('api.tokens') }}">
                                {{ __('API Tokens') }}
                            </x-dropdown-link>
                            @endif

                            <div class="border-t border-gray-200"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div class="shrink-0 me-3">
                    <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                        alt="{{ Auth::user()->name }}" />
                </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('API Tokens') }}
                </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                <div class="border-t border-gray-200"></div>

                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Manage Team') }}
                </div>

                <!-- Team Settings -->
                <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                    :active="request()->routeIs('teams.show')">
                    {{ __('Team Settings') }}
                </x-responsive-nav-link>

                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                    {{ __('Create New Team') }}
                </x-responsive-nav-link>
                @endcan

                <!-- Team Switcher -->
                @if (Auth::user()->allTeams()->count() > 1)
                <div class="border-t border-gray-200"></div>

                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Switch Teams') }}
                </div>

                @foreach (Auth::user()->allTeams() as $team)
                <x-switchable-team :team="$team" component="responsive-nav-link" />
                @endforeach
                @endif
                @endif
            </div>
        </div>
    </div>
</nav>