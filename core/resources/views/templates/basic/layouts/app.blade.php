<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> {{ $general->siteName(__($pageTitle)) }}</title>
    @include('partials.seo')
    <link rel="icon" href="{{ getImage(getFilePath('logoIcon') . '/favicon.png') }}" sizes="16x16" type="image/png" />
    <link rel="stylesheet" href="{{ asset('assets/global/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/global/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/global/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/global/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/global/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/lib/odometer-theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/lib/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/custom.css') }}" />
    <link rel="stylesheet"
        href="{{ asset($activeTemplateTrue . 'css/color.php') }}?color={{ $general->base_color }}" />
    @stack('style-lib')

    @stack('style')
</head>

<body>
    @stack('fbComment')

    @if (Route::currentRouteName() == 'home')

        <div class="preloader">
            <div class="preloader__img">
                <img src="{{ getImage(getFilePath('logoIcon') . '/favicon.png') }}" alt="image">
            </div>
        </div>

    @endif
    <div class="back-to-top">
        <span class="back-top">
            <i class="las la-angle-double-up"></i>
        </span>
    </div>

    @yield('panel')
    <script src="{{ asset('assets/global/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/global/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/global/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/global/js/select2.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/lib/jquery.magnific-popup.js') }}"></script>

    <script src="{{ asset($activeTemplateTrue . 'js/lib/viewport.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/lib/odometer.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/app.js') }}"></script>
    @stack('script-lib')

    @include('partials.notify')

    @include('partials.plugins')


    @stack('script')


    <script>
        (function($) {
            "use strict";
            $(".langSel").on("change", function() {
                window.location.href = "{{ route('home') }}/change/" + $(this).val();
            });
            $('form').on('submit', function() {
                $(':submit', this).attr('disabled', 'disabled');
            });
            $('.showFilterBtn').on('click', function() {
                $('.responsive-filter-card').slideToggle();
            });
        })(jQuery);

    </script>
</body>

</html>
