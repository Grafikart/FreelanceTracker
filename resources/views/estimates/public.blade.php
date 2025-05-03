@extends('base')

@section('body')

    <div class="flex items-center">
        @switch($estimate->state)
            @case(\App\Domains\Estimates\Estimate::STATUS_APPROVED)
                <div class="badge badge-lg badge-success badge-soft">
                    <span class="iconify lucide--check"></span>
                    {{ __('estimate.status.approved') }}
                </div>
                @break

            @case(\App\Domains\Estimates\Estimate::STATUS_REJECTED)
                <div class="badge badge-lg badge-error badge-soft">
                    <span class="iconify lucide--check"></span>
                    {{ __('estimate.status.rejected') }}
                </div>
                @break

            @default
                <form action="{{ \URL::signedRoute('estimates.state', $estimate, now()->addHours(1), true) }}"
                      method="post">
                    @csrf
                    @method('PUT')
                    <button type="submit" name="state" value="{{ \App\Domains\Estimates\Estimate::STATUS_APPROVED }}"
                            class="btn btn-ghost ml-2 border-base-300">{{ __('estimate.accept') }}</button>
                    <button type="submit" name="state" value="{{ \App\Domains\Estimates\Estimate::STATUS_REJECTED }}"
                            class="btn btn-ghost border-base-300">{{ __('estimate.reject') }}</button>
                </form>
        @endswitch
        <a class=" ml-auto btn btn-ghost border-base-300"
           href="{{ \URL::signedRoute('estimates.pdf', $estimate, now()->addHours(1), true) }}">
            <span class="iconify lucide--file-text"></span>
            PDF
        </a>
    </div>
    <div class="card bg-white pdf p-8 mt-4">
        @include('shared.pdf', ['estimate' => $estimate])
    </div>

@endsection
