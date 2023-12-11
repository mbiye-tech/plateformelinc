@extends('agent.layouts.app')

@section('panel')
    <div class="row justify-content-center mt-5">
        <div class="col-xxl-5 col-xl-7 col-md-8 col-sm-10">
            <div class="border--card h-auto">

                <h4 class="title">{{ __($pageTitle) }}</h4>
                <div class="card-body p-0">

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0">
                            @lang('Amount')
                            <h4 class="fw-bold">{{ showAmount($sendMoney->recipient_amount) }} {{ __($sendMoney->recipient_currency) }}</h4>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0">
                            @lang('Name')
                            <span class="fw-bold">{{ __($sendMoney->recipient->name) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0">
                            @lang('Address')
                            <span class="fw-bold">{{ __($sendMoney->recipient->address) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0">
                            @lang('Mobile')
                            <span class="fw-bold">+{{ showMobileNumber($sendMoney->recipient->mobile) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0">
                            @lang('Transaction No')
                            <span class="fw-bold">{{ __($sendMoney->trx) }}</span>
                        </li>
                    </ul>


                    <form id="confirm-form" action="{{ route('agent.payout.confirm', $sendMoney->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>@lang('Verification Code') <i class="fa fa-info-circle" title="@lang('To complete this payout you need to verify the Recipient by his/her mobile number. Click on Send Code button to send a system generated verification code.')"></i></label>

                            <div class="d-flex justify-content-end flex-wrap gap-3">
                                <input id="code" type="text" value="" class="form--control flex-fill w-auto" placeholder="@lang('Enter Verification Code Here')" name="code" autocomplete="off" required>

                                <button type="button" class="btn-sm btn--dark send-verification-code" data-id="{{ $sendMoney->id }}">@lang('Send Code')</button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn--base btn-md w-100">@lang('Proceed')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="payout-confirmation-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Payout Confirmation')</h5>
                    <button type="button" class="btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0">
                            @lang('Name')
                            <span class="fw-bold">{{ __($sendMoney->recipient->name) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0">
                            @lang('Transaction No')
                            <span class="fw-bold">{{ __($sendMoney->trx) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent px-0">
                            @lang('Payable amount')
                            <span class="fw-bold">{{ showAmount($sendMoney->recipient_amount) }} {{ __($sendMoney->recipient_currency) }}</span>
                        </li>
                    </ul>

                    <div class="alert alert-warning mt-3" role="alert">
                        <strong class="d-flex text-center">
                            @lang('Payout amount ' . showAmount($sendMoney->base_currency_amount) . ' ' . $general->cur_text . ' (' . showAmount($sendMoney->recipient_amount) . ' ' . $sendMoney->recipient_currency . ') and payout commission ' . showAmount($commission) . ' ' . $general->cur_text . ' will be added in your wallet')
                        </strong>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-md btn--base w-100 pay-now-button">@lang('Payout Now')</button>
                </div>
            </div>
        </div>
    </div>
@endsection



@push('script')
    <script>
        (function($) {
            "use strict";
            $(".send-verification-code").click(function() {
                var id = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: '{{ route('agent.payout.verification.code') }}?id=' + id,
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == 'success') {
                            notify('success', data.message)
                            $('form#confirm-form').removeClass('d-none').fadeIn();
                        } else {
                            notify('error', data.message)
                        }
                    },
                    error: function() {
                        notify('error', 'Server error');
                        $('form#confirm-form').fadeOut();
                    }
                });
                $(this).text('Resend Code')
            });
            $('form#confirm-form :submit').on('click', function(e) {
                e.preventDefault();
                $('#payout-confirmation-modal').modal('show')
            })
            $('.pay-now-button').on('click', function() {
                $('#payout-confirmation-modal').modal('hide')
                $('form#confirm-form').submit();
            });
        })(jQuery);
    </script>
@endpush
