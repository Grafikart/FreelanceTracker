@props([
    'label',
    'type' => 'text',
    'name',
    'icon' => null,
    'placeholder' => '',
    'value' => null,
    'options' => null,
    'inputClass' => 'w-full',
    'layout' => 'horizontal',
    'rows' => 6,
    'disabled' => false,
])

@php
    $class = [
        $inputClass,
        'input' => $icon === null
    ];
    $wrapperClass = $layout === 'horizontal' ? 'flex gap-4' : 'space-y-1'
@endphp


<fieldset {{ $attributes->class($wrapperClass) }}>
    <div class="w-1/4 pt-2 font-semibold text-sm">{{ $label }}</div>
    <label @class(['w-3/4', 'input' => $icon])>
        @if($icon)
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                 fill="currentColor" {{ $icon->attributes->class('text-base-content/80 size-5') }}>
                {{ $icon }}
            </svg>
        @endif
        @if($type === 'textarea')
            <textarea
                @disabled($disabled)
                class="textarea w-full {{ $inputClass }}"
                placeholder="{{ $placeholder }}"
                name="{{ $name }}"
                rows="{{ $rows }}">{{ old($name, $value) }}</textarea>
        @elseif($options)
            <select
                @disabled($disabled)
                class="select w-full"
                name="{{ $name }}">
                @foreach($options as $option)
                    <option value="{{ $option['value'] }}" @selected($option['value'] === old($name, $value))>
                        {{ $option['label'] }}
                    </option>
                @endforeach
            </select>
        @else
            <input
                @class($class)
                @disabled($disabled)
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
