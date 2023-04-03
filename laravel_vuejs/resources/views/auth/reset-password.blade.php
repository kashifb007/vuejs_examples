<x-layouts.main>

    <div class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">{{ __('Choose a new password') }}</h2>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <x-form.form action="{{ route('password.update') }}" class="space-y-6" method="post">
                    <input id="token" name="token" type="hidden" value="{{ request()->route('token') }}"/>

                    <div>
                        <x-form.input autofocus for="email" label="Email Address" required type="email"/>
                    </div>

                    <div>
                        <x-form.input for="password" label="New password" required type="password"/>
                    </div>

                    <div>
                        <x-form.input for="password_confirmation" label="Confirm new password" required type="password"/>
                    </div>

                    <div>
                        <x-form.button type="submit">{{ __('Reset Password') }}</x-form.button>
                    </div>
                </x-form.form>
            </div>
        </div>
    </div>

</x-layouts.main>
