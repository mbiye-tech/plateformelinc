@extends('admin.layouts.app')
@section('panel')
    @php
    $deposit = [];
    @endphp
    <div class="row gy-4">
        <div class="col-xl-4 col-md-6">
            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body">
                    <h5 class="mb-3">@lang('Receivable amount: ') <span
                            class="text--danger">{{ showAmount($sendMoney->recipient_amount) }}
                            {{ __($sendMoney->recipient_currency) }}</span></h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Initiated')
                            <span class="fw-bold">{{ $sendMoney->created_at->diffForHumans() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Transaction Number')
                            <span class="fw-bold">{{ @$sendMoney->trx }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Created By')
                            <span class="fw-bold">
                                @if ($sendMoney->user_id)
                                    <a
                                        href="{{ route('admin.users.detail', $sendMoney->user_id) }}"><span>@</span>{{ @$sendMoney->user->username }}</a>
                                @else
                                    <a
                                        href="{{ route('admin.agents.detail', $sendMoney->agent_id) }}"><span>@</span>{{ @$sendMoney->agent->username }}</a>
                                @endif
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Sending Amount')
                            <span class="fw-bold">{{ showAmount($sendMoney->sending_amount) }}
                                {{ $sendMoney->sending_currency }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Source of fund')
                            <span class="fw-bold"> {{ @$sendMoney->source_of_fund }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Sending Purpose')
                            <span class="fw-bold"> {{ @$sendMoney->sending_purpose }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Status')
                            <span class="fw-bold" title="Updated at {{ diffForHumans($sendMoney->updated_at) }}">
                                @php
                                    echo $sendMoney->statusText;
                                @endphp
                            </span>
                        </li>
                        @if ($sendMoney->payout_by)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @lang('Payout By')
                                <span class="fw-bold">
                                    <a href="{{ route('admin.agents.detail', $sendMoney->payout_by) }}"><span>@</span>{{ @$sendMoney->payoutBy->username }}</a>
                                </span>
                            </li>
                        @endif
                        @if (@$sendMoney->admin_feedback)
                            <li class="list-group-item">
                                <strong>@lang('Admin Response')</strong>
                                <br>
                                <p>{{ __(@$sendMoney->admin_feedback) }}</p>
                            </li>
                        @endif
                    </ul>
                    @if (@$sendMoney->status == 1)
                        <button class="btn mt-2 h-45 w-100 btn--base btn-outline--danger ml-1 refundButton"
                            data-action="{{ route('admin.send.money.refund.now', $sendMoney->id) }}"><i
                                class="fas fa-hand-holding-usd"></i>
                            @lang('Refund')
                        </button>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-md-6">
            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body">
                    <h5 class="card-title border-bottom pb-2">@lang('Recipient Information')</h5>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    @lang('Sender')
                                    <span class="fw-bold">{{ @$sendMoney->senderInfo->name }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    @lang('Sender Mobile')
                                    <span class="fw-bold">+{{ @$sendMoney->senderInfo->mobile }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    @lang('Sender Address')
                                    <span class="fw-bold">{{ @$sendMoney->senderInfo->address }}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    @lang('Recipient')
                                    <span class="fw-bold">{{ $sendMoney->recipient->name }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    @lang('Recipient Mobile')
                                    <span class="fw-bold">+{{ @$sendMoney->recipient->dial_code . $sendMoney->recipient->mobile }}
                                    </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    @lang('Recipient Address')
                                    <span class="fw-bold">{{ $sendMoney->recipient->address }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Refund MODAL --}}
    <div id="rejectModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Confirmation Alert')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>@lang('Are you sure to refund this send money?')</p>

                        <div class="form-group">
                            <label class="fw-bold mt-2">@lang('Reason for Rejection')</label>
                            <textarea name="message" id="message" placeholder="@lang('Reason for Rejection')" class="form-control"
                                rows="5"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-bs-dismiss="modal">@lang('No')</button>
                        <button type="submit" class="btn btn--primary">@lang('Yes')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.refundButton').on('click', function() {
                var modal = $('#rejectModal');
                modal.find('form').attr('action', $(this).data('action'));
                modal.modal('show');
            });
        })(jQuery);
    </script>
@endpush
