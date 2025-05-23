@extends("base")

@section("body")
    <div class="flex items-center">
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
                    action="{{ \URL::signedRoute("estimates.state", $estimate, now()->addHours(1), true) }}"
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
        <a
            class="btn btn-ghost border-base-300 ml-auto"
            href="{{ \URL::signedRoute("estimates.pdf", $estimate, now()->addHours(1), true) }}"
        >
            <span class="iconify lucide--file-text"></span>
            PDF
        </a>
    </div>
    <div class="card pdf mt-4 bg-white p-8">
        @include("shared.pdf", ["estimate" => $estimate])
    </div>
@endsection
