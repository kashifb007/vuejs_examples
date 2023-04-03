@php
    $twoFaStatus = auth()->user()->isTwoFactorEnabled
@endphp

<x-layouts.main>
    @if (session('status') == 'two-factor-authentication-disabled')
        <x-alert type="danger">{{ __('Two-factor Authentication has been disabled.') }}</x-alert>
    @endif

    <h1>Home page</h1>

    @unless(auth()->user()->isTwoFactorEnabled)
        <a href="{{ route('two-factor-auth') }}">Enable Two-Factor Authentication</a>
    @else
        <x-form.form action="{{ route('two-factor.disable') }}" method="delete">
            <x-form.button class="w-1/2" type="submit">{{ __('Disable Two-factor Authentication') }}</x-form.button>
        </x-form.form>
    @endunless
</x-layouts.main>
