<x-layouts.main>


    <div class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">{{ __('Enter 2FA Code') }}</h2>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <x-form.form action="{{ route('two-factor.login') }}" method="post">
                    <div class="space-y-6">
                        <x-form.input
                            autocomplete="one-time-code"
                            autofocus
                            for="code"
                            inputmode="numeric"
                            label="Two-factor Code"
                            pattern="[0-9]*"
                            type="text"></x-form.input>
                        <x-form.button type="submit">{{ __('Authenticate') }}</x-form.button>
                    </div>
                </x-form.form>
            </div>
        </div>
    </div>

</x-layouts.main>
