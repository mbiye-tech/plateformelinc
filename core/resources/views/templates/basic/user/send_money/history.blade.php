@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="section section--sm">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-lg-3 flex-row-reverse flex-wrap">
                <div class="text-end">
                    <a href="{{ route('user.send.money.now') }}" class="btn btn-sm btn--base mb-2"> <i class="fa fa-plus"></i> @lang('Send New')</a>
                </div>
                <div class="custom--table__header">
                    <h5 class="text-lg-start m-0 text-center">{{ __($pageTitle) }}</h5>
                </div>
            </div>
            <div class="table-responsive--md">
                <table class="custom--table table">
                    <thead>
                        <tr>
                            <th>@lang('Trx ID')</th>
                            <th>@lang('Sent Amount') </th>
                            <th>@lang('Recipient')</th>
                            <th>@lang('Receivable')</th>
                            <th>@lang('Send | Received')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transfers as $transfer)
                            <tr>
                                <td data-label="@lang('Trx')">{{ $transfer->trx }}</td>
                                <td data-label="@lang('Sent Amount')">
                                    <strong>{{ showAmount($transfer->sending_amount) }} {{ __($transfer->sending_currency) }}</strong>
                                </td>
                                <td data-label="@lang('Recipient')">
                                    {{ $transfer->recipient->name }}
                                    <br>
                                    {{ __($transfer->recipient_country) }}
                                </td>
                                <td data-label="@lang('Receivable')">
                                    {{ showAmount($transfer->recipient_amount) }} {{ __($transfer->recipient_currency) }}
                                </td>
                                <td data-label="@lang('Send | Received')">
                                    {{ showDateTime($transfer->created_at, 'd M, y h:i a') }}
                                    <br />
                                    {{ $transfer->received_at ? showDateTime($transfer->received_at, 'd M, y h:i a') : 'N/A' }}
                                </td>
                                <td data-label="Status">
                                    @if ($transfer->status == 1)
                                        <span class="badge badge--primary">@lang('Sent')</span>
                                    @elseif($transfer->status == 2)
                                        <span class="badge badge--success">@lang('Received')</span>
                                    @elseif($transfer->status == 3)
                                        <span class="badge badge--danger">@lang('Refunded')</span>
                                    @elseif($transfer->status == 4)
                                        <span class="badge badge--info">@lang('Payment Pending')</span>
                                    @else
                                        <span class="badge badge--warning">@lang('Initiated')</span>
                                    @endif

                                    @if ($transfer->admin_feedback != null)
                                        <button class="btn-info btn-rounded badge feedbackBtn" data-admin_feedback="{{ $transfer->admin_feedback }}"><i class="fa fa-info"></i></button>
                                    @endif
                                </td>
                                @php
                                    $details = $transfer->detail != null ? json_encode($transfer->detail) : null;
                                @endphp

                                <td data-label="@lang('Action')">
                                    <button class="btn btn--base btn-sm detailBtn" data-info="{{ $details }}" data-id="{{ encrypt($transfer->id) }}" data-name="{{ $transfer->recipient->name }}" data-mobile="{{ $transfer->recipient->mobile }}" data-address="{{ $transfer->recipient->address }}" data-country="{{ $transfer->recipient_country }}" data-trx="{{ $transfer->trx }}" data-status="{{ $transfer->status }}">
                                        <i class="fa fa-desktop"></i>
                                    </button>
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
            <div class="d-flex justify-content-end mt-3">
                @if ($transfers->hasPages())
                    {{ paginateLinks($transfers) }}
                @endif
            </div>
        </div>
    </div>

    {{-- Details MODAL --}}
    <div id="detailsModal" class="modal custom--modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Details')</h5>
                    <button type="button" class="close btn btn--danger btn-sm close-button" data-bs-dismiss="modal" aria-label="Close">
                        <i class="la la-times" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">@lang('Recipient Name') : <span class="name fw-bold"></span></li>
                        <li class="list-group-item d-flex justify-content-between">@lang('Recipient Number') : <span class="mobile fw-bold"></span></li>
                        <li class="list-group-item d-flex justify-content-between">@lang('Recipient Address') : <span class="address fw-bold"></span></li>
                        <li class="list-group-item d-flex justify-content-between">@lang('Recipient Country') : <span class="country fw-bold"></span></li>
                        <li class="list-group-item d-flex justify-content-between">@lang('Transaction No') : <span class="trx fw-bold"></span></li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('user.send.money.pay') }}" method="POST" class="w-100">
                        @csrf
                        <input type="hidden" name="id">
                        <button class="btn btn--base w-100 btn--xl">
                            @lang('Pay Now')
                        </button>
                    </form>
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
            $('.detailBtn').on('click', function() {
                var modal = $('#detailsModal');
                modal.find('.name').text($(this).data('name'));
                modal.find('.mobile').text($(this).data('mobile'));
                modal.find('.country').text($(this).data('country'));
                modal.find('.address').text($(this).data('address'));
                modal.find('.trx').text($(this).data('trx'));
                if ($(this).data('status') == 0) {
                    modal.find('.modal-footer form [name=id]').val($(this).data('id'));
                    modal.find('.modal-footer form :submit').removeAttr('disabled');
                    modal.find('.modal-footer').show();
                } else {
                    modal.find('.modal-footer form [name=id]').val('');
                    modal.find('.modal-footer').hide();
                }
                modal.modal('show');
            });
            $('.feedbackBtn').on('click', function() {
                var modal = $('#feedbackModal');
                modal.find('.admin_feedback').text($(this).data('admin_feedback'));
                modal.modal('show');
            });
        })(jQuery);
    </script>
@endpush
