@extends("base")

@section("body")
    <div class="flex justify-between">
        <h1 class="h1">{{ __("client.list_title") }}</h1>
        <a href="{{ route("clients.create") }}" class="btn btn-primary">
            <svg
                class="size-[1.2em]"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="currentColor"
            >
                <path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z"></path>
            </svg>
            {{ __("client.create") }}
        </a>
    </div>

    <div class="-mx-4 mt-4 overflow-x-auto">
        <table class="table-zebra table">
            <thead>
                <tr>
                    <th>{{ __("client.name") }}</th>
                    <th class="text-end">{{ __("form.actions") }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                    <tr>
                        <td>{{ $client->name }}</td>
                        <td class="w-50">
                            <div class="flex justify-end gap-2">
                                <a
                                    href="{{ route("clients.edit", $client) }}"
                                    class="btn btn-soft btn-sm btn-neutral"
                                >
                                    <span class="iconify lucide--pen"></span>
                                    {{ __("client.edit") }}
                                </a>
                                <form
                                    action="{{ route("clients.destroy", $client) }}"
                                    method="POST"
                                    class="inline"
                                >
                                    @csrf
                                    @method("DELETE")
                                    <button
                                        type="submit"
                                        class="btn btn-soft btn-sm btn-error"
                                    >
                                        <span
                                            class="iconify lucide--trash"
                                        ></span>
                                        {{ __("client.delete") }}
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $clients->links() }}
    </div>
@endsection
