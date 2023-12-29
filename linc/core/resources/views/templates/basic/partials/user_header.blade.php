<!-- Header -->
<header class="header-fixed header--secondary">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a href="{{ route('home') }}" class="logo logo-light">
                <img src="{{ getImage(getFilepath('logoIcon') . '/linc.png') }}" alt="{{ __($general->site_name) }}"
                     class="img-fluid logo__is" />
                     
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="menu-toggle"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-lg-0 align-items-lg-center mb-2">
                    <li class="nav-item">
                        <a href="{{ route('user.home') }}" class="primary-menu__link">@lang('Dashboard')</a>
                    </li>
                    <li class="nav-item primary-menu__list has-sub">
                        <a href="javascript:void(0)" class="primary-menu__link">@lang('Send Money')</a>
                        <ul class="primary-menu__sub">
                            <li class="primary-menu__sub-list">
                                <a class="t-link primary-menu__sub-link" href="{{ route('user.send.money.now') }}">
                                    @lang('Send Now')
                                </a>
                            </li>

                            <li class="primary-menu__sub-list">
                                <a class="t-link primary-menu__sub-link" href="{{ route('user.send.money.history') }}">
                                    @lang('View History')
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item primary-menu__list has-sub">
                        <a href="javascript:void(0)" class="primary-menu__link">@lang('Support Ticket')</a>
                        <ul class="primary-menu__sub">
                            <li class="primary-menu__sub-list">
                                <a class="t-link primary-menu__sub-link" href="{{ route('ticket.open') }}">
                                    @lang('Open Now')
                                </a>
                            </li>
                            <li class="primary-menu__sub-list">
                                <a class="t-link primary-menu__sub-link" href="{{ route('ticket') }}">
                                    @lang('All Tickets')
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item primary-menu__list has-sub">
                        <a href="javascript:void(0)" class="primary-menu__link">{{ auth()->user()->username }}</a>
                        <ul class="primary-menu__sub">
                            <li class="primary-menu__sub-list">
                                <a class="t-link primary-menu__sub-link" href="{{ route('user.transactions') }}">
                                    @lang('Transactions')
                                </a>
                            </li>
                            <li class="primary-menu__sub-list">
                                <a class="t-link primary-menu__sub-link" href="{{ route('user.change.password') }}">
                                    @lang('Change Password')
                                </a>
                            </li>
                            <li class="primary-menu__sub-list">
                                <a class="t-link primary-menu__sub-link" href="{{ route('user.profile.setting') }}">
                                    @lang('Profile Setting')
                                </a>
                            </li>
                            <li class="primary-menu__sub-list">
                                <a class="t-link primary-menu__sub-link" href="{{ route('user.twofactor') }}">
                                    @lang('2FA Security')
                                </a>
                            </li>
                        </ul>
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
                    <li class="nav-item pt-lg-0 pb-lg-0 pt-10 pb-10">
                        <a href="{{ route('user.logout') }}" class="btn btn--md btn--base fixed-width"> @lang('Logout')
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</header>
<!-- Header End -->
