@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @php
    $register = getContent('register.content', true);
    $policyPages = getContent('policy_pages.element', false, null, true);
    @endphp
    
    
       <style>
        

@media (min-width: 1024px) {
   
    /* bouncing effect */
    .bounce {
        animation: bounce 2s infinite alternate;
        -webkit-animation: bounce 2s infinite alternate;
    }
    @keyframes bounce {
        from {
            transform: translateY(0px);
        }
        to {
            transform: translateY(-35px);
        }
    }
    @-webkit-keyframes bounce {
        from {
            transform: translateY(0px);
        }
        to {
            transform: translateY(-35px);
        }
    }
   
}
    </style>
    
    
    <div class="section login-section" style="background-image: url({{ getImage($activeTemplateTrue . 'images/bck.jpg') }})">
        <div class="container">
            <div class="row g-4 g-xl-0 justify-content-between align-items-center">
                
                
             <div class="d-none d-lg-block col-lg-6 col-xl-6 p-5">
                <div class="row vh-100 p-5">
                    <div class="col align-self-center p-5 text-center">
                        <img src=" {{ getImage('assets/images/img/sac.png') }}" class="bounce" alt="">
                       
                    </div>
                </div>
            </div>   
                
             
                <div class="col-lg-8 col-xl-6">
                    <div class="login__right bg--light">
                        <form action="{{ route('user.register') }}" class="login__form row g-3 g-sm-4" method="POST" onsubmit="return submitUserForm();" autocomplete="off">
                            @csrf
                            <div class="col-sm-6 col-xl-6 ">
                                <label for="user-name" class="form-label sm-text t-heading-font heading-clr fw-md">@lang('Username')</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="la la-user"></i>
                                    </span>
                                    <input id="username" id="user-name" type="text" class="form-control form--control checkUser" name="username" value="{{ old('username') }}" required>
                                </div>
                                <small class="text-danger usernameExist"></small>
                            </div>
                            <div class="col-sm-6 col-xl-6 ">
                                <label for="email" class="form-label sm-text t-heading-font heading-clr fw-md">@lang('Email')</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="las la-envelope"></i>
                                    </span>
                                    <input id="email" type="email" class="form-control checkUser form--control" name="email" value="{{ old('email') }}" required>
                                </div>
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
                                            @foreach ($countries as $key => $country)
                                                <option data-mobile_code="{{ $country->dial_code }}" value="{{ $country->country }}" data-code="{{ $key }}">{{ __($country->country) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
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
                                <label for="password" class="form-label sm-text t-heading-font heading-clr fw-md">@lang('Password')</label>
                                <div class="input-group hover-input-popup ">
                                    <span class="input-group-text">
                                        <i class="las la-lock"></i>
                                    </span>
                                    <input id="password" type="password" name="password" class="form-control form--control border-end-0" />
                                    <span class="input-group-text pass-toggle border-start-0">
                                        <i class="las la-eye-slash"></i>
                                    </span>
                                    @if ($general->secure_password)
                                        <div class="input-popup">
                                            <p class="error lower">@lang('1 small letter minimum')</p>
                                            <p class="error capital">@lang('1 capital letter minimum')</p>
                                            <p class="error number">@lang('1 number minimum')</p>
                                            <p class="error special">@lang('1 special character minimum')</p>
                                            <p class="error minimum">@lang('6 character password')</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-6 ">
                                <label for="confirm-password" class="form-label sm-text t-heading-font heading-clr fw-md">@lang('Confirm Password')</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="las la-lock"></i>
                                    </span>
                                    <input id="confirm-password" type="password" class="form-control form--control border-end-0" name="password_confirmation" required autocomplete="new-password" />
                                    <span class="input-group-text pass-toggle border-start-0">
                                        <i class="las la-eye-slash"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="col-12">
                                <x-captcha class="form-label sm-text t-heading-font heading-clr fw-md"></x-captcha>
                            </div>
                            @if ($general->agree)
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input custom--check" type="checkbox" name="agree" id="rememberMe" required />
                                        <label class="form-check-label sm-text t-heading-font heading-clr" for="rememberMe">
                                            @lang('I agree with')
                                            @foreach ($policyPages as $page)
                                                <a href="{{ route('policy.pages', [slug($page->data_values->title), $page->id]) }}" class="t-link text--base t-link--base">{{ __($page->data_values->title) }}</a>
                                                @if (!$loop->last)
                                                    ,
                                                @endif
                                            @endforeach

                                        </label>
                                    </div>
                                </div>
                            @endif
                            <div class="col-12">
                                <button class="btn btn--xl btn--base w-100 btn--xl"> @lang('Submit') </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- end --}}

    <div class="modal fade" id="existModalCenter" tabindex="-1" role="dialog" aria-labelledby="existModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="existModalLongTitle">@lang('You are with us')</h5>
                    <span type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </span>
                </div>
                <div class="modal-body">
                    <h6 class="text-center">@lang('You already have an account please Login ')</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark btn-sm" data-bs-dismiss="modal">@lang('Close')</button>
                    <a href="{{ route('user.login') }}" class="btn btn--base btn-sm">@lang('Login')</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script-lib')
    <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
