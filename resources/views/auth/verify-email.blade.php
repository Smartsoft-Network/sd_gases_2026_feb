<x-guest-layout>
    <div class="p-8">
        <!-- Heading -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Verify Email Address</h2>
            <p class="text-gray-600 mt-2">{{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}</p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl">
                <p class="font-medium text-sm text-green-600">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </p>
            </div>
        @endif

        <div class="flex flex-col gap-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <x-primary-button class="w-full py-3 px-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300">
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-center text-sm font-medium text-gray-600 hover:text-gray-800 transition-colors duration-200">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
