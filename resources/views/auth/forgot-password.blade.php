<x-guest-layout>
    <div class="p-8">
        <!-- Heading -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Reset Password</h2>
            <p class="text-gray-600 mt-2">{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-6">
                <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium" />
                <x-text-input id="email" class="mt-2 w-full px-4 py-3 rounded-xl border border-gray-200/50 bg-white/60 backdrop-blur-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <x-primary-button class="w-full py-3 px-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </form>
    </div>
</x-guest-layout>
