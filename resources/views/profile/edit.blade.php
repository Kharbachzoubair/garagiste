@extends('layouts.master')

@section('content')
@if(auth()->check())
    @if(auth()->user()->role == 'admin' || auth()->user()->role == 'client' || auth()->user()->role == 'mechanic')
        {{-- Profile section --}}
        <div class="container-fluid px-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Profile') }}
            </h2>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    {{-- Update profile information form --}}
                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    {{-- Update password form --}}
                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    {{-- Delete user form (only for admins) --}}
                    @if(auth()->user()->role == 'admin')
                        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                            <div class="max-w-xl">
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
@endif
@endsection