@endpush

@push('script')
    <script>
        "use strict";
        (function($) {
            @if ($mobile_code)
                $(`option[data-code={{ $mobile_code }}]`).attr('selected', '');
            @endif

            $('select[name=country]').change(function() {
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
            });
            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
            @if ($general->secure_password)
                $('input[name=password]').on('input', function() {
                    secure_password($(this));
                });

                $('[name=password]').focus(function() {
                    $(this).closest('.form-group').addClass('hover-input-popup');
                });

                $('[name=password]').focusout(function() {
                    $(this).closest('.form-group').removeClass('hover-input-popup');
                });
            @endif

            $('.checkUser').on('focusout', function(e) {
                var url = '{{ route('user.checkUser') }}';
                var value = $(this).val();
                var token = '{{ csrf_token() }}';
                if ($(this).attr('name') == 'mobile') {
                    var mobile = `${$('.mobile-code').text().substr(1)}${value}`;
                    var data = {
                        mobile: mobile,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'email') {
                    var data = {
                        email: value,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'username') {
                    var data = {
                        username: value,
                        _token: token
                    }
                }
                $.post(url, data, function(response) {
                    if (response.data != false && response.type == 'email') {
                        $('#existModalCenter').modal('show');
                    } else if (response.data != false) {
                        $(`.${response.type}Exist`).text(`${response.type} already exist`);
                    } else {
                        $(`.${response.type}Exist`).text('');
                    }
                });
            });
        })(jQuery);
    </script>
    
    
     <script type="text/javascript">
          
          const signUp = document.querySelector("#signUp");
const signIn = document.querySelector("#signIn");
const passwordIcon = document.querySelectorAll('.password__icon')
const authPassword = document.querySelectorAll('.auth__password')

// when click sign up button
signUp.addEventListener('click', () => {
    document.querySelector('.login__form').classList.remove('active')
    document.querySelector('.register__form').classList.add('active')
    document.querySelector('.ball').classList.add('register')
    document.querySelector('.ball').classList.remove('login')
});

// when click sign in button
signIn.addEventListener('click', () => {
    document.querySelector('.login__form').classList.add('active')
    document.querySelector('.register__form').classList.remove('active')
    document.querySelector('.ball').classList.add('login')
    document.querySelector('.ball').classList.remove('register')
});

// change hidden password to visible password
for (var i = 0; i < passwordIcon.length; ++i) {
    passwordIcon[i].addEventListener('click', (i) => {
        const lastArray = i.target.classList.length - 1
        if (i.target.classList[lastArray] == 'bi-eye-slash') {
            i.target.classList.remove('bi-eye-slash')
            i.target.classList.add('bi-eye')
            i.currentTarget.parentNode.querySelector('input').type = 'text'
        } else {
            i.target.classList.add('bi-eye-slash')
            i.target.classList.remove('bi-eye')
            i.currentTarget.parentNode.querySelector('input').type = 'password'
        }
    });
}
          
          
          
          
      </script>
@endpush
