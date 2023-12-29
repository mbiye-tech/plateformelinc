@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table">
                            <thead>
                                <tr>
                                    <th>@lang('S.N.')</th>
                                    <th class="text-start">@lang('Name')</th>
                                    <th>@lang('Currency')</th>
                                    <th>@lang('Rate')</th>
                                    <th>@lang('Charge')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($countries as $country)
                                    <tr>
                                        <td data-label="@lang('S.N.')">{{ $countries->firstItem() + $loop->index }}</td>
                                        <td data-label="@lang('Name')" class="text-start">
                                            <span class="user">
                                                <span class="thumb me-2">
                                                    <img src="{{ getImage(getFilePath('country') . '/' . $country->image, getFileSize('country')) }}" alt="image">
                                                </span>
                                                {{ $country->name }}
                                            </span>
                                        </td>
                                        <td data-label="@lang('Currency')">{{ $country->currency }}</td>
                                        <td data-label="@lang('Rate')"> {{ currencyFormatter($country->rate) }} {{ $country->currency }} / {{ $general->cur_text }}
                                        </td>

                                        <td data-label="@lang('Charge')">
                                            {{ currencyFormatter($country->fixed_charge) }} {{ $country->currency }} +
                                            {{ currencyFormatter($country->percent_charge) }}%
                                        </td>

                                        <td data-label="@lang('Status')">
                                            @php
                                                echo $country->statusBadge;
                                            @endphp
                                        </td>

                                        @php
                                            $country->rate = currencyFormatter($country->rate);
                                            $country->fixed_charge = currencyFormatter($country->fixed_charge);
                                            $country->percent_charge = currencyFormatter($country->percent_charge);
                                        @endphp

                                        <td data-label="@lang('Action')">
                                            <button class="btn btn-sm btn-outline--primary cuModalBtn ml-1" data-modal_title="@lang('Update Country')" data-resource="{{ $country }}" data-has_status="true"><i class="las la-pen"></i>
                                                @lang('Edit')</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%" class="text-center">
                                            {{ __($emptyMessage) }}
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                @if ($countries->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($countries) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    {{-- ADD METHOD MODAL --}}
    <div id="cuModal" class="modal fade">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="{{ route('admin.country.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>@lang('Country') </label>
                                <select name="country_code" class="form-control select2-basic" required>
                                    <option value="" disabled>@lang('Select One')</option>
                                    @foreach ($countryList as $shortCode => $countryData)
                                        <option value="{{ $shortCode }}" data-currency="{{ $countryData->currency->code }}" @if (old('country_code') == $shortCode) selected @endif>{{ $countryData->country }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>@lang('Currency') </label>
                                <input type="text" class="form-control" name="currency" value="{{ old('currency') }}" readonly />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>@lang('Image') </label>
                                <input type="file" class="form-control" name="image" accept=".png,.jpg,.jpeg" value="{{ old('image') }}" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>@lang('Rate')</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        1 {{ $general->cur_text }} =
                                    </span>
                                    <input type="number" step="any" class="form-control" name="rate" value="{{ old('rate') }}" required />
                                    <span class="input-group-text currency">
                                        {{ old('currency') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>@lang('Fixed Charge') </label>
                                <div class="input-group">
                                    <input type="number" step="any" class="form-control" name="fixed_charge" value="{{ old('fixed_charge') }}" required />
                                    <span class="input-group-text currency">
                                        {{ old('currency') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>@lang('Percent Charge') </label>
                                <div class="input-group">
                                    <input type="number" step="any" class="form-control" name="percent_charge" value="{{ old('percent_charge') }}" required />
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="status">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <div class="top--control d-flex justify-content-end flex-wrap gap-2">
        <form action="" method="GET" class="float-sm-right">
            <div class="input-group">
                <input type="text" name="search" class="form-control bg--white" placeholder="@lang('Name') / @lang('Currency')" value="{{ request()->search ?? '' }}">
                <button type="submit" class="input-group-text btn--primary border-0 text-white"><i class="fa fa-search"></i></button>
            </div>
        </form>

        <button type="button" class="btn btn-sm btn-outline--primary cuModalBtn h-45" data-modal_title="@lang('Add New Country')"><i class="las la-plus"></i>@lang('Add New')</button>
    </div>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";

            $('input[name=currency]').on('input', function() {
                $('.currency').text($(this).val());
            });

            $('.cuModalBtn').on('click', function() {
                var countryCode = '';

                if ($(this).data('resource')) {
                    countryCode = $(this).data('resource').country_code;
                    $('.currency').text($(this).data('resource').currency);
                }

                @if (!old('currency'))
                    else {
                        $('.currency').text('');
                    }
                @endif

                $(".select2-basic").val(countryCode).select2({
                    dropdownParent: $('#cuModal')
                });
            });

            $('select[name=country_code]').on('change', function() {
                $('input[name=currency]').val($(this).find(':selected').data('currency'));
                $('.currency').text($(this).find(':selected').data('currency'));
            });

        })(jQuery);
    </script>
@endpush
@push('style')
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

    </style>
@endpush
