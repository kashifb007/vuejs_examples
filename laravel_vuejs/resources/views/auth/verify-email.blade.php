<x-layouts.main>

    @if (session('status') == 'verification-link-sent')
        <x-alert type="success">
            {{ __('A new email verification link has been emailed to you!') }}
        </x-alert>
    @endif

    <div class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10 space-y-6">
                <div class="sm:mx-auto sm:w-full sm:max-w-md">
                    <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">{{ __('Verify Your Email Address') }}</h2>
                </div>

                <p>
                    {{ __('Before proceeding, please check your email for a verification link.') }}
                </p>
                <p>
                    {{ __('If you did not receive the email') }}
                </p>

                <x-form.form action="{{ route('verification.send') }}" method="post">
                    <x-form.button type="submit">{{ __('click here to request another') }}</x-form.button>
                </x-form.form>
            </div>
        </div>
    </div>

</x-layouts.main>
