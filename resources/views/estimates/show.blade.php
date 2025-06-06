@extends("base")

@section("body")
    <div class="flex items-center justify-between">
        <div>
            <a
                href="{{ route("estimates.index") }}"
                class="text-base-content/70 btn btn-ghost -ml-3 text-sm"
            >
                <span class="iconify lucide--arrow-left"></span>
                {{ __("estimate.back_to_list") }}
            </a>
            <h1 class="h1">{{ $title }} {{ $estimate->id }}</h1>
        </div>
        <div>
            <a
                class="btn btn-ghost border-base-300"
                href="{{ route("estimates.pdf", $estimate) }}"
            >
                <span class="iconify lucide--file-text"></span>
                PDF
            </a>
        </div>
    </div>

    <div class="mt-8 flex items-center gap-1">
        <button
            x-data="clipboard('{{ $url }}')"
            x-text="text"
            :class="{ 'btn-success': copied, 'btn-primary': !copied }"
            @click="copy()"
            class="btn"
        >
            {{ __("estimate.copy_link") }}
        </button>
        <a
            class="btn btn-ghost border-base-300"
            href="{{ route("estimates.edit", $estimate) }}"
        >
            {{ __("estimate.edit_title") }}
        </a>
        <div class="ml-auto text-lg">
            <span class="text-base-content/70">
                {{ __("estimate.total") }}:
            </span>
            <span class="text-base-content font-semibold">
                @money($estimate->total, $estimate->currency)
            </span>
        </div>
        <div class="ml-2">
            @switch($estimate->state)
                @case(\App\Domains\Estimates\Estimate::STATUS_APPROVED)
                    <div class="badge badge-lg badge-success badge-soft">
                        <span class="iconify lucide--check"></span>
                        {{ __("estimate.status.approved") }}
                    </div>

                    @break
                @case(\App\Domains\Estimates\Estimate::STATUS_REJECTED)
                    <div class="badge badge-lg badge-error badge-soft">
                        <span class="iconify lucide--check"></span>
                        {{ __("estimate.status.rejected") }}
                    </div>

                    @break
                @default
                    <form
                        action="{{ route("estimates.state", $estimate) }}"
                        method="post"
                    >
                        @csrf
                        @method("PUT")
                        <button
                            type="submit"
                            name="state"
                            value="{{ \App\Domains\Estimates\Estimate::STATUS_APPROVED }}"
                            class="btn btn-ghost border-base-300 ml-2"
                        >
                            {{ __("estimate.accept") }}
                        </button>
                        <button
                            type="submit"
                            name="state"
                            value="{{ \App\Domains\Estimates\Estimate::STATUS_REJECTED }}"
                            class="btn btn-ghost border-base-300"
                        >
                            {{ __("estimate.reject") }}
                        </button>
                    </form>
            @endswitch
        </div>
    </div>

    <div class="card pdf mt-4 bg-white p-8">
        @include("shared.pdf", ["estimate" => $estimate])
    </div>
@endsection
