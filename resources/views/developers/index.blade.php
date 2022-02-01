@extends('layouts.app')

@section('site_title', formatTitle([__('Developers'), config('settings.title')]))

@section('head_content')

@endsection

@section('content')
    <div class="bg-base-1 flex-fill">
        <div class="container h-100 py-6">

            <div class="text-center">
                <h2 class="mb-3 d-inline-block">{{ __('Developers') }}</h2>
                <div class="m-auto">
                    <p class="text-muted font-weight-normal font-size-lg mb-4">{{ __('Explore our API documentation.') }}</p>
                </div>
            </div>

            @php
                $resources = [
                    [
                        'icon' => 'account-tree',
                        'title' => __('Projects'),
                        'description' => __('Manage the projects.'),
                        'route' => route('developers.projects')
                    ],
                    [
                        'icon' => 'list-alt',
                        'title' => __('Reports'),
                        'description' => __('Manage the reports.'),
                        'route' => route('developers.reports')
                    ],
                    [
                        'icon' => 'account',
                        'title' => __('Account'),
                        'description' => __('Manage the account.'),
                        'route' => route('developers.account')
                    ]
                ];
            @endphp

            <div class="row">
                @foreach($resources as $resource)
                    <div class="col-12 col-sm-6 col-md-4 mt-3">
                        <div class="card border-0 h-100 shadow-sm">
                            <div class="card-body d-flex">
                                <div class="d-flex position-relative text-primary width-12 height-12 align-items-center justify-content-center flex-shrink-0 {{ (__('lang_dir') == 'rtl' ? 'ml-3' : 'mr-3') }}">
                                    <div class="position-absolute bg-primary opacity-10 top-0 right-0 bottom-0 left-0 border-radius-2xl"></div>
                                    @include('icons.' . $resource['icon'], ['class' => 'fill-current width-6 height-6'])
                                </div>
                                <div>
                                    <div class="text-dark font-weight-medium">{{ $resource['title'] }}</div>

                                    <a href="{{ $resource['route'] }}" class="text-secondary text-decoration-none stretched-link mb-3">{{ $resource['description'] }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@include('shared.sidebars.user')