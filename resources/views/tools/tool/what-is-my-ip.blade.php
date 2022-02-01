@section('site_title', formatTitle([__('What is my IP'), __('Tool'), config('settings.title')]))

@include('shared.breadcrumbs', ['breadcrumbs' => [
    ['url' => route('dashboard'), 'title' => __('Home')],
    ['url' => route('tools'), 'title' => __('Tools')],
    ['title' => __('Tool')],
]])

<div class="d-flex">
    <h2 class="mb-3 text-break">{{ __('What is my IP') }}</h2>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header align-items-center">
        <div class="row">
            <div class="col">
                <div class="font-weight-medium py-1">{{ __('What is my IP') }}</div>
            </div>
        </div>
    </div>
    <div class="card-body">
        @include('shared.message')

        <div class="form-group">
            <label for="i-ip">{{ __('IP') }}</label>
            <div class="input-group">
                <input type="text" name="ip" id="i-ip" class="form-control{{ $errors->has('ip') ? ' is-invalid' : '' }}" value="{{ request()->ip() }}" readonly>
                <div class="input-group-append">
                    <div class="btn btn-primary" data-enable="tooltip-copy" title="{{ __('Copy') }}" data-copy="{{ __('Copy') }}" data-copied="{{ __('Copied') }}" data-clipboard-target="#i-ip">{{ __('Copy') }}</div>
                </div>
            </div>
            @if ($errors->has('ip'))
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $errors->first('ip') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-row">
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="i-country">{{ __('Country') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <img src="{{ asset('/images/icons/countries/'. mb_strtolower($result['country']['iso_code'] ?? 'unknown')) }}.svg" class="width-4 height-4">
                            </div>
                        </div>
                        <input id="i-country" class="form-control" type="text" value="{{ __($result['country']['names']['en'] ?? 'Unknown') }}" readonly>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="i-city">{{ __('City') }}</label>
                    <input id="i-city" class="form-control" type="text" value="{{ __($result['city']['names']['en'] ?? 'Unknown') }}" readonly>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="i-postal-code">{{ __('Postal code') }}</label>
                    <input id="i-postal-code" class="form-control" type="text" value="{{ __($result['postal']['code'] ?? 'Unknown') }}" readonly>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="i-latitude">{{ __('Latitude') }}</label>
                    <input id="i-latitude" class="form-control" type="text" value="{{ __($result['location']['latitude'] ?? 'Unknown') }}" readonly>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="i-longitude">{{ __('Longtitude') }}</label>
                    <input id="i-longitude" class="form-control" type="text" value="{{ __($result['location']['longitude'] ?? 'Unknown') }}" readonly>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="i-timezone">{{ __('Timezone') }}</label>
                    <input id="i-timezone" class="form-control" type="text" value="{{ __($result['location']['time_zone'] ?? 'Unknown') }}" readonly>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    'use strict';

    window.addEventListener('DOMContentLoaded', function () {
        new ClipboardJS('.btn');
    });
</script>