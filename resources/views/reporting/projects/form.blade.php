@extends("base")

@section("body")
    <div class="flex justify-between">
        <h1 class="h1">{{ $title }}</h1>
    </div>

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
            name="budget"
            :icon="$project->currency"
            :value="$project->budget"
            label="{{ __('project.budget') }}"
            placeholder="{{ __('project.budget') }}"
        />

        <div class="flex justify-end">
            <button class="btn btn-primary" type="submit">
                {{ __("form.save") }}
            </button>
        </div>
    </form>
@endsection
