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
                    <th>{{ __("project.name") }}</th>
                    <th>{{ __("project.budget") }}</th>
                    <th>{{ __("project.budget_spent") }}</th>
                    <th class="w-5">{{ __("form.actions") }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr class="hover:bg-base-300">
                        <td>
                            {{ $project->name }}
                        </td>
                        <td>
                            @money($project->budget, $project->currency)
                        </td>
                        <td>-</td>
                        <td>
                            <a
                                href="{{ route("projects.edit", $project) }}"
                                class="btn btn-soft btn-sm btn-neutral"
                            >
                                <span class="iconify lucide--pen"></span>
                                {{ __("project.edit") }}
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
