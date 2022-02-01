@section('menu')
    @php
        $menu = [
            route('admin.dashboard') => [
                'icon' => 'dashboard',
                'title' => __('Dashboard')
            ],
            'settings' => [
                'icon' => 'settings',
                'title' => __('Settings'),
                'menu' => [
                    route('admin.settings', 'general') => [
                        'icon' => 'general',
                        'title' => __('General')
                    ],
                    route('admin.settings', 'appearance') => [
                        'icon' => 'design',
                        'title' => __('Appearance')
                    ],
                    route('admin.settings', 'email') => [
                        'icon' => 'email',
                        'title' => __('Email')
                    ],
                    route('admin.settings', 'social') => [
                        'icon' => 'share',
                        'title' => __('Social')
                    ],
                    route('admin.settings', 'registration') => [
                        'icon' => 'register',
                        'title' => __('Registration')
                    ],
                    route('admin.settings', 'announcements') => [
                        'icon' => 'campaign',
                        'title' => __('Announcements')
                    ],
                    route('admin.settings', 'payment-processors') => [
                        'icon' => 'processor',
                        'title' => __('Payment processors')
                    ],
                    route('admin.settings', 'billing-information') => [
                        'icon' => 'billing',
                        'title' => __('Billing information')
                    ],
                    route('admin.settings', 'legal') => [
                        'icon' => 'legal',
                        'title' => __('Legal')
                    ],
                    route('admin.settings', 'captcha') => [
                        'icon' => 'captcha',
                        'title' => __('Captcha')
                    ],
                    route('admin.settings', 'cronjobs') => [
                        'icon' => 'clock',
                        'title' => __('Cron jobs')
                    ],
                    route('admin.settings', 'ads') => [
                        'icon' => 'ad',
                        'title' => __('Ads')
                    ],
                    route('admin.settings', 'license') => [
                        'icon' => 'key',
                        'title' => __('License')
                    ],
                    route('admin.settings', 'report') => [
                        'icon' => 'list-alt',
                        'title' => __('Report')
                    ],
                ]
            ],
            route('admin.users') => [
                'icon' => 'users',
                'title' => __('Users')
            ],
            route('admin.pages') => [
                'icon' => 'pages',
                'title' => __('Pages')
            ],
            route('admin.payments') => [
                'icon' => 'card',
                'title' => __('Payments')
            ],
            route('admin.plans') => [
                'icon' => 'package',
                'title' => __('Plans')
            ],
            route('admin.coupons') => [
                'icon' => 'coupon',
                'title' => __('Coupons')
            ],
            route('admin.tax_rates') => [
                'icon' => 'tax',
                'title' => __('Tax rates')
            ],
            route('admin.reports') => [
                'icon' => 'list-alt',
                'title' => __('Reports')
            ]
        ];
    @endphp

    <div class="nav d-block text-truncate">
        @foreach ($menu as $key => $value)
            <li class="nav-item">
                <a class="nav-link d-flex px-4 @if (str_starts_with(request()->url(), $key) && !isset($value['menu'])) active @endif" @if(isset($value['menu'])) data-toggle="collapse" href="#sub-menu-{{ $key }}" role="button" @if (array_filter(array_keys($value['menu']), function($url) { return str_starts_with(request()->url(), $url); })) aria-expanded="true" @else aria-expanded="false" @endif aria-controls="collapse-{{ $key }}" @else href="{{ $key }}" @endif>
                    <span class="sidebar-icon d-flex align-items-center">@include('icons.' . $value['icon'], ['class' => 'fill-current width-4 height-4 '.(__('lang_dir') == 'rtl' ? 'ml-3' : 'mr-3')])</span>
                    <span class="flex-grow-1 text-truncate">{{ $value['title'] }}</span>
                    @if (isset($value['menu'])) <span class="d-flex align-items-center ml-auto sidebar-expand">@include('icons.expand', ['class' => 'fill-current text-muted width-3 height-3'])</span> @endif
                </a>
            </li>

            @if (isset($value['menu']))
                <div class="collapse sub-menu @if (array_filter(array_keys($menu[$key]['menu']), function($url) { return str_starts_with(request()->url(), $url); })) show @endif" id="sub-menu-{{ $key }}">
                    @foreach ($value['menu'] as $subKey => $subValue)
                        <a href="{{ $subKey }}" class="nav-link px-4 d-flex text-truncate @if (str_starts_with(request()->url(), $subKey)) active @endif">
                            <span class="sidebar-icon d-flex align-items-center">@include('icons.' . $subValue['icon'], ['class' => 'fill-current width-4 height-4 '.(__('lang_dir') == 'rtl' ? 'ml-3' : 'mr-3')])</span>
                            <span class="flex-grow-1 text-truncate">{{ $subValue['title'] }}</span>
                        </a>
                    @endforeach
                </div>
            @endif
        @endforeach
    </div>
@endsection