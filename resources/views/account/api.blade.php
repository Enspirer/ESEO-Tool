@section('site_title', formatTitle([__('API'), config('settings.title')]))

@include('shared.breadcrumbs', ['breadcrumbs' => [
    ['url' => route('dashboard'), 'title' => __('Home')],
    ['url' => route('account'), 'title' => __('Account')],
    ['title' => __('API')]
]])

<h2 class="mb-3 d-inline-block">{{ __('API') }}</h2>

<div class="card border-0 shadow-sm">
    <div class="card-header align-items-center">
        <div class="row">
            <div class="col"><div class="font-weight-medium py-1">{{ __('API') }}</div></div>
        </div>
    </div>
    <div class="card-body">
        @include('shared.message')

        <div class="form-group">
            <label for="i-api-token">{{ __('API key') }}</label>
            <div class="input-group">
                <input type="text" id="i-api-token" class="form-control" value="{{ $user->api_token }}" readonly>
                <div class="input-group-append">
                    <div class="btn btn-primary" data-enable="tooltip-copy" title="{{ __('Copy') }}" data-copy="{{ __('Copy') }}" data-copied="{{ __('Copied') }}" data-clipboard-target="#i-api-token">{{ __('Copy') }}</div>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal" data-action="{{ route('account.api') }}" data-button="btn btn-danger" data-title="{{ __('Regenerate') }}" data-text="{{ __('Are you sure you want to regenerate your API key?') }}">{{ __('Regenerate') }}</button>
    </div>
</div>

<script>
    'use strict';

    window.addEventListener('DOMContentLoaded', function () {
        new ClipboardJS('.btn');
    });
</script>