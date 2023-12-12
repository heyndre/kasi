<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <p class="mt-2 font-thin leading-strong">
            Selamat datang di Portal KASI. Silakan buat password untuk login ke dalam portal. 
        </p>
        <span class="font-light italic">
            Password harus terdiri dari minimal 8 karakter, dapat menggunakan huruf kapital/biasa dan dapat digabung dengan angka ataupun simbol.
        </span>
        <form method="POST" class="mt-4">
            @csrf
        
            <input type="hidden" name="email" value="{{ $user->email }}"/>
            <div>
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autofocus autocomplete="new-password" />
                @error('password')
                    <span>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>
            <div class="mt-2">
                <x-label for="password-confirm" value="{{ __('Konfirmasi Password') }}" />
                <x-input id="password-confirm" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                @error('password_confirmation')
                    <span>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>
        
            <div class="flex items-center justify-end mt-4">
                <x-button class="ms-4">
                    {{ __('Buat Password') }}
                </x-button>
            </div>
        </form>

        
    </x-authentication-card>
</x-guest-layout>

