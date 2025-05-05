@extends("base")

@section("root")
    @include("reporting.nav")
@endsection

@section("body")
    <a
        href="{{ route("projects.index") }}"
        class="text-base-content/70 btn btn-ghost text-s2 mb-1 -ml-2"
    >
        <span class="iconify lucide--arrow-left"></span>
        {{ __("project.back_to_list") }}
    </a>
    <h1 class="h1">{{ __("task.list_title") }}</h1>

    {{-- Table --}}
    <div class="-mx-4 mt-4 overflow-x-auto">
        <table class="table-zebra table" x-data>
            <thead>
                <tr>
                    <th>{{ __("task.name") }}</th>
                    <th class="text-end">
                        @if ($state === "deleted")
                            <a
                                class="btn btn-ghost border-base-300"
                                href="{{ route("tasks.index") }}"
                            >
                                <span class="iconify lucide--text"></span>
                                {{ __("task.all") }}
                            </a>
                        @else
                            <a
                                class="btn btn-ghost border-base-300"
                                href="{{ route("tasks.index", ["state" => "deleted"]) }}"
                            >
                                <span class="iconify lucide--trash"></span>
                                {{ __("task.deleted") }}
                            </a>
                        @endif
                    </th>
                </tr>
            </thead>
            <tbody>
                @include("reporting.tasks.form")
                @foreach ($tasks as $task)
                    @include("reporting.tasks.row")
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
