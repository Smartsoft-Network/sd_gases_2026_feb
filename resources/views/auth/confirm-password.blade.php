<x-guest-layout>
    <div class="p-8">
        <!-- Heading -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Confirm Password</h2>
            <p class="text-gray-600 mt-2">{{ __('This is a secure area of the application. Please confirm your password before continuing.') }}</p>
        </div>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div class="mb-8">
                <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />
                <x-text-input id="password" class="mt-2 w-full px-4 py-3 rounded-xl border border-gray-200/50 bg-white/60 backdrop-blur-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <x-primary-button class="w-full py-3 px-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300">
                {{ __('Confirm') }}
            </x-primary-button>
        </form>
    </div>
</x-guest-layout>
