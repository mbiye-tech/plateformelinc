@extends('agent.layouts.app')
@section('panel')
    <div class="custom--card mt-5">
        <div class="card-body">
            <div class="row align-items-center flex-wrap mb-3">
                <div class="col-12 col-md-8">
                    <h6 class="mb-3 mb-md-0">@lang($pageTitle)</h6>
                </div>
                <div class="col-12 col-md-4">
                    <div class="text-end">
                        <form action="" method="GET">
                            <div class="search--box">
                                <input type="text" name="search" class="form--control" value="{{ request()->search }}" placeholder="@lang('Transaction ID')" autocomplete="off">
                                <button type="submit" class="search-box-btn">
                                    <i class="las la-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="table-responsive--md">
                <table class="table custom--table">
                    <thead>
                        <tr>
                            <th>@lang('Transaction ID')</th>
                            <th>@lang('Recipient')</th>
                            <th>@lang('Mobile')</th>
                            <th>@lang('Country')</th>
                            <th>@lang('Payout Amount')</th>
                            <th>@lang('Payout Date')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transfers as $transfer)
                            <tr>
                                <td data-label="@lang('Transaction ID')">{{ $transfer->trx }}</td>

                                <td data-label="@lang('Recipient')">
                                    {{ $transfer->recipient->name }}
                                </td>
                                <td data-label="@lang('Mobile')">
                                    +{{ @$transfer->recipient->dial_code . $transfer->recipient->mobile }}
                                </td>
                                <td data-label="@lang('Mobile')">
                                    {{ $transfer->recipient_country }}
                                </td>
                                <td data-label="@lang('Payout Amount')">
                                    {{ showAmount($transfer->recipient_amount) }} {{ __($transfer->recipient_currency) }}
                                </td>
                                <td data-label="@lang('Payout date')">
                                    @if ($transfer->received_at)
                                        <span title="{{ diffForHumans($transfer->received_at) }}"> {{ showDateTime($transfer->received_at) }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100%" class="text-center">{{ __($emptyMessage) }}</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
            @if ($transfers->hasPages())
                <div class="d-flex justify-content-end">
                    {{ paginateLinks($transfers) }}

                </div>
            @endif
        </div>
    </div>
@endsection
