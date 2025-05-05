@extends("base")

@section("body")
    <h1 class="h1">{{ $title }}</h1>

    @include("shared.form-errors")

    <form action="{{ $action }}" method="post" class="mt-6 space-y-4">
        @if ($project->id)
            @method("put")
        @endif

        @csrf

        <x-form.field
            name="client_id"
            :options="$clients"
            :value="$project->client_id"
            label="{{ __('project.client') }}"
            placeholder="{{ __('estimate.client_id') }}"
        />

        <x-form.field
            name="name"
            :value="$project->name"
            label="{{ __('project.name') }}"
            placeholder="{{ __('project.name') }}"
        />

        <x-form.field
            name="currency"
            :options="\App\Infrastructure\I18n\I18nHelper::currencies()"
            :value="$project->currency"
            label="{{ __('project.currency') }}"
            placeholder="{{ __('project.currency') }}"
        />

        <x-form.field
            name="budget"
            inputClass="w-40"
            type="number"
            :icon="$user->currency_format->isBefore() ? $project->currency : null"
            :iconAfter="$user->currency_format->isAfter() ? $project->currency : null"
            :value="$project->budget / 100"
            label="{{ __('project.budget') }}"
            placeholder="{{ __('project.budget') }}"
        />

        <x-form.field
            name="rate"
            inputClass="w-45"
            type="number"
            iconAfter="{{ (new \App\Infrastructure\I18n\MoneyFormatter)->symbol($user->currency) }}/{{ __('project.hour') }}"
            :value="$project->rate / 100"
            label="{{ __('project.rate') }}"
            placeholder="{{ __('project.rate') }}"
        />

        <div class="flex justify-end">
            <button class="btn btn-primary" type="submit">
                {{ __("form.save") }}
            </button>
        </div>
    </form>
@endsection
