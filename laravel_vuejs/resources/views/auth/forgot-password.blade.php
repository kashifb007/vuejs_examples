<x-layouts.main>

    @if (session('status'))
        <x-alert type="success">{{ session('status') }}</x-alert>
    @endif

    <div class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">{{ __('Request a password reset') }}</h2>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <x-form.form action="{{ route('password.email') }}" class="space-y-6" method="post">
                    <div>
                        <x-form.input autofocus for="email" label="Email Address" required type="email"/>
                    </div>

                    <div>
                        <x-form.button type="submit">{{ __('Send Password Reset Link') }}</x-form.button>
                    </div>
                </x-form.form>
            </div>
        </div>

</x-layouts.main>
