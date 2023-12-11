@extends($activeTemplate . 'layouts.master')
@section('content')
    <section class="section section--sm">
        <div class="container">
            <div class="card custom--card">
                <div class="card-header">
                    <h5 class="card-title">{{ $pageTitle }}</h5>
                </div>
                <form action="{{ route('user.send.money.save') }}" method="post"
                    class="card-body container-fluid register">
                    @csrf
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="exchange-form">
                                <div class="exchange-form__body p-0">

                                    <div class="mb-3">
                                        <label for="you-send" class="text--accent sm-text d-block fw-md mb-2">@lang('You
                                            Send')</label>
                                        <div class="input-group">
                                            <input id="from" type="number" step="any"
                                                class="form-control form--control text--right sending-amount"
                                                value="{{ $sendingAmount }}" placeholder="0.00" name="sending_amount"
                                                required>
                                            <span class="sending-parent">
                                                <select name="sending_country" id="sending-country"
                                                    class="form-control form--control country-picker sending-countries">
                                                    @foreach ($countries as $country)
                                                        <option @selected($sendingCountry==$country->id)
                                                            value="{{ $country->id }}"
                                                            data-id="from{{ $country->id }}"
                                                            data-rate="{{ $country->rate }}"
                                                            data-currency="{{ $country->currency }}"
                                                            data-image="{{ asset(getFilePath('country') . '/' . $country->image) }}"
                                                            data-name="from{{ $country->name }}">
                                                            {{ $country->currency }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="you-send"
                                            class="text--accent sm-text d-block fw-md mb-2">@lang('Recipient Gets')</label>
                                        <div class="input-group">
                                            <input id="to" type="number" step="any"
                                                class="form-control form--control text--right recipient-amount"
                                                placeholder="0.00" value="{{ $recipientAmount }}" name="recipient_amount"
                                                required>

                                            <span class="recipient-parent">
                                                <select name="recipient_country" id="recipient-country"
                                                    class="form-control form--control country-picker recipient-countries">
                                                    @foreach ($countries as $country)
                                                        <option @selected($recipientCountry==$country->id)
                                                            value="{{ $country->id }}"
                                                            data-id="to{{ $country->id }}"
                                                            data-currency="{{ $country->currency }}"
                                                            data-rate="{{ $country->rate }}"
                                                            data-dial_code="{{ $country->dial_code }}"
                                                            data-fixed_charge="{{ $country->fixed_charge }}"
                                                            data-percent_charge="{{ $country->percent_charge }}"
                                                            data-image="{{ asset(getFilePath('country') . '/' . $country->image) }}"
                                                            data-name="to{{ $country->name }}">
                                                            {{ $country->currency }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="col-12 error-section d-none text-center">
                                    <small class="text-danger fw-bold error-text"></small>
                                </div>
                            </div>
                            
    
                                
                       




                            <div class="mb-3 mt-4">
                                <div class="border-line-area mt-3">
                                    <h6 class="border-line-title fw-bold">@lang('Recipient Information')</h6>
                                </div>
                                
                                <!--Ajout des champs correspondant aux information de lincgate !-->
                                
                            <div class="row">
  
                                <div class="col">
                                       <label for="recipient_name"
                                            class="text--accent sm-text d-block fw-md mb-2">@lang('Recipient Name')</label>
                                  
                                    <input id="recipient_name"  type="text" class="form-control" value="{{ old('recipient')['name'] ?? null }}"
                                    
                                    name="recipient[name]" required>
                                 
                                  </div>
 
                             <div class="col">
                                  <label for="recipient_name"
                                        class="text--accent sm-text d-block fw-md mb-2">@lang('Recipient LastName ')</label>
  
                                   <input id="recipient_name"  type="text" class="form-control" value="{{ old('recipient')['name'] ?? null }}"  name="recipient[name]" required>
                                   </div>
                                   
                                   
                                   </div>
                                   
                                   
                            <div class="row">
  
                                <div class="col">
                                       <label for="recipient_city"
                                            class="text--accent sm-text d-block fw-md mb-2">@lang('City')</label>
                                  
                                    <input id="recipient_city"  type="text" class="form-control" value="{{ old('recipient')['city'] ?? null }}"
                                    
                                    name="recipient[city]" required>
                                 
                                  </div>
 
                             <div class="col">
                                  <label for="recipient_locality"
                                        class="text--accent sm-text d-block fw-md mb-2">@lang('Locality')</label>
  
                                   <input id="recipient_locality"  type="text" class="form-control" value="{{ old('recipient')['locality'] ?? null }}"  name="recipient[locality]" required>
                                   </div>
                                   
                                   
                                   </div>
                                   
                            
                    <div class="row">
  
                        <div class="col">
                                          
                        <label for="recipient_address" class="text--accent sm-text d-block fw-md mb-2">{{ __('Recipient Address') }}</label>
                                  
                    <input  class="form-control" name="recipient[address]" value="{{ old('recipient')['address'] ?? null }}" id="recipient_address" required>
                                 
                        </div>
 
                             <div class="col">
                             <label for="recipient_country_code" class="text--accent sm-text d-block fw-md mb-2">@lang('Zip code')</label>
  
                             <input id="recipient_country_code"  type="text" class="form-control" value="{{ old('recipient')['country_code'] ?? null }}"  name="recipient[country_code]" required>
                            
                             </div>
                                   
                    </div>
                    

                    
                <div class="row">
  
                    
                     
                            
                         <div class="col-sm-6 col-xl-6 ">
                                <label for="mobile" class="form-label sm-text t-heading-font heading-clr fw-md">@lang('Mobile')</label>
                                <div class="input-group">
                                    <span class="input-group-text mobile-code">
                                    </span>
                                    <input type="hidden" name="mobile_code">
                                    <input type="hidden" name="country_code">
                                    <input type="number" name="mobile" id="mobile" value="{{ old('mobile') }}" class="form-control form--control checkUser">
                                </div>
                                <small class="text-danger mobileExist"></small>
                            </div>
                            
                            
                               <div class="col-sm-6 col-xl-6 ">
                                <label class="form-label sm-text t-heading-font heading-clr fw-md">
                                    @lang('Country')
                                </label>
                                <div class="input-group input--group">
                                    <span class="input-group-text">
                                        <i class="las la-globe"></i>
                                    </span>
                                    <div class="form--select-light">
                                        <select class="form-select form--select" name="country" aria-label="Default select example">
                                            @foreach ($countries_world as $key => $country)
                                                <option data-mobile_code="{{ $country->dial_code }}" value="{{ $country->country }}" data-code="{{ $key }}">{{ __($country->country) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                
                            </div>
                            
                            
                             </div>
                            
                            
                                   <div class="row">
  
                        <div class="col">
                                          
                          <label for="recipient_email" class="text--accent sm-text d-block fw-md mb-2">@lang('Email')</label>
                                  
                    <input  class="form-control" name="recipient[email]" value="{{ old('recipient')['email'] ?? null }}" id="recipient_email" required>
                                 
                        </div>
 
                        
                                   
                    </div>
                    
                    
                    
                                   
                                   
                                   
                                


                                <!--    <div class="mb-3">
                                        <label for="recipient_name"
                                            class="text--accent sm-text d-block fw-md mb-2">@lang('Recipient Name')</label>
                                        <input id="recipient_name" type="text" class="form-control form--control"
                                            value="{{ old('recipient')['name'] ?? null }}" name="recipient[name]" required>
                                    </div>
                                    
                                        
                                 <div class="mb-3">
                                    <label for="recipient_name"
                                        class="text--accent sm-text d-block fw-md mb-2">@lang('Recipient LastName ')</label>
                                    <input id="recipient_name" type="text" class="form-control form--control"
                                        value="{{ old('recipient')['name'] ?? null }}" name="recipient[name]" required>
                                </div>
                                
                                
                                   <div class="mb-3">
                                        <label for="recipient_name"
                                            class="text--accent sm-text d-block fw-md mb-2">@lang('City')</label>
                                        <input id="recipient_name" type="text" class="form-control form--control"
                                            value="{{ old('recipient')['name'] ?? null }}" name="recipient[name]" required>
                                    </div>
                                    
                                    
                                       <div class="mb-3">
                                        <label for="recipient_name"
                                            class="text--accent sm-text d-block fw-md mb-2">@lang('Locality')</label>
                                        <input id="recipient_name" type="text" class="form-control form--control"
                                            value="{{ old('recipient')['name'] ?? null }}" name="recipient[name]" required>
                                       </div>
                                
                            
                                
                                <div class="mb-3">
                                    <label for="recipient_address"
                                        class="text--accent sm-text d-block fw-md mb-2">{{ __('Recipient Address') }}</label>
                                    <input name="recipient[address]" value="{{ old('recipient')['address'] ?? null }}"
                                        id="recipient_address" class="form-control form--control-textarea">
                                </div>-->
                                
                                
                                
                    
                                <div class="mb-3">
                                    <label for="recipient_mode"
                                        class="text--accent sm-text d-block fw-md mb-2">@lang('Receiving Mode')</label>
                                    <div class="wrapper">
                                        <input type="radio"
                                            {{ old('receiving_mode') == 'mode__mobile' ? 'checked' : '' }}
                                            value="mode__mobile" class="none receiving__radio" name="receiving_mode"
                                            id="option-1">
                                        <input type="radio" {{ old('receiving_mode') == 'mode__card' ? 'checked' : '' }}
                                            value="mode__card" class="none receiving__radio" name="receiving_mode"
                                            id="option-2">
                                        <input type="radio" {{ old('receiving_mode') == 'mode__atm' ? 'checked' : '' }}
                                            value="mode__atm" class="none receiving__radio" name="receiving_mode"
                                            id="option-3">
                                        <label for="option-1" class="option option-1">
                                            <i class="la la-mobile fa-2x" aria-hidden="true"></i>
                                            {{ __('Mobile Wallet') }}
                                        </label>
                                        <label for="option-2" class="option option-2">
                                            <i class="las la-credit-card fa-2x"></i>
                                            {{ __('Card (Bank account)') }}
                                        </label>
                                        <label for="option-3" class="option option-3">
                                            <i class="la la-mobile fa-2x"></i>
                                            {{ __('Withdrawal without card') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="mode__contents">
                                    <div id="content_mode__mobile"
                                        class="{{ old('receiving_mode') != 'mode__mobile' ? 'none' : '' }}">
                                        <div class="mb-3">
                                            <label for="operator"
                                                class="text--accent sm-text d-block fw-md mb-2">@lang('Operator')</label>
                                            <div class="form--select-light">
                                                <select class="form-select form--select operation__select" name="operator"
                                                    id="operator" required>
                                                    <option value="mpesa">Mpesa</option>
                                                    <option value="orangemoney">Orange Money</option>
                                                    <option value="airtelmoney">Airtel Money</option>
                                                    <option value="afrimoney">AfriMoney</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="recipient_mobile"
                                                class="text--accent sm-text d-block fw-md mb-2">@lang('Recipient Mobile
                                                No.')</label>
                                            <div class="input-group">
                                                <span class="input-group-text">+243</span>

                                                <input id="recipient_mobile" type="number"
                                                    class="form-control form--control"
                                                    value="{{ old('recipient')['mobile'] ?? null }}"
                                                    name="recipient[mobile]">
                                                <span class="input-group-text phone-code operator__image"
                                                    style="background-image: url('/assets/images/mobile/mpesa.png'); width: 100px; background-size:cover; background-position: center">
                                                </span> 
                                            </div>
                                            <div class="mt-2" id="phone_error">
                                                <small class="text-danger fw-bold error-text"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="content_mode__atm"
                                        class="{{ old('receiving_mode') != 'mode__atm' ? 'none' : '' }}">
                                        <div class="mb-3">
                                            <label for="recipient_mobile_atm"
                                                class="text--accent sm-text d-block fw-md mb-2">@lang('Recipient Mobile
                                                No.')</label>
                                            <div class="input-group">
                                                <span class="input-group-text dial-code"></span>

                                                <input id="recipient_mobile_atm" type="number"
                                                    class="form-control form--control"
                                                    value="{{ old('recipient')['mobile_atm'] ?? null }}"
                                                    name="recipient[mobile_atm]">
                                                <span class="input-group-text phone-code operator__image"
                                                    style="background-image: url('/assets/images/mobile/equity.png'); width: 100px; background-size:cover; background-position: center">
                                                </span> 
                                            </div>
                                        </div>
                                    </div>
                                    <div id="content_mode__card"
                                        class="{{ old('receiving_mode') != 'mode__card' ? 'none' : '' }}">
                                        <div class="mb-3">
                                            <label for="recipient_card"
                                                class="text--accent sm-text d-block fw-md mb-2">@lang('Card
                                                Number.')</label>
                                            <div class="input-group">
                                                <!--<span class="input-group-text dial-code"> </span>-->

                                                <input id="recipient_card" type="number" class="form-control form--control"
                                                    value="{{ old('recipient')['card'] ?? null }}"
                                                    name="recipient[card]">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            
                            
                        </div>
                        <div class="col-lg-6">
                            <div class="ms-xxl-5">
                                <div class="recipient-info">
                               
                              
                                    <div class="mb-3">
                                        <label for="source_of_funds"
                                            class="text--accent sm-text d-block fw-md mb-2">@lang('Source of Funds')</label>
                                        <div class="form--select-light">
                                            <select class="form-select form--select" name="source_of_funds"
                                                id="source_of_funds" required>
                                                <option value="">@lang('Select One')</option>
                                                @foreach ($sources as $source)
                                                    <option value="{{ $source->id }}">{{ __($source->name) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                             
                                
                                    <div class="mb-3">
                                        <label for="source_purpose"
                                            class="text--accent sm-text d-block fw-md mb-2">@lang('Sending Purpose')</label>
                                        <div class="form--select-light">
                                            <select class="form-select form--select" name="sending_purpose"
                                                id="source_purpose">
                                                <option value="">@lang('Select One')</option>
                                                @foreach ($purposes as $purpose)
                                                    <option value="{{ $purpose->id }}">{{ __($purpose->name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="mb-3 mt-4">
                                    <ul class="list list--column payment-table">
                                       <li>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="d-block">
                                                    @lang('Charge')
                                                </span>
                                                <h6 class="fw-md heading-clr t-heading-font sm-text m-0">
                                                    <span class="charge-amount-text"></span>
                                                    <span class="sending-currency"></span>
                                                </h6>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="d-block t-heading-font heading-clr sm-text">
                                                    @lang('Final Amount')
                                                </span>
                                                <h5 class="sm-text m-0">
                                                    <span class="final-amount-text"></span>
                                                    <span class="sending-currency"></span>
                                                </h5>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="d-block sm-text">
                                                    @lang('In '){{ __($general->cur_text) }}
                                                </span>
                                                <h5 class="text--base sm-text m-0">
                                                    <span class="base-amount-text"></span>
                                                    <span>{{ __($general->cur_text) }}</span>
                                                </h5>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="mb-3">
                                    <h5 class="">@lang('Payment Via')</h5>
                                    <div class="d-flex flex-wrap gap-3">
                                        <label for="walletBtn" class="btn-selected__label flex-grow-1" data-value="1">
                                            <input type="radio" name="payment_type" value="1" id="walletBtn"
                                                data-balance="{{ auth()->user()->balance }}"
                                                class="btn-selected__input walletPayment">
                                            <span class="btn-selected btn-selected--primary">
                                                <span class="btn-selected__icon">
                                                    <img src="{{ getImage($activeTemplateTrue . 'images/wallet-icon.png') }}"
                                                        alt="" class="img-fluid">
                                                </span>
                                                <span class="btn-selected__text ">
                                                    {{ __($general->cur_text) }} @lang('Wallet')
                                                </span>
                                            </span>
                                        </label>
                                        <label for="directBtn" class="btn-selected__label flex-grow-1" data-value="2">
                                            <input type="radio" name="payment_type" value="2" id="directBtn"
                                                class="btn-selected__input directPayment" required>
                                            <div class="btn-selected btn-selected--secondary">
                                                <span class="btn-selected__icon">
                                                    <img src="{{ getImage($activeTemplateTrue . 'images/credit-card-icon.png') }}"
                                                        alt="" class="img-fluid">
                                                </span>
                                                <span class="btn-selected__text ">
                                                    @lang('Direct Payment')
                                                </span>
                                            </div>
                                        </label>
                                    </div>
                                    <small class="text--danger insufficientBalanceError d-none">@lang('You don\'t have
                                        sufficient balance. Your current balance is')
                                        {{ showAmount(auth()->user()->balance) }} {{ $general->cur_text }}</small>
                                </div>

                                <div class="col-12">
                                    <button type="submit"
                                        class="btn btn--base btn--xl w-100 formSubmitButton">@lang('Continue')</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script>
        (function($) {
            "use strict";
            let sender = $('.sending-parent').find('select');
            let receiver = $('.recipient-parent').find('select');

            let sendingAmount = `{{ $sendingAmount }}`;
            let recipientAmount = `{{ $recipientAmount }}`;

            var sendingCountry = sender.find(":selected");
            var recipientCountry = receiver.find(":selected");
            let displayError = false;
            let senderInput = false;
            let recipientInput = false;

            let charge = 0;
            var finalAmount = 0;
            var baseCurrencyAmount = 0;

            resetValues();
            // seDialCode();

            function seDialCode() {
                $('.dial-code').text('+' + receiver.find(':selected').data('dial_code'))
            }

            displayError = true;

            sender.on('change', function() {
                sendingCountry = $(this).find(":selected");
                resetValues();
            });

            receiver.on('change', function() {
                // seDialCode();
                recipientCountry = $(this).find(":selected");
                resetValues();
            });

            $(".sending-amount").on('input', function() {
                sendingAmount = $(this).val();
                recipientAmount = 0;
                senderInput = true;
                recipientInput = false;
                resetValues();
            });

            $(".recipient-amount").on('input', function() {
                recipientAmount = $(this).val();
                sendingAmount = 0;
                senderInput = false;
                recipientInput = true;
                resetValues();
            });

            function getCharge() {
                var fixedCharge = recipientCountry.data('fixed_charge');
                var percentCharge = recipientCountry.data('percent_charge');

                var sendingRate = sendingCountry.data('rate');
                var recipientRate = recipientCountry.data('rate');
                var conversionRate = recipientRate / sendingRate;

                if (sendingAmount) {
                    recipientAmount = (conversionRate * sendingAmount).toFixed(2);
                } else if (recipientAmount) {
                    sendingAmount = (recipientAmount / conversionRate).toFixed(2);
                } else {
                    sendingAmount = 0;
                    recipientAmount = 0;
                    return 0
                }
                return (((fixedCharge * 1) + ((recipientAmount * percentCharge) / 100)) * (sendingRate / recipientRate))
                    .toFixed(2);
            }

            function resetValues() {
                charge = getCharge() * 1;
                finalAmount = charge + parseFloat(sendingAmount);
                baseCurrencyAmount = finalAmount / sendingCountry.data('rate');
                updateDom();

                if (!sendingAmount && !recipientAmount) {
                    $('.sending-amount').val('');
                    $('.recipient-amount').val('');

                    if (displayError) {
                        showError();
                    }

                    sendingAmount = 0;
                    recipientAmount = 0;
                }
            }

            function updateDom() {
                $('.error-section').addClass('d-none');
                if (recipientInput) {
                    $('.sending-amount').val(sendingAmount ? sendingAmount : null);
                } else if (senderInput) {
                    $('.recipient-amount').val(recipientAmount ? recipientAmount : null);
                }
                $('.sending-currency').text(sendingCountry.data('currency'));
                $('.recipient-currency').text(recipientCountry.data('currency'));
                $('.charge-amount-text').text(charge);
                $('.base-amount-text').text(baseCurrencyAmount.toFixed(2));
                $('.final-amount-text').text(finalAmount.toFixed(2));
            }

            function showError() {
                $('.error-text').text('Please Enter an amount');
                $('.error-section').removeClass('d-none');
            }

            disableSelectedCountry();

            $('.sending-currency').text(sender.find(":selected").data('currency'));
            $('.recipient-currency').text(receiver.find(":selected").data('currency'));

            function disableSelectedCountry() {
                sender.find(':disabled').removeAttr('disabled')
                receiver.find(':disabled').removeAttr('disabled')
                let selectedSenderID = sender.find(':selected').data('id');
                let selectedReceiverID = receiver.find(':selected').data('id');
                sender.find(`[data-id=${selectedReceiverID}]`).attr('disabled', 'disabled');
                receiver.find(`[data-id=${selectedSenderID}]`).attr('disabled', 'disabled');
            }

            // Change Flags on load
            function formatState(state) {
                if (!state.id) return state.text;
                return $('<img  src="' + $(state.element).data('image') + '"/> <span >' + state.text + '</span>');
            }

            $('.country-picker').select2({
                templateResult: formatState
            });

            $('.country-picker').on('change', function() {
                disableSelectedCountry();
                changeSelectedCountryFlag();
            });

            // Change Flags on load
            changeSelectedCountryFlag();

            function changeSelectedCountryFlag() {
                $('.sending-parent .select2-selection__rendered').html(flagImageHtml(sender.find(':selected')));
                $('.recipient-parent .select2-selection__rendered').html(flagImageHtml(receiver.find(':selected')));
            }

            function flagImageHtml(data) {
                return `<img class="exchange-form__flags" src="${data.data('image')}" class="state-flags"/> ${data.text()}`
            }

            $('.walletPayment').on('click', function() {
                var balance = $(this).data('balance');
                var finalAmount = parseInt($('.final-amount-text').text());
                if (finalAmount > balance) {
                    $('.insufficientBalanceError').removeClass('d-none').fadeIn();
                } else {
                    $('.insufficientBalanceError').fadeOut().addClass('d-none');
                }
            });
            $('.directPayment').on('click', function() {
                $('.insufficientBalanceError').fadeOut().addClass('d-none');
            });
            $('.formSubmitButton').on('click', function() {
                var paymentType = $('[name=payment_type]:checked').val();
                console.log(paymentType);
                if (!paymentType) {
                    notify('error', 'Please select a payment type')
                }
            });

            $('select[name=country]').change(function() {
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
            });
            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
            
        })(jQuery);

    </script>
@endpush
@push('style')
    <style>
        .exchange-form {
            box-shadow: none;
        }

        .select2-container--default .select2-results__option[aria-disabled=true] {
            display: none;
        }

    </style>
@endpush
