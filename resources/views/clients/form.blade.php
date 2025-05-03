@extends("base")

@section("body")
    <div class="flex justify-between">
        <h1 class="text-2xl font-bold">{{ $title }}</h1>
    </div>

    <form action="{{ $action }}" method="post" class="mt-6 space-y-4">
        @if ($client->id)
            @method("put")
        @endif

        @csrf

        <x-form.field
            name="name"
            :value="$client->name"
            label="{{ __('client.name') }}"
            placeholder="{{ __('client.name') }}"
        />

        <x-form.field
            type="textarea"
            name="address"
            :value="$client->address"
            label="{{ __('client.address') }}"
            placeholder="{{ __('client.address') }}"
        />

        <div class="flex justify-end">
            <button class="btn btn-primary" type="submit">
                {{ __("form.save") }}
            </button>
        </div>
    </form>
@endsection
