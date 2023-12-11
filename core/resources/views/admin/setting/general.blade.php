@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <form action="" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label> @lang('Site Title')</label>
                                    <input class="form-control" type="text" name="site_name" required value="{{ $general->site_name }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label>@lang('Currency')</label>
                                    <input class="form-control" type="text" name="cur_text" required value="{{ $general->cur_text }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label>@lang('Currency Symbol')</label>
                                    <input class="form-control" type="text" name="cur_sym" required value="{{ $general->cur_sym }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label> @lang('Fixed Commission')</label>
                                    <div class="input-group">
                                        <input class="form-control " type="text" name="fixed_commission" value="{{ getAmount($general->fixed_commission, 8) }}">
                                        <div class="input-group-text cur_text">
                                            {{ $general->cur_text }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label>@lang('Percent Commission') </label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="percent_commission" value="{{ getAmount($general->percent_commission, 8) }}">
                                        <span class="input-group-text">
                                            %
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label>@lang('SMS Code Duration') </label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="resent_code_duration" value="{{ $general->resent_code_duration }}">
                                        <span class="input-group-text">
                                            @lang('Seconds')
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4 col-sm-6">
                                <label> @lang('Timezone')</label>
                                <div class="agent-selector">
                                    <select class="select2-basic" name="timezone">
                                        @foreach ($timezones as $timezone)
                                            <option value="'{{ @$timezone }}'">{{ __($timezone) }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="form-group col-md-4 col-sm-6">
                                <label> @lang('Site Base Color')</label>
                                <div class="input-group">
                                    <span class="input-group-text p-0 border-0">
                                        <input type='text' class="form-control colorPicker" value="{{ $general->base_color }}" />
                                    </span>
                                    <input type="text" class="form-control colorCode" name="base_color" value="{{ $general->base_color }}" />
                                </div>
                            </div>

                            <div class="form-group col-md-4 col-sm-6">
                                <label>@lang('Force Secure Password') <span class="text--primary" title="@lang('If you enable this, users have to set secure password.')"><i class="fas fa-info-circle"></i></span></label>
                                <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle" data-height="50" data-on="@lang('Enable')" data-off="@lang('Disabled')" name="secure_password" @if ($general->secure_password) checked @endif>
                            </div>
                            <div class="form-group col-md-4 col-sm-6">
                                <label>@lang('Agree Policy') <span class="text--primary" title="@lang('If you enable this, users have to agree with all policies to be registered.')"><i class="fas fa-info-circle"></i></span></label>
                                <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle" data-height="50" data-on="@lang('Enable')" data-off="@lang('Disabled')" name="agree" @if ($general->agree) checked @endif>
                            </div>
                            <div class="form-group col-md-4 col-sm-6">
                                <label>@lang('User Registration')</label>
                                <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle" data-height="50" data-on="@lang('Enable')" data-off="@lang('Disabled')" name="registration" @if ($general->registration) checked @endif>
                            </div>

                            <div class="form-group col-md-4 col-sm-6">
                                <label>@lang('Force SSL')</label>
                                <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle" data-height="50" data-on="@lang('Enable')" data-off="@lang('Disabled')" name="force_ssl" @if ($general->force_ssl) checked @endif>
                            </div>
                            <div class="form-group col-md-4 col-sm-6">
                                <label> @lang('KYC Verification')</label>
                                <a href="{{ route('admin.kyc.setting.module') }}" class="float-end">@lang('KYC Modules')</a>
                                <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle" data-height="50" data-on="@lang('Enable')" data-off="@lang('Disable')" name="kv" @if ($general->kv) checked @endif>
                            </div>
                            <div class="form-group col-md-4 col-sm-6">
                                <label> @lang('Email Verification')</label>
                                <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle" data-height="50" data-on="@lang('Enable')" data-off="@lang('Disable')" name="ev" @if ($general->ev) checked @endif>
                            </div>
                            <div class="form-group col-md-4 col-sm-6">
                                <label>@lang('Email Notification')</label>
                                <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle" data-height="50" data-on="@lang('Enable')" data-off="@lang('Disable')" name="en" @if ($general->en) checked @endif>
                            </div>
                            <div class="form-group col-md-4 col-sm-6">
                                <label> @lang('Mobile Verification')</label>
                                <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle" data-height="50" data-on="@lang('Enable')" data-off="@lang('Disable')" name="sv" @if ($general->sv) checked @endif>
                            </div>
                            <div class="form-group col-md-4 col-sm-6">
                                <label>@lang('SMS Notification')</label>
                                <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle" data-height="50" data-on="@lang('Enable')" data-off="@lang('Disable')" name="sn" @if ($general->sn) checked @endif>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script-lib')
    <script src="{{ asset('assets/admin/js/spectrum.js') }}"></script>
@endpush

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/spectrum.css') }}">
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.colorPicker').spectrum({
                color: $(this).data('color'),
                change: function(color) {
                    $(this).parent().siblings('.colorCode').val(color.toHexString().replace(/^#?/, ''));
                }
            });

            $('.colorCode').on('input', function() {
                var clr = $(this).val();
                $(this).parents('.input-group').find('.colorPicker').spectrum({
                    color: clr,
                });
            });

            $('select[name=timezone]').val("'{{ config('app.timezone') }}'").select2();
            $('.select2-basic').select2({
                dropdownParent: $('.card-body')
            });
        })(jQuery);
    </script>
@endpush
