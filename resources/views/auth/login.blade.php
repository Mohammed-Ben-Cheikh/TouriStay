<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-900">Welcome back</h2>
            <p class="text-sm text-gray-600 mt-2">Please sign in to your account</p>
        </div>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div class="space-y-2">
                <x-label for="email" value="{{ __('Email') }}" class="text-sm font-medium" />
                <x-input id="email" class="block w-full transition duration-150 ease-in-out" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="space-y-2">
                <x-label for="password" value="{{ __('Password') }}" class="text-sm font-medium" />
                <x-input id="password" class="block w-full transition duration-150 ease-in-out" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="flex items-center justify-between">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-indigo-600 hover:text-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <x-button class="w-full justify-center">
                {{ __('Sign in') }}
            </x-button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-600">
            {{ __('Don\'t have an account?') }}
            <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                {{ __('Sign up') }}
            </a>
        </p>
    </x-authentication-card>
</x-guest-layout>