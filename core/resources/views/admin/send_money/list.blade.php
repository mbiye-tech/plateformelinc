@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('Created By')</th>
                                    <th>@lang('Sent From')</th>
                                    <th>@lang('Recipient')</th>
                                    <th>@lang('Sending Amount / Trx')</th>
                                    <th>@lang('Receivable Amount')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sendMoneys as $sendMoney)
                                    <tr>
                                        <td data-label="@lang('Created By')">
                                            @if ($sendMoney->user_id)
                                                <span class="fw-bold">{{ @$sendMoney->user->fullname }}</span>
                                                <br>
                                                <span class="small">
                                                    <a href="{{ route('admin.users.detail', $sendMoney->user_id) }}"><span>@</span>{{ $sendMoney->user->username }}</a>
                                                </span>
                                            @else
                                                <span class="fw-bold">{{ @$sendMoney->agent->fullname }}</span>
                                                <br>
                                                <span class="small">
                                                    <a href="{{ route('admin.agents.detail', $sendMoney->agent_id) }}"><span>@</span>{{ $sendMoney->agent->username }}</a>
                                                </span>
                                            @endif
                                        </td>

                                        <td data-label="@lang('Sent From')">
                                            {{ @$sendMoney->senderInfo->name }}<br>{{ $sendMoney->sending_country }}
                                        </td>

                                        <td data-label="@lang('Recipient')">
                                            {{ $sendMoney->recipient->name }}<br>{{ $sendMoney->recipient_country }}
                                        </td>

                                        <td data-label="@lang('Sending Amount / Trx/Trx')">
                                            {{ showAmount($sendMoney->sending_amount) }} {{ $sendMoney->sending_currency }} <br>
                                            <span class="text--primary">{{ $sendMoney->trx }}</span>
                                        </td>

                                        <td data-label="@lang('Receivable Amount')">
                                            {{ showAmount($sendMoney->recipient_amount) }} {{ $sendMoney->recipient_currency }} <br>

                                        </td>
                                        <td data-label="@lang('Status')">
                                            @php
                                                echo $sendMoney->statusText;
                                            @endphp
                                            <br>
                                            {{ $sendMoney->updated_at->diffForHumans() }}
                                        </td>

                                        <td data-label="@lang('Action')">
                                            <a href="{{ route('admin.send.money.details', $sendMoney->id) }}" class="btn btn-sm btn-outline--primary">
                                                <i class="las la-desktop text--shadow"></i> @lang('Details')
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                @if ($sendMoneys->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($sendMoneys) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <form action="" method="GET" class="form-inline float-sm-end">
        <div class="input-group ">
            <input type="text" name="search" class="form-control bg-white text--dark" placeholder="@lang('Trx/sender/recipient info')" value="{{ request()->search ?? '' }}">
            <button type="submit" class="input-group-text bg--primary border-0"><i class="fa fa-search"></i></button>
        </div>
    </form>
@endpush
