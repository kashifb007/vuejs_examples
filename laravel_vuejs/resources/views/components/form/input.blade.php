@props([
        'for',
        'label' => str()->ucfirst($for),
        'required' => false,
        'type',
])

{{--Should be wrapped in <div> outside of this--}}
<div class="flex justify-between">
    <label for="{{ $for }}" class="block text-sm font-medium text-gray-700">{{ $label ?? '' }}</label>
    @if($required)
        <span class="text-sm text-red-500">*</span>
    @endif
</div>
<div class="mt-1">
    <input autocomplete="{{ $for }}" @if($required) required @endif type="{{ $type }}"
        {{ $attributes->merge(['name' => $for, 'id' => $for, 'value' => old($for) ])->class([
            'shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md' => ! $errors->has($for),
            'block w-full pr-10 border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md' => $errors->has($for),
        ]) }}
    />
</div>

@error($for)
<p class="mt-2 text-red-600 text-sm">{{ $message }}</p>
@enderror
