<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-36 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="p-2 bg-[#056839] absolute text-center" style="color: white;top:0; right:0; left:0; font-weight: bold; font-size: 24px;">MOA Data Sharing Platform</div>
        <div class="mb-6" style="visibility: hidden;">MOA Data Sharing Platform</div>
        <div class="p-5 text-center" style="color: #056839; font-weight: bold; font-size: 32px;">Sign in</div>
        <form method="POST" action="{{ route('login') }}" class="mt-3 px-5">
            @csrf

            <!-- Username -->
            <div>
                <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" 
                placeholder="Username"
                required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-8">
                <x-input id="password" class="block mt-1 w-full"
                placeholder="Password"
                type="password"
                name="password"
                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-yellow text-green shadow-sm focus:border-green focus:ring focus:ring-yellow focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-center mt-4">
                <x-button class="block w-full">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
