@extends($activeTemplate . 'layouts.master')

@section('content')
    <div class="section section--sm">
        <div class="container">
            <div class="d-flex flex-wrap flex-row-reverse justify-content-between align-items-center mb-lg-3">
                <div class="text-end">
                    <a href="{{ route('ticket.open') }}" class="btn btn-sm btn--base mb-2"> <i class="fa fa-plus"></i> @lang('New Ticket')</a>
                </div>
                <div class="custom--table__header">
                    <h5 class="text-lg-start m-0 text-center">@lang('Support Ticket')</h5>
                </div>
            </div>
            <div class="table-responsive--md">
                <table class="table custom--table">
                    <thead>
                        <tr>
                            <th>@lang('Subject')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Priority')</th>
                            <th>@lang('Last Reply')</th>
                            <th>@lang('Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($supports as $support)
                            <tr>
                                <td data-label="@lang('Subject')"> [@lang('Ticket')#{{ $support->ticket }}] {{ __($support->subject) }} </td>
                                <td data-label="@lang('Status')">
                                    @if ($support->status == 0)
                                        <span class="badge badge--success py-2 px-3">@lang('Open')</span>
                                    @elseif($support->status == 1)
                                        <span class="badge badge--primary py-2 px-3">@lang('Answered')</span>
                                    @elseif($support->status == 2)
                                        <span class="badge badge--warning py-2 px-3">@lang('Customer Reply')</span>
                                    @elseif($support->status == 3)
                                        <span class="badge badge--dark py-2 px-3">@lang('Closed')</span>
                                    @endif
                                </td>
                                <td data-label="@lang('Priority')">
                                    @if ($support->priority == 1)
                                        <span class="badge badge--dark py-2 px-3">@lang('Low')</span>
                                    @elseif($support->priority == 2)
                                        <span class="badge badge--success py-2 px-3">@lang('Medium')</span>
                                    @elseif($support->priority == 3)
                                        <span class="badge badge--primary py-2 px-3">@lang('High')</span>
                                    @endif
                                </td>
                                <td data-label="@lang('Last Reply')">{{ \Carbon\Carbon::parse($support->last_reply)->diffForHumans() }} </td>

                                <td data-label="@lang('Action')">
                                    <a href="{{ route('ticket.view', $support->ticket) }}" class="btn btn--base btn--sm">
                                        <i class="fa fa-desktop"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100%" class="text-center text-muted">{{ __($emptyMessage) }} </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3 d-flex justify-content-end">
                @if ($supports->hasPages())
                    {{ paginateLinks($supports) }}
                @endif
            </div>
        </div>
    </div>
@endsection
