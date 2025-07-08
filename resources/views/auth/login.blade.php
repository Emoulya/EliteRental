<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-forms.input-label for="email" :value="__('Email')" />
            <x-forms.text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autofocus autocomplete="username" />
            <x-forms.input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-forms.input-label for="password" :value="__('Password')" />

            <x-forms.text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-forms.input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded bg-white border-gray-300 text-gold shadow-sm focus:ring-gold focus:ring-offset-white"
                    name="remember">
                <span class="ms-2 text-sm text-gray-custom">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-grayCustom hover:text-gold rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-buttons.primary-button class="ms-3">
                {{ __('Log in') }}
            </x-buttons.primary-button>
        </div>
    </form>

    <div class="mt-4 text-center">
        <span class="text-sm text-gray-custom">
            {{ __("Don't have an account?") }}
            <a href="{{ route('register') }}" class="text-gold hover:underline">
                {{ __('Register') }}
            </a>
        </span>
    </div>
</x-guest-layout>
