@extends("base")

@section("root")
    @include("reporting.nav")
@endsection

@section("body")
    <div x-data="{ form: false }">
        <div class="mb-4 flex justify-between">
            <h1 class="h1">{{ __("task.list_title") }}</h1>
        </div>

        {{-- Table --}}
        <div class="-mx-4 mt-4 overflow-x-auto">
            <table class="table-zebra table" x-data>
                <thead>
                    <tr>
                        <th>{{ __("task.name") }}</th>
                        <th></th>
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
    </div>
@endsection
