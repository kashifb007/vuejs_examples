@extends('components.layouts.main.blade.php')

@section('content')
    <x-forms.header label="{{ __('Change Password') }}"/>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <form method="POST" action="{{ route('user-password.update') }}">
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="col-span-6 py-2">
                        @csrf
                        @method('PUT')

                        @if (session('status') == "password-updated")
                            <div class="alert alert-success">
                                Password updated successfully.
                            </div>
                        @endif

                        <div class="col-span-6 py-2">
                            <x-forms.label label="{{ __('Current Password') }}" for="current_password"/>
                            <x-forms.input for="current_password" type="password"/>
                        </div>

                        <div class="col-span-6 py-2">
                            <x-forms.label label="{{ __('Password') }}" for="password"/>
                            <x-forms.input for="password" type="password"/>
                        </div>

                        <div class="col-span-6 py-2">
                            <x-forms.label label="{{ __('Confirm Password') }}" for="password"/>
                            <x-forms.input for="password_confirmation" type="password"/>
                        </div>

                        <div class="py-5 bg-white">
                            <x-forms.button label="{{ __('Save') }}" type="submit"/>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
