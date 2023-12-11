@php
if (request()->routeIs('home')) {
    $class = 'header--primary';
} else {
    $class = 'header--secondary';
}
$pages = App\Models\Page::where('tempname', $activeTemplate)
    ->where('is_default', 0)
    ->get();
@endphp
<!-- Header -->
<header class="header-fixed {{ $class }}">

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            @if ($class == 'header--primary')
                <a href="{{ route('home') }}" class="logo logo-dark">
                    <img src="{{ getImage(getFilepath('logoIcon') . '/linc.png') }}" alt="{{ __($general->site_name) }}" class="img-fluid logo__is" />
                </a>
            @endif

            <a href="{{ route('home') }}" class="logo logo-light">
                <img src="{{ getImage(getFilepath('logoIcon') . '/linc.png') }}" alt="{{ __($general->site_name) }}" class="img-fluid logo__is" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="menu-toggle"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-lg-0 align-items-lg-center mb-2">
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="primary-menu__link">@lang('Home')</a>
                    </li>
                    @foreach ($pages as $k => $data)
                        <li class="nav-item"><a href="{{ route('pages', [$data->slug]) }}"
                               class="primary-menu__link">{{ __($data->name) }}</a></li>
                    @endforeach
                    <li class="nav-item">
                        <a href="{{ route('blog') }}" class="primary-menu__link">@lang('Blog')</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('contact') }}" class="primary-menu__link">@lang('Contact')</a>
                    </li>
                    

                    <li class="nav-item pt-lg-0 pb-lg-0 pt-10 pb-10">
                        <div class="select-lang">
                            <select class="form-select langSel">
                                @foreach ($language as $item)
                                    <option value="{{ $item->code }}"
                                            @if (session('lang') == $item->code) selected @endif>{{ __($item->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </li>
                    @guest
                        <li class="nav-item pt-lg-0 pb-lg-0 pt-10 pb-10">
                            <a href="{{ route('user.login') }}" class="btn btn--md btn--base fixed-width"> @lang('Login')
                            </a>
                        </li>
                    @endguest
                    @auth
                        <li class="nav-item pt-lg-0 pb-lg-0 pt-10 pb-10">
                            <div class="d-flex align-items-center flex-wrap gap-3">
                                <a href="{{ route('user.home') }}" class="btn btn--md btn--base"> @lang('Dashboard')</a>
                                <a href="{{ route('user.logout') }}" class="btn btn--md btn--custom">
                                    @lang('Logout')
                                </a>
                            </div>

                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>
<!-- Header End -->
