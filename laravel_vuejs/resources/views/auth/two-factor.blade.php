<x-layouts.main>

    @if (session('status') == 'two-factor-authentication-enabled')
        <x-alert type="success">{{ __('Two-factor Authentication has been enabled.') }}</x-alert>
    @endif

    <div class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">{{ __('Two-factor Authentication') }}</h2>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <div class="space-y-6">
                    @unless(auth()->user()->isTwoFactorEnabled)
                        <p>{{ __('Two-factor Authentication is currently disabled.') }}</p>
                        <x-form.form action="{{ route('two-factor.enable') }}" method="post">
                            <x-form.button type="submit">{{ __('Enable Two-factor Authentication') }}</x-form.button>
                        </x-form.form>
                    @endunless

                    @if (session('status') == 'two-factor-authentication-enabled')
                        <p>{{ __('Scan the QR code using your preferred authenticator.') }}</p>
                        <div>
                            {!! auth()->user()->twoFactorQrCodeSvg() !!}
                        </div>
                        <h3 class="font-medium">{{ __('Recovery codes') }}</h3>
                        <p class="text-sm font-medium">
                            {{ __('Store these recovery codes to use in-case you lose access to your authenticator.') }}
                        </p>
                        <div>
                            <ul class="divide-y divide-gray-200" role="list">
                                @foreach(auth()->user()->recoveryCodes() as $recoveryCode)
                                    <li class="py-4 flex">
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">{{ $recoveryCode }}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div>
                            <a href="{{ route('home') }}">{{ __('Go home') }}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-layouts.main>
