<x-layouts.main>

    <div class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">{{ __('Please confirm your password before continuing.') }}</h2>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <x-form.form action="/user/confirm-password" class="space-y-6" method="post">
                    <div>
                        <x-form.input for="password" required type="password"/>
                    </div>

                    <div>
                        <x-form.button type="submit">{{ __('Confirm Password') }}</x-form.button>
                    </div>
                </x-form.form>
            </div>
        </div>
    </div>

</x-layouts.main>
