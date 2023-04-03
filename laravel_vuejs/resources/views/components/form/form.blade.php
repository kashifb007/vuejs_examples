@props([
    'action',
    'method',
    'csrf' => true,
])

@php
    $method = [
        'delete' => 'DELETE',
        'patch' => 'PATCH',
        'put' => 'PUT',
    ][$method] ?? 'POST';
@endphp

<form action="{{ $action }}" {{ $attributes->merge(['method' => 'post']) }}>
    @if($csrf)
        @csrf
    @endif

    @unless($method == 'POST')
        @method($method)
    @endunless

    {{ $slot }}
</form>
