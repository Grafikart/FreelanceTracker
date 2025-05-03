@extends('base')

@section('body')

    <h1 class="text-2xl font-bold">{{ __('settings.title') }}</h1>

    <form
        action=""
        method="post"
        class="space-y-4 mt-6"
    >

        @csrf

        <div class="md:flex">
            <h2 class="md:w-1/4 text-xl font-bold">{{ __('settings.company_info') }}</h2>
            <div class="md:w-3/4 space-y-3">
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
                    :value="$user->hourly_rate"
                    label="{{ __('settings.hourly_rate') }}"
                    placeholder="{{ __('settings.hourly_rate') }}"
                />

                <x-form.field
                    type="number"
                    layout="vertical"
                    name="hours_per_week"
                    :value="$user->hours_per_week"
                    label="{{ __('settings.hours_per_week') }}"
                    placeholder="{{ __('settings.hours_per_week') }}"
                />
            </div>
        </div>

        <hr class="border-base-300">

        <div class="md:flex">
            <h2 class="md:w-1/4 text-xl font-bold">{{ __('settings.app_info') }}</h2>
            <div class="md:w-3/4 space-y-3">
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
                    :options="\App\Infrastructure\I18n\I18nHelper::themes()"
                    :value="$user->theme"
                    label="{{ __('settings.theme') }}"
                    placeholder="{{ __('settings.theme') }}"
                />
            </div>
        </div>
        <div class="flex justify-end">
            <button class="btn btn-primary" type="submit">{{ __('form.save') }}</button>
        </div>
    </form>

@endsection
