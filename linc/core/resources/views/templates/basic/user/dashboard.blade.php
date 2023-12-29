@extends($activeTemplate . 'layouts.master')
@section('content')
    @php
    $kycInstruction = getContent('kyc_instruction_user.content', true);
    @endphp
    
 
          <a class="btn btn-md-btn--md btn--base fixed-with" href="{{ route('user.send.money.now') }}">
                                    @lang('Send Money')
            </a>
            
    <div class="section section--sm">
        @if (auth()->user()->kv != 1)
            <div class="section__head">
                <div class="container">
                    <div class="row">
                        @if (auth()->user()->kv == 0)
                            <div class="col-12">
                                <div class="alert alert-info mb-0" role="alert">
                                    <h5 class="alert-heading m-0">@lang('KYC Verification Required')</h5>
                                    <hr>
                                    <p class="mb-0"> {{ __($kycInstruction->data_values->verification_instruction) }} <a href="{{ route('user.kyc.form') }}">@lang('Click Here to Verify')</a></p>
                                </div>
                            </div>
                        @elseif(auth()->user()->kv == 2)
                            <div class="col-12">
                                <div class="alert alert-warning mb-0" role="alert">
                                    <h5 class="alert-heading m-0">@lang('KYC Verification pending')</h5>
                                    <hr>
                                    <p class="mb-0"> {{ __($kycInstruction->data_values->pending_instruction) }} <a href="{{ route('user.kyc.data') }}">@lang('See KYC Data')</a></p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        <div class="section__head">
            <div class="container">
                <div class="row g-4 justify-content-center">

                    <div class="col-md-6 col-xl-4">
                        <div class="dashboard-card">
                            <div class="user align-items-center justify-content-center">
                                <div class="icon icon--lg icon--circle">
                                    <i class="fas fa-wallet"></i>
                                </div>
                                <div class="user__content">
                                    <p class="xl-text mb-0">
                                        <a href="{{ route('user.send.money.history') }}" class="t-link text--body">@lang('Balance')</a>
                                    </p>
                                    <h4 class="mt-2 mb-0">
                                        <a href="{{ route('user.send.money.history') }}" class="t-link text--body">
                                            {{ $general->cur_sym }}{{ showAmount($widget['balance']) }}
                                        </a>
                                    </h4>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <div class="dashboard-card">
                            <div class="user align-items-center justify-content-center">
                                <div class="icon icon--lg icon--circle">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                                <div class="user__content">
                                    <p class="xl-text text--white mb-0">
                                        <a href="{{ route('user.send.money.history') }}" class="t-link t-link--light text--white">
                                            @lang('Sent Amount')
                                        </a>
                                    </p>
                                    <h4 class="text--white mt-2 mb-0">
                                        <a href="{{ route('user.send.money.history') }}" class="t-link t-link--light text--white">
                                            {{ $general->cur_sym }}{{ showAmount($widget['send_money_amount']) }}
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <div class="dashboard-card">
                            <div class="user align-items-center justify-content-center">
                                <div class="icon icon--lg icon--circle">
                                    <i class="fas fa-coins"></i>
                                </div>
                                <div class="user__content">
                                    <p class="xl-text text--white mb-0">
                                        <a href="{{ route('user.send.money.history') }}" class="t-link t-link--light text--white">
                                            @lang('Unpaid')
                                        </a>
                                    </p>
                                    <h4 class="text--white mt-2 mb-0">
                                        <a href="{{ route('user.send.money.history') }}" class="t-link t-link--light text--white">
                                            {{ $general->cur_sym }}{{ showAmount($widget['unPaid']) }}
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row g-lg-3">
                <div class="col-12">
                    <div class="custom--table__header">
                        <h5 class="text-lg-start m-0 text-center">@lang('Recent Send Money Log')</h5>
                    </div>
                </div>
                <div class="col-12">
                    <div class="table-responsive--md">
                        <table class="custom--table table">
                            <thead>
                                <tr>
                                    <th>@lang('Time')</th>
                                    <th>@lang('Trx Number')</th>
                                    <th>@lang('Sent Amount')</th>
                                    <th>@lang('Recipient')</th>
                                    <th>@lang('Receivable Amount')</th>
                                    <th>@lang('Status')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($sendMoneys as $sendMoney)
                                    <tr>
                                        <td data-label="@lang('Time')"> {{ showDateTime($sendMoney->created_at) }} </td>
                                        <td data-label="@lang('Trx Number')"> {{ $sendMoney->trx }} </td>
                                        <td data-label="@lang('Sent Amount')"><strong>{{ showAmount($sendMoney->sending_amount) }} {{ __($sendMoney->sending_currency) }}</strong></td>
                                        <td data-label="@lang('Recipient')">{{ $sendMoney->recipient->name }}</td>
                                        <td data-label="@lang('Receivable Amount')">{{ showAmount($sendMoney->recipient_amount) }} {{ __($sendMoney->recipient_currency) }}</td>
                                        <td data-label="@lang('Status')">
                                            @if ($sendMoney->status == 1)
                                                <span class="badge badge--primary">@lang('Sent')</span>
                                            @elseif($sendMoney->status == 2)
                                                <span class="badge badge--success">@lang('Received')</span>
                                            @elseif($sendMoney->status == 3)
                                                <span class="badge badge--danger">@lang('Refunded')</span>
                                            @else
                                                <span class="badge badge--warning">@lang('Initiated')</span>
                                            @endif

                                            @if ($sendMoney->admin_feedback != null)
                                                <button class="btn-info btn-rounded badge feedbackBtn" data-admin_feedback="{{ $sendMoney->admin_feedback }}"><i class="fa fa-info"></i></button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%" class="text-muted text-center">{{ __($emptyMessage) }} </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- feedback MODAL --}}
    <div id="feedbackModal" class="modal custom--modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Feedback')</h5>
                    <button type="button" class="close btn btn--danger btn-sm close-button" data-bs-dismiss="modal" aria-label="Close">
                        <i class="la la-times" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <span class="admin_feedback"></span>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        (function($) {
            "use strict";
            $('.feedbackBtn').on('click', function() {
                var modal = $('#feedbackModal');
                modal.find('.admin_feedback').text($(this).data('admin_feedback'));
                modal.modal('show');
            });
        })(jQuery);
    </script>
@endpush

@push('style-lib')
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600&display=swap" rel="stylesheet">
@endpush
@push('style')
    <style>
        .dashboard-card .user__content h4 {
            font-family: "rajdhani", sans-serif;
            font-weight: 500;
        }
    </style>
@endpush
