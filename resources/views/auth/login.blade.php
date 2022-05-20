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

        <div class="p-2 bg-[#056839] text-center" style="color: white;font-weight: bold; font-size: 24px;">MOA Data
            Share</div>
        <div class="md:px-12">
            <div class="p-5 text-center" style="color: #056839; font-weight: bold; font-size: 32px;">Sign in</div>
            <form method="POST" action="{{ route('login') }}" class="mt-3 px-5">
                @csrf

                <!-- Username -->
                <div>
                    <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')"
                        placeholder="Username" required autofocus />
                </div>

                <!-- Password -->
                <div class="mt-8">
                    <x-input id="password" class="block mt-1 w-full" placeholder="Password" type="password"
                        name="password" required autocomplete="current-password" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-yellow text-green shadow-sm focus:border-green focus:ring focus:ring-yellow focus:ring-opacity-50"
                            name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-center mt-4">
                    <x-button class="block w-full">
                        {{ __('Log in') }}
                    </x-button>
                </div>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
<script>
    let getRememberMeState = localStorage.getItem('rememberMe');
    let getUsername = localStorage.getItem('username');
    let rememberMeBtn = document.getElementById('remember_me');
    let usernameInput = document.getElementById('username');
    let passwordInput = document.getElementById('password')
    if (getRememberMeState && getRememberMeState == 'check') {
        rememberMeBtn.checked = true;
        if (usernameInput) {
            usernameInput.value = getUsername;
            passwordInput.focus();
        }
    }

    rememberMeBtn.addEventListener('change', function() {
        if (this.checked) {
            localStorage.setItem('rememberMe', 'check');
            localStorage.setItem('username', usernameInput.value)
        } else {
            localStorage.removeItem('rememberMe')
            localStorage.removeItem('username')
        }
    })
    usernameInput.addEventListener('input', function() {
        if (rememberMeBtn.checked) {
            localStorage.setItem('username', this.value)
        }
    })
</script>
