@extends("base")

@section("root")
    @include("reporting.nav")
@endsection

@section("body")
    <div class="mb-4 flex justify-between">
        <h1 class="h1">{{ __("project.list_title") }}</h1>
        <a href="{{ route("projects.create") }}" class="btn btn-primary">
            <span class="iconify lucide--plus"></span>
            {{ __("project.create") }}
        </a>
    </div>

    {{-- Table --}}
    <div class="-mx-4 mt-4 overflow-x-auto">
        <table class="table-zebra table" x-data>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>{{ __("project.name") }}</th>
                    <th>{{ __("project.client") }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr
                        x-link="{{ route("projects.show", $project) }}"
                        class="hover:bg-base-300"
                    >
                        <td>
                            {{ $project->name_id }}
                        </td>
                        <td>
                            {{ $project->client->name }}
                        </td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
