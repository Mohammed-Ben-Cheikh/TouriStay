<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-900">Create your account</h2>
            <p class="text-sm text-gray-600 mt-2">Start your journey with us today</p>
        </div>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <div class="space-y-2">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="space-y-2">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="space-y-2">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="space-y-2">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />
                            <div class="ms-2 text-sm text-gray-600">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="text-sm text-indigo-600 hover:text-indigo-500">'.__('Terms of Service').'</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="text-sm text-indigo-600 hover:text-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <x-button class="w-full justify-center">
                {{ __('Register') }}
            </x-button>

            <p class="text-center text-sm text-gray-600">
                {{ __('Already registered?') }}
                <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                    {{ __('Sign in instead') }}
                </a>
            </p>
        </form>
    </x-authentication-card>
</x-guest-layout>
