<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-400">{{ __('Email') }}</label>
            <input id="email" class="block mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:focus:ring-gray-600" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username">
            @error('email')
                <span class="text-red-600 mt-2 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="block font-medium text-sm text-gray-700 dark:text-gray-400">{{ __('Password') }}</label>
            <input id="password" class="block mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:focus:ring-gray-600" type="password" name="password" required autocomplete="new-password">
            @error('password')
                <span class="text-red-600 mt-2 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation" class="block font-medium text-sm text-gray-700 dark:text-gray-400">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" class="block mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:focus:ring-gray-600" type="password" name="password_confirmation" required autocomplete="new-password">
            @error('password_confirmation')
                <span class="text-red-600 mt-2 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-500 disabled:opacity-25 transition">{{ __('Reset Password') }}</button>
        </div>
    </form>
</x-guest-layout>
