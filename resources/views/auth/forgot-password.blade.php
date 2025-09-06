<x-guest-layout>
    <!-- Welcome Header -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ __('Reset Password') }}</h1>
        <p class="text-gray-600">{{ __('Enter your email to receive reset instructions') }}</p>
    </div>

    <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-xl">
        <p class="text-sm text-blue-800 leading-relaxed">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-sm font-medium text-gray-700" />
            <x-text-input id="email" 
                         class="block mt-2 w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                         type="email" 
                         name="email" 
                         :value="old('email')" 
                         required 
                         autofocus
                         placeholder="Enter your email address" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Send Reset Link Button -->
        <div class="pt-4">
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:scale-[1.02]">
                {{ __('Send Reset Link') }}
            </button>
        </div>
    </form>

    <!-- Back to Login -->
    <div class="mt-8 text-center">
        <p class="text-sm text-gray-600">
            {{ __('Remember your password?') }}
            <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-800 transition-colors duration-200">
                {{ __('Back to login') }}
            </a>
        </p>
    </div>
</x-guest-layout>
