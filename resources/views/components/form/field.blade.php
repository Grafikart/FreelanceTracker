@props([
    "label",
    "type" => "text",
    "name",
    "icon" => null,
    "placeholder" => "",
    "value" => null,
    "options" => null,
    "inputClass" => "w-full",
    "layout" => "horizontal",
    "rows" => 6,
    "disabled" => false,
    "help" => null,
])

@php
    $class = [$inputClass, "input" => $icon === null];
    $wrapperClass = $layout === "horizontal" ? "flex gap-4" : "space-y-1";
    if ($options && is_string($options)) {
        $options = array_map(fn ($case) => ["value" => $case->value, "label" => $case->label()], $options::cases());
    }
@endphp

<fieldset {{ $attributes->class($wrapperClass) }}>
    <div
        @class(["pt-2 text-sm font-semibold", $layout === "vertical" ? "w-full" : "w-1/4"])
    >
        {{ $label }}
    </div>
    <div @class([$layout === "vertical" ? "w-full" : "w-3/4"])>
        <label @class(["input" => $icon])>
            @if ($icon)
                @if (strpos($icon, "--") === false)
                    <span class="text-base-content/80">{{ $icon }}</span>
                @else
                    <span
                        class="text-base-content/80 iconify {{ $icon }} size-5"
                    ></span>
                @endif
            @endif

            @if ($type === "textarea")
                <textarea
                    @disabled($disabled)
                    class="textarea {{ $inputClass }} w-full"
                    placeholder="{{ $placeholder }}"
                    name="{{ $name }}"
                    rows="{{ $rows }}"
                >
{{ old($name, $value) }}</textarea
                >
            @elseif ($options)
                <select
                    @disabled($disabled)
                    class="select w-full"
                    name="{{ $name }}"
                >
                    @foreach ($options as $option)
                        <option
                            value="{{ $option["value"] }}"
                            @selected($option["value"] === old($name, $value))
                        >
                            {{ $option["label"] }}
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
                />
            @endif
        </label>
        @if ($help)
            <p class="label text-base-content/60 mt-1 text-xs">{{ $help }}</p>
        @endif

        @error($name)
            <p class="label text-error mt-1 text-xs">{{ $message }}</p>
        @enderror
    </div>
</fieldset>
