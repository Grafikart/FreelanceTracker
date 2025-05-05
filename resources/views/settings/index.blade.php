@extends("base")

@section("body")
    <h1 class="text-2xl font-bold">{{ __("settings.title") }}</h1>

    <form action="" method="post" class="mt-6 space-y-4">
        @csrf

        <div class="md:flex">
            <h2 class="text-xl font-bold md:w-1/4">
                {{ __("settings.company_info") }}
            </h2>
            <div class="space-y-3 md:w-3/4">
                <x-form.field
                    layout="vertical"
                    name="company_name"
                    :value="$user->company_name"
                    label="{{ __('settings.company_name') }}"
                    placeholder="{{ __('settings.company_name') }}"
                />

                <x-form.field
                    layout="vertical"
                    x-grow
                    name="company_address"
                    type="textarea"
                    rows="3"
                    :value="$user->company_address"
                    label="{{ __('settings.company_address') }}"
                    placeholder="{{ __('settings.company_address') }}"
                />

                <x-form.field
                    type="number"
                    layout="vertical"
                    name="hourly_rate"
                    inputClass="w-45"
                    iconAfter="{{ (new \App\Infrastructure\I18n\MoneyFormatter)->symbol($user->currency) }}/{{ __('project.hour') }}"
                    :value="$user->hourly_rate / 100"
                    label="{{ __('settings.hourly_rate') }}"
                    placeholder="{{ __('settings.hourly_rate') }}"
                />

                <x-form.field
                    type="number"
                    layout="vertical"
                    inputClass="w-45"
                    name="hours_per_week"
                    iconAfter="{{  __('settings.hours_per_week') }}"
                    :value="$user->hours_per_week"
                    label="{{ __('settings.working_hours') }}"
                    placeholder="{{ __('settings.working_hours') }}"
                />
            </div>
        </div>

        <hr class="border-base-300" />

        <div class="md:flex">
            <h2 class="text-xl font-bold md:w-1/4">
                {{ __("settings.app_info") }}
            </h2>
            <div class="space-y-3 md:w-3/4">
                <x-form.field
                    layout="vertical"
                    name="locale"
                    :options="\App\Infrastructure\I18n\I18nHelper::locales()"
                    :value="$user->locale"
                    label="{{ __('settings.locale') }}"
                    placeholder="{{ __('settings.locale') }}"
                />

                <x-form.field
                    layout="vertical"
                    name="timezone"
                    :options="\App\Infrastructure\I18n\I18nHelper::timezones()"
                    :value="$user->timezone"
                    label="{{ __('settings.timezone') }}"
                    placeholder="{{ __('settings.timezone') }}"
                />

                <x-form.field
                    layout="vertical"
                    name="currency"
                    :options="\App\Infrastructure\I18n\I18nHelper::currencies()"
                    :value="$user->currency"
                    label="{{ __('settings.currency') }}"
                    placeholder="{{ __('settings.currency') }}"
                />

                <x-form.field
                    layout="vertical"
                    name="date_format"
                    :options="\App\Infrastructure\I18n\I18nHelper::dateFormats()"
                    :value="$user->date_format"
                    label="{{ __('settings.date_format') }}"
                    placeholder="{{ __('settings.date_format') }}"
                />

                <x-form.field
                    layout="vertical"
                    name="theme"
                    :options="\App\Domains\Settings\Theme::class"
                    :value="$user->theme->value"
                    label="{{ __('settings.theme') }}"
                    placeholder="{{ __('settings.theme') }}"
                />

                <x-form.field
                    layout="vertical"
                    name="currency_format"
                    :options="\App\Infrastructure\I18n\CurrencyFormat::class"
                    :value="$user->currency_format->value"
                    label="{{ __('settings.currency_format') }}"
                    placeholder="{{ __('settings.currency_format') }}"
                />

                <x-form.field
                    layout="vertical"
                    name="number_format"
                    :options="\App\Infrastructure\I18n\NumberFormat::class"
                    :value="$user->number_format->value"
                    label="{{ __('settings.number_format') }}"
                    placeholder="{{ __('settings.number_format') }}"
                />
            </div>
        </div>
        <div class="flex justify-end">
            <button class="btn btn-primary" type="submit">
                {{ __("form.save") }}
            </button>
        </div>
    </form>
@endsection
