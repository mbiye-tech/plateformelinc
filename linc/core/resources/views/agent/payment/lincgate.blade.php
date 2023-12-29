@extends($activeTemplate . 'layouts.master')
@section('content')
    <section class="section section--sm">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card custom--card">
                <div class="card-header">
                    <h5 class="card-title">@lang('LincGate Payment')</h5>
                </div>
                <ul class="list-group text-center list-group-flush">
                                <li class="list-group-item d-flex justify-content-between">
                                    @lang('You have to pay'):
                                    <strong>{{ showAmount($deposit->final_amo) }} {{ __($deposit->method_currency) }}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    @lang('You will get'):
                                    <strong>{{ showAmount($deposit->amount) }} {{ __($general->cur_text) }}</strong>
                                </li>
                            </ul>
                <form action="#" method="post"
                    class="card-body container-fluid register">
                    @csrf
                    <div class="row g-4">
                            <div class="mb-3 mt-4">
                                <div class="mb-3">
                                    <label for="recipient_mode"
                                        class="text--accent sm-text d-block fw-md mb-2">@lang('Sending Mode')</label>
                                    <div class="wrapper">
                                        <input type="radio"
                                            {{ old('receiving_mode') == 'mode__mobile' ? 'checked' : '' }}
                                            value="mode__mobile" class="none receiving__radio" name="receiving_mode"
                                            id="option-1">
                                        <input type="radio" {{ old('receiving_mode') == 'mode__card' ? 'checked' : '' }}
                                            value="mode__card" class="none receiving__radio" name="receiving_mode"
                                            id="option-2">
                                        <label for="option-1" class="option option-1" >
                                            <i class="la la-mobile fa-2x" aria-hidden="true"></i>
                                            {{ __('Mobile Wallet') }}
                                        </label>
                                        <label for="option-2" class="option option-2" >
                                            <i class="las la-credit-card fa-2x"></i>
                                            {{ __('Card (Bank account)') }}
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
                                                <span class="input-group-text dial-code"></span>

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
                                    <div id="content_mode__card"
                                        class="{{ old('receiving_mode') != 'mode__card' ? 'none' : '' }}">
                                            <label class="d-block sm-text mb-2">@lang('Card Number')</label>
                                            <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-credit-card"></i></span>
                                            <input type="text" class="form-control form--control" name="cardNumber" id="cardNumber" autocomplete="off" value="{{ old('cardNumber') }}" required autofocus />
                                            </div>
                                            
                                            <label class="d-block sm-text mb-2">@lang('Expiration Month')</label>
                                            <div class="input-group">
                                            <span class="input-group-text">MM</span>
                                            <input type="number" min="01" max="12" class="form-control form--control" name="cardExpiryMonth" id="cardExpiryMonth" value="{{ old('cardExpiryMonth') }}" autocomplete="off" required />
                                            </div>
                                            
                                            <label class="d-block sm-text mb-2">@lang('Expiration Year')</label>
                                            <div class="input-group">
                                            <span class="input-group-text">YYYY</span>
                                            <input type="number" min="2010" max="2050" class="form-control form--control" name="cardExpiryYear" id="cardExpiryYear" value="{{ old('cardExpiryYear') }}" autocomplete="off" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                            <button type="button"
                                        class="btn btn--base btn--xl w-100" id="btn-confirm">@lang('Pay Now')
                                        <div class="spinner-border spinner-border-sm d-none" id="loading" role="status">
                                          <span class="sr-only">Loading...</span>
                                        </div>
                            </button>
                        </div>
                </form>
            </div>
        </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        (function($) {
            "use strict";
            var btn = document.querySelector("#btn-confirm");
            
            var cardNumber = document.querySelector("#cardNumber");
            var cardExpirationYear = document.querySelector("#cardExpiryYear");
            var cardExpirationMonth = document.querySelector("#cardExpiryMonth");
            
            btn.setAttribute("type", "button");
            const API_publicKey = "{{ $data->Api_Key }}";
            let user = {!!json_encode($deposit->user)!!};
            let sendMoney = {!!json_encode($deposit->sendMoney)!!};
            let data = {!!json_encode($data)!!};
            
            function useCreateTransaction()
            {
                
                const loading = false
                if(cardNumber.value == '' || cardExpirationYear.value == '' || cardExpirationMonth.value == '')
                {
                   alert('Veuillez renseigner les informations des paiements SVP!') 
                }else{
                    const transaction = {
                            "paymentMethodExp": {
                              "name": "EquityBCDC",
                              "paymentMethodId": "EquityBCDC"
                            },
                            "paymentMethodDest": {
                              "name": "EquityBCDC",
                              "paymentMethodId": "EquityBCDC"
                            },
                            "amount": data.amount.toString(),
                            "client": {
                              "clientReferenceId": "Linc_2"
                            },
                            "currencyExp": {
                              "shortName": "USD",
                              "code": "904"
                            },
                            "currencyDest": {
                              "shortName": "USD",
                              "code": "904"
                            },
                            "createdAt": "2023-06-29T12:23:41.096Z",
                            "lg_operation": "credit",
                            "financialActorExpedition": {
                              "firstName": user.firstname,
                              "lastName": user.lastname,
                              "email": user.email,
                              "country": user.country_code,
                              "city": "CD-KN",
                              "cards": [
                                {
                                  "number": cardNumber.value,
                                  "yearExpiration": parseInt(cardExpirationYear.value),
                                  "monthExpiration": parseInt(cardExpirationMonth.value)
                                }
                              ],
                              "phones": [
                                {
                                  "number": user.mobile
                                }
                              ],
                                "countryCode": 243,
                                "address1": user.address.address,
                                "address2": "",
                                "locality": "lemba"
                            },
                            "financialActorDestination": {
                              "firstName": "Joe",
                              "lastName": "Doe",
                              "email": "joe@gmail.com",
                              "country": "CD",
                              "city": "CD-KN",
                              "cards": [
                                {
                                  "number": "4111111111111111",
                                  "yearExpiration": 2021,
                                  "monthExpiration": 12
                                }
                              ],
                              "phones": [
                                {
                                  "number": "243818674267"
                                }
                              ],
                            "countryCode": 243,
                            "address1": "Kinshasa",
                            "address2": "",
                            "locality": "lemba" //commune
                            }
                        };
                        let response = {}
                        response = postTransaction(transaction);
                    }
                }
            
                async function postTransaction(data)
                {
                    let loader = document.querySelector("#loading");
                    loader.classList.remove('d-none');
                    const headers = {
                        "Content-Type" : "application/json",
                        "X-API-KEY" : API_publicKey, 
                        "Accept" : "*/*",
                    }
                    let response = await axios.post('https://apilgtest.linc.cd/api/transactions',
                            data,
                            {
                                headers: headers
                            }
                        )
                        .then(response => {
                            loader.classList.add('d-none');
                            if(response.data.success){
                                iziToast.success({
                                    title: 'Success',
                                    message: response.data.message,
                                    position: 'topRight'
                                });
                            }else{
                                iziToast.error({
                                    title: 'Error',
                                    message: "Une erreur s'est produite : "+ response.data.message,
                                    position: 'topLeft',
                                });
                            }
                        })
                        .catch(error => {
                            loader.classList.add('d-none');
                            return error
                        })
                        return response
                }
                
                btn.addEventListener('click',()=>{
                    useCreateTransaction()
                })
            
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
