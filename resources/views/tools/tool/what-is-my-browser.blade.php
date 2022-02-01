@section('site_title', formatTitle([__('What is my browser'), __('Tool'), config('settings.title')]))

@include('shared.breadcrumbs', ['breadcrumbs' => [
    ['url' => route('dashboard'), 'title' => __('Home')],
    ['url' => route('tools'), 'title' => __('Tools')],
    ['title' => __('Tool')],
]])

<div class="d-flex">
    <h2 class="mb-3 text-break">{{ __('What is my browser') }}</h2>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header align-items-center">
        <div class="row">
            <div class="col">
                <div class="font-weight-medium py-1">{{ __('What is my browser') }}</div>
            </div>
        </div>
    </div>
    <div class="card-body">
        @include('shared.message')

        <div class="form-row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="i-browser">{{ __('Browser') }}</label>
                    <input id="i-browser" class="form-control" type="text" value="{{ $result->browser->name ?? null }} {{ $result->browser->version->value ?? null }}" readonly>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="i-operating-system">{{ __('Operating system') }}</label>
                    <input id="i-operating-system" class="form-control" type="text" value="{{ $result->os->name ?? null }} {{ $result->os->version->value ?? null }}" readonly>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="i-result">{{ __('User-Agent') }}</label>

            <div class="position-relative">
                <textarea name="user-agent" id="i-user-agent" class="form-control" onclick="this.select();" readonly>{{ request()->header('User-Agent') ?? null }}</textarea>

                <div class="position-absolute top-0 right-0">
                    <div class="btn btn-sm btn-primary m-2" data-enable="tooltip-copy" title="{{ __('Copy') }}" data-copy="{{ __('Copy') }}" data-copied="{{ __('Copied') }}" data-clipboard-target="#i-user-agent">{{ __('Copy') }}</div>
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