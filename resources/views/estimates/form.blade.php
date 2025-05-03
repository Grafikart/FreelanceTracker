@extends("base")

@section("body")
    <div class="flex justify-between">
        <h1 class="h1">{{ $title }}</h1>
    </div>

    @include("shared.form-errors")

    <form
        action="{{ $action }}"
        method="post"
        class="mt-6 space-y-4"
        x-data="rows({{ $estimate->asAlpineData() }})"
    >
        @if ($estimate->id)
            @method("put")
        @endif

        @csrf

        <div class="grid grid-cols-2 gap-x-6 gap-y-2">
            <x-form.field
                name="accounting_id"
                :disabled="$estimate->id"
                :value="$estimate->accounting_id"
                label="{{ __('estimate.accounting_id') }}"
                placeholder="{{ __('estimate.accounting_id') }}"
            />

            <x-form.field
                name="client_id"
                :options="$clients"
                :value="$estimate->client_id"
                label="{{ __('estimate.client_id') }}"
                placeholder="{{ __('estimate.client_id') }}"
            />

            <x-form.field
                name="created_at"
                type="date"
                input-class="w-35"
                :value="$estimate->created_at->format('Y-m-d')"
                label="{{ __('estimate.created_at') }}"
                placeholder="{{ __('estimate.created_at') }}"
            />

            <x-form.field
                name="tax"
                :value="$estimate->tax"
                x-model="tax"
                label="{{ __('estimate.tax') }}"
                placeholder="{{ __('estimate.tax') }}"
            />

            <x-form.field
                name="label"
                :value="$estimate->label"
                label="{{ __('estimate.label') }}"
                placeholder="{{ __('estimate.label') }}"
            />

            <x-form.field
                name="currency"
                :options="\App\Infrastructure\I18n\I18nHelper::currencies()"
                :value="$estimate->currency"
                label="{{ __('estimate.currency') }}"
                placeholder="{{ __('estimate.currency') }}"
            />
        </div>

        @include("shared.rows")

        <x-form.field
            type="textarea"
            name="footer"
            :value="$estimate->footer"
            label="{{ __('estimate.footer') }}"
            layout="vertical"
        />

        <input
            type="hidden"
            x-bind:value="JSON.stringify(rows)"
            name="rows"
        />

        <div class="flex justify-end">
            <button class="btn btn-primary" type="submit">
                {{ __("form.save") }}
            </button>
        </div>
    </form>
@endsection
