@extends('layouts.master')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 xl:w-4/12">
            <div class="bg-white shadow-md rounded-lg px-6 py-4">
                <div class="text-lg font-semibold mb-4">{{ __('Verify Your Email Address') }}</div>

                <div class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                    @if (session('resent'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="text-blue-500 hover:text-blue-700 focus:outline-none">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
