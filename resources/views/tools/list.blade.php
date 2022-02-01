@extends('layouts.app')

@section('site_title', formatTitle([__('Projects'), config('settings.title')]))

@section('content')
<div class="bg-base-1 flex-fill">
    <div class="container py-3 my-3">
        <div class="row">
            <div class="col-12">
                @if(config('settings.ad_projects_top'))
                    <div class="d-print-none mb-1">{!! config('settings.ad_projects_top') !!}</div>
                @endif
                
                @include('shared.breadcrumbs', ['breadcrumbs' => [
                    ['url' => route('dashboard'), 'title' => __('Home')],
                    ['title' => __('Tools')],
                ]])

                <div class="d-flex align-items-end">
                    <h2 class="mb-0 flex-grow-1 text-truncate">{{ __('Tools') }}</h2>
                </div>

                @php
                    $resources = [
                        [
                            'icon' => 'icons.qr',
                            'title' => __('QR generator'),
                            'route' => route('tools.qr_generator')
                        ],
                        [
                            'icon' => 'icons.travel-explore',
                            'title' => __('IP lookup'),
                            'route' => route('tools.ip_lookup')
                        ],
                        [
                            'icon' => 'icons.location-on',
                            'title' => __('What is my IP'),
                            'route' => route('tools.what_is_my_ip')
                        ],
                        [
                            'icon' => 'icons.browser',
                            'title' => __('What is my browser'),
                            'route' => route('tools.what_is_my_browser')
                        ],
                        [
                            'icon' => 'icons.password',
                            'title' => __('Password generator'),
                            'route' => route('tools.password_generator')
                        ],
                        [
                            'icon' => 'icons.md5',
                            'title' => __('MD5 generator'),
                            'route' => route('tools.md5_generator')
                        ],
                        [
                            'icon' => 'icons.text-decrease',
                            'title' => __('Text to slug'),
                            'route' => route('tools.text_to_slug')
                        ],
                        [
                            'icon' => 'icons.text-fields',
                            'title' => __('Case converter'),
                            'route' => route('tools.case_converter')
                        ],
                        [
                            'icon' => 'icons.pin',
                            'title' => __('Word counter'),
                            'route' => route('tools.word_counter')
                        ],
                        [
                            'icon' => 'icons.subject',
                            'title' => __('Lorem ipsum generator'),
                            'route' => route('tools.lorem_ipsum_generator')
                        ],
                        [
                            'icon' => 'icons.link',
                            'title' => __('URL converter'),
                            'route' => route('tools.url_converter')
                        ],
                        [
                            'icon' => 'icons.base64',
                            'title' => __('Base64 converter'),
                            'route' => route('tools.base64_converter')
                        ]
                    ];
                @endphp

                <div class="row">
                    @foreach($resources as $resource)
                        <div class="col-12 mt-3">
                            <div class="card border-0 h-100 shadow-sm">
                                <div class="card-body d-flex align-items-center text-truncate">
                                    <div class="d-flex position-relative text-primary width-8 height-8 align-items-center justify-content-center flex-shrink-0">
                                        <div class="position-absolute bg-primary opacity-10 top-0 right-0 bottom-0 left-0 border-radius-lg"></div>
                                        @include($resource['icon'], ['class' => 'fill-current width-4 height-4'])
                                    </div>

                                    <div class="text-dark font-weight-medium font-size-lg mx-3 text-truncate">{{ __($resource['title']) }}</div>

                                    <a href="{{ $resource['route'] }}" class="text-secondary stretched-link text-decoration-none d-flex align-items-center text-truncate {{ (__('lang_dir') == 'rtl' ? 'mr-auto' : 'ml-auto') }}">
                                        @include((__('lang_dir') == 'rtl' ? 'icons.chevron-left' : 'icons.chevron-right'), ['class' => 'text-secondary flex-shrink-0 width-3 height-3 fill-current mx-2'])
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        @if(config('settings.ad_projects_bottom'))
            <div class="d-print-none mt-3">{!! config('settings.ad_projects_bottom') !!}</div>
        @endif
    </div>
</div>

@endsection
@include('shared.sidebars.user')