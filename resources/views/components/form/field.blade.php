@props([
    'label',
    'type' => 'text',
    'name',
    'icon' => null,
    'placeholder' => '',
    'value' => null,
])

@php
$class = [
    'input w-full' => $icon === null
];
@endphp

<fieldset {{ $attributes->class(['flex gap-4']) }}>
    <div class="w-1/4 pt-2 font-semibold">{{ $label }}</div>
    <label @class(['w-3/4', 'input' => $icon])>
        @if($icon)
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" {{ $icon->attributes->class('text-base-content/80 size-5') }}>
            {{ $icon }}
            </svg>
        @endif
        @if($type === 'textarea')
            <textarea class="textarea w-full"
                      placeholder="{{ $placeholder }}"
                      name="{{ $name }}"
                      rows="6">{{ old($name, $value) }}</textarea>
        @else
            <input @class($class)
                   placeholder="{{ $placeholder }}"
                   type="{{ $type }}"
                   name="{{ $name }}"
                   value="{{ old($name, $value) }}"
            >
        @endif
    </label>
    @error($name)
    <p class="label text-error">{{ $message }}</p>
    @enderror
</fieldset>
