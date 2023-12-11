@extends('agent.layouts.app')

@section('panel')
    <div class="mt-5">
        @php $kycInstruction = getContent('kyc_instruction_user.content', true); @endphp
        <!-- kyc start -->
        <div class="mb-30">
            @if (authAgent()->kv == 0)
                <div class="alert alert-info p-4" role="alert">
                    <h4 class="alert-heading">@lang('KYC Verification Required')</h4>
                    <hr>
                    <p class="mb-0"> {{ __($kycInstruction->data_values->verification_instruction) }} <a href="{{ route('agent.kyc.form') }}">@lang('Click Here to Verify')</a></p>
                </div>
            @elseif(authAgent()->kv == 2)
                <div class="alert alert-warning p-4" role="alert">
                    <h4 class="alert-heading">@lang('KYC Verification pending')</h4>
                    <hr>
                    <p class="mb-0"> {{ __($kycInstruction->data_values->pending_instruction) }} <a href="{{ route('agent.kyc.data') }}">@lang('See KYC Data')</a></p>
                </div>
            @endif
        </div>
        <!-- kyc end -->
        <!-- widget start -->
        <div class="row gy-4 mb-5">
            <div class="col-lg-3 col-md-6">
                <div class="d-widget curve--shape">
                    <div class="d-widget__content">
                        <i class="las la-wallet"></i> @lang('USD Balance')
                        <h2 class="d-widget__amount fw-normal">{{ showAmount($widget['balance']) }} {{ $general->cur_text }}</h2>
                    </div>

                </div><!-- d-widget end -->
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-widget curve--shape">
                    <div class="d-widget__content">
                        <i class="las la-store"></i> @lang('Pending Deposits')
                        <h2 class="d-widget__amount fw-normal">{{ $widget['pending_deposit'] }}</h2>
                    </div>

                </div><!-- d-widget end -->
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-widget curve--shape">
                    <div class="d-widget__content">
                        <i class="las la-hand-holding-usd"></i> @lang('Pending Withdrawals')
                        <h2 class="d-widget__amount fw-normal">{{ $widget['pending_withdraw'] }}</h2>
                    </div>

                </div><!-- d-widget end -->
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-widget curve--shape">
                    <div class="d-widget__content">
                        <i class="la la-exchange-alt"></i> @lang('Total Transactions')
                        <h2 class="d-widget__amount fw-normal">{{ $widget['total_transaction'] }}</h2>
                    </div>

                </div><!-- d-widget end -->
            </div>
        </div><!-- widget end -->
        <!-- chart start -->
        <div class="row gy-4 mb-3">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d">
                            <h5 class="card-title">@lang('Monthly  Transaction Report')</h5>
                        </div>
                        <div id="apex-line"> </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="row align-items-center mb-3">
                    <div class="col-6">
                        <h6 class="fw-normal">@lang('Insights')</h6>
                    </div>
                    <div class="col-6 text-end">
                        <div class="dropdown custom--dropdown has--arrow">
                            <button class="text-btn dropdown-toggle font-size--14px text--base" type="button" id="latestActivitiesButton" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ __($insights['duration']) }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="latestActivitiesButton">
                                <li><a class="dropdown-item money" href="{{ route('agent.dashboard') }}">@lang('Today')</a></li>
                                <li><a class="dropdown-item money" href="{{ route('agent.dashboard', 'last-week') }}">@lang('Last week')</a></li>
                                <li><a class="dropdown-item money" href="{{ route('agent.dashboard', 'last-15-days') }}">@lang('Last 15 days')</a></li>
                                <li><a class="dropdown-item money" href="{{ route('agent.dashboard', 'last-month') }}">@lang('Last month')</a></li>
                                <li><a class="dropdown-item money" href="{{ route('agent.dashboard', 'last-year') }}">@lang('Last year')</a></li>
                            </ul>
                        </div>
                    </div>
                </div><!-- row end -->
                <div class="row mb-4">
                    <div class="col-sm-6 mb-3">
                        <div class="custom--card">
                            <div class="card-body">
                                <h6 class="font-size--16px mb-4">@lang('Total Payout') <small class="text--muted last-time">( {{ __($insights['duration']) }} )</small></h6>
                                <h3 class="title fw-normal money-in">{{ $general->cur_sym }}{{ showAmount($insights['payouts']) }}</h3>
                                <span class="text-muted font-size--14px">@lang('Total amount converted in') {{ $general->cur_text }}</span>
                                <div class="d-flex align-items-center justify-content-between mt-4 flex-wrap">
                                    <a href="{{ route('agent.payout.history') }}" class="font-size--14px fw-bold">@lang('View Payouts')</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="custom--card">
                            <div class="card-body">
                                <h6 class="font-size--16px mb-4">@lang('Total Sent Money') <small class="text--muted last-time">( {{ __($insights['duration']) }} )</small> </h6>
                                <h3 class="title fw-normal money-out">{{ $general->cur_sym }}{{ showAmount($insights['sent_amounts']) }}</h3>
                                <span class="text-muted font-size--14px">@lang('Total amount converted in') {{ $general->cur_text }}</span>
                                <div class="d-flex align-items-center justify-content-between mt-4 flex-wrap">
                                    <a href="{{ route('agent.transfer.history') }}" class="font-size--14px fw-bold">@lang('View Send Moneys')</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="my-2">@lang('Deposits & Withdrawn')</p>
                    <div class="col-sm-6">
                        <div class="custom--card">
                            <div class="card-body">
                                <h6 class="font-size--16px mb-4">@lang('Total Deposits') <small class="text--muted last-time">( {{ __($insights['duration']) }} )</small> </h6>
                                <h3 class="title fw-normal">{{ $general->cur_sym }}{{ showAmount($insights['deposits']) }}</h3>

                                <div class="d-flex align-items-center justify-content-between mt-4 flex-wrap">

                                    <a href="{{ route('agent.deposit.history') }}" class="font-size--14px fw-bold">@lang('View Deposits')</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="custom--card">
                            <div class="card-body">
                                <h6 class="font-size--16px mb-4">@lang('Total Withdrawn') <small class="text--muted last-time">( {{ __($insights['duration']) }} )</small> </h6>
                                <h3 class="title fw-normal">{{ $general->cur_sym }}{{ showAmount($insights['withdraws']) }}</h3>

                                <div class="d-flex align-items-center justify-content-between mt-4 flex-wrap">

                                    <a href="{{ route('agent.withdraw.history') }}" class="font-size--14px fw-bold">@lang('View Withdrawals')</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- chart end -->
        @if ($transactions)
            <!-- transaction table start -->

            <div class="accordion table--acordion" id="transactionAccordion">

                <h6 class="p-3">@lang('Latest Transactions')</h6>

                @forelse ($transactions as $transaction)
                    <div class="accordion-item transaction-item {{ $transaction->trx_type == '-' ? 'sent-item' : 'rcv-item' }}">
                        <h2 class="accordion-header" id="h-{{ $loop->iteration }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c-{{ $loop->iteration }}" aria-expanded="false" aria-controls="c-1">
                                <div class="col-lg-3 col-sm-4 col-6 icon-wrapper order-1">
                                    <div class="left">
                                        <div class="icon">
                                            <i class="las la-long-arrow-alt-right"></i>
                                        </div>
                                        <div class="content">
                                            <h6 class="trans-title">{{ __(ucwords($transaction->remark)) }}</h6>
                                            <span class="text-muted font-size--14px mt-2">{{ showDateTime($transaction->created_at, 'M d Y @g:ia') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-5 col-12 order-sm-2 content-wrapper mt-sm-0 order-3 mt-3">
                                    <p class="text-muted font-size--14px"><b>{{ __($transaction->details) }}</b></p>
                                </div>
                                <div class="col-lg-3 col-sm-3 col-6 order-sm-3 text-end amount-wrapper order-2">
                                    <p><b>{{ showAmount($transaction->amount) }} {{ $general->cur_text }}</b></p>
                                </div>
                            </button>
                        </h2>
                        <div id="c-{{ $loop->iteration }}" class="accordion-collapse collapse" aria-labelledby="h-1" data-bs-parent="#transactionAccordion">
                            <div class="accordion-body">
                                <ul class="caption-list">
                                    <li>
                                        <span class="caption">@lang('Transaction ID')</span>
                                        <span class="value">{{ $transaction->trx }}</span>
                                    </li>
                                    <li>
                                        <span class="caption">@lang('Transacted Amount')</span>
                                        <span class="value"> {{ $transaction->trx_type }} {{ showAmount($transaction->amount) }} {{ $general->cur_text }}</span>
                                    </li>
                                    <li>
                                        <span class="caption">@lang('Remaining Balance')</span>
                                        <span class="value">{{ showAmount($transaction->post_balance) }} {{ $general->cur_text }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- transaction-item end -->
                @empty
                    <div class="accordion-body text-center">
                        <h4 class="text--muted">@lang('No transaction found')</h4>
                    </div>
                @endforelse
            </div>
            <!-- transaction table end -->
        @endif
    </div>
@endsection
@push('script')
    <script src="{{ asset('/assets/global/js/apexcharts.min.js') }}"></script>
    <script>
        'use strict';
        (function($) {
            $('.reason').on('click', function() {
                $('#reasonModal').find('.reason').text($(this).data('reasons'))
                $('#reasonModal').modal('show')
            });
        })(jQuery);



        var options = {
            chart: {
                height: 376,
                type: "area",
                toolbar: {
                    show: false
                },
                dropShadow: {
                    enabled: true,
                    enabledSeries: [0],
                    top: -2,
                    left: 0,
                    blur: 10,
                    opacity: 0.08
                },
                animations: {
                    enabled: true,
                    easing: 'linear',
                    dynamicAnimation: {
                        speed: 1000
                    }
                },
            },
            dataLabels: {
                enabled: false
            },
            colors: ["#2E93fA"],
            series: [{
                name: "Charges",
                data: @json($report['trx_amount'])
            }],

            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.9,
                    stops: [0, 90, 100]
                }
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "{{ __($general->cur_sym) }}" + val + " "
                    }
                }
            },
            xaxis: {
                categories: @json($report['trx_dates'])
            },
            grid: {
                padding: {
                    left: 5,
                    right: 5
                },
                xaxis: {

                    lines: {
                        show: true
                    }
                },
                yaxis: {
                    lines: {
                        show: true
                    }
                },
            },
        };

        var chart = new ApexCharts(document.querySelector("#apex-line"), options);
        chart.render()
    </script>
@endpush
