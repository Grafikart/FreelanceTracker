@extends('base')

@section('body')

    <div class="flex justify-between mb-4">
        <h1 class="h1">{{ __('estimate.list_title') }}</h1>
        <a href="{{ route('estimates.create') }}" class="btn btn-primary">
            <svg
                class="size-[1.2em]"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="currentColor">
                <path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z"></path>
            </svg>
            {{ __('estimate.create') }}
        </a>
    </div>

    {{-- Tabs --}}
    <div role="tablist" class="tabs tabs-border border-b-base-300 border-b-1">
        <a href="{{ route('estimates.index') }}"
           role="tab"
           class="tab gap-2"
           @if($tab === 'open')
               aria-selected="true"
            @endif
        >
            {{ __('estimate.open') }} <span class="badge badge-sm p-0 badge-neutral">{{ $count }}</span>
        </a>
        <a
            href="{{ route('estimates.index', ['tab' => 'all']) }}"
            role="tab"
            class="tab"
            @if($tab === 'all')
                aria-selected="true"
            @endif
        >{{ __('estimate.all') }}</a>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto -mx-4 mt-4">
        <table class="table table-zebra" x-data>
            <thead>
            <tr>
                <th>ID</th>
                <th>{{ __('estimate.client') }}</th>
                <th>{{ __('estimate.state') }}</th>
                <th>{{ __('estimate.created_at') }}</th>
                <th class="text-end">{{ __('estimate.total') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($estimates as $estimate)
                <tr x-link="{{ route('estimates.show', $estimate) }}" class="hover:bg-base-300">
                    <td>
                        {{ $estimate->accounting_id }}
                    </td>
                    <td>
                        <strong class="text-base-content">{{ $estimate->client->name }}</strong><br/>
                        <span class="text-sm"> {{  $estimate->label }}</span>
                    </td>
                    <td>
                        @switch($estimate->state)
                            @case(App\Domains\Estimates\Estimate::STATUS_DRAFT)
                                <span class="badge badge-soft bg-base-300">{{ __('estimate.status.draft') }}</span>
                                @break
                            @case(App\Domains\Estimates\Estimate::STATUS_SENT)
                                <span class="badge badge-soft badge-info">{{ __('estimate.status.sent') }}</span>
                                @break
                            @case(App\Domains\Estimates\Estimate::STATUS_APPROVED)
                                <span class="badge badge-soft badge-success">{{ __('estimate.status.approved') }}</span>
                                @break
                            @case(App\Domains\Estimates\Estimate::STATUS_REJECTED)
                                <span class="badge badge-soft badge-error">{{ __('estimate.status.rejected') }}</span>
                                @break
                            @default

                        @endswitch
                    </td>
                    <td>
                        {{ $user->formatDate($estimate->created_at) }}
                    </td>
                    <td class="text-end">
                        @money($estimate->total, $estimate->currency)
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        @if($tab === 'all')
            {{ $estimates->links() }}
        @endif
    </div>

@endsection
