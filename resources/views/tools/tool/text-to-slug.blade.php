@section('site_title', formatTitle([__('Text to slug'), __('Tool'), config('settings.title')]))

@include('shared.breadcrumbs', ['breadcrumbs' => [
    ['url' => route('dashboard'), 'title' => __('Home')],
    ['url' => route('tools'), 'title' => __('Tools')],
    ['title' => __('Tool')],
]])

<div class="d-flex">
    <h2 class="mb-3 text-break">{{ __('Text to slug') }}</h2>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header align-items-center">
        <div class="row">
            <div class="col">
                <div class="font-weight-medium py-1">{{ __('Text to slug') }}</div>
            </div>
        </div>
    </div>
    <div class="card-body">
        @include('shared.message')

        <form action="{{ route('tools.text_to_slug')  }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="i-content">{{ __('Content') }}</label>
                <textarea name="content" id="i-content" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}">{{ $content ?? (old('content') ?? '') }}</textarea>
                @if ($errors->has('content'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('content') }}</strong>
                    </span>
                @endif
            </div>

            @if(isset($result))
                <div class="form-group">
                    <label for="i-result">{{ __('Result') }}</label>

                    <div class="position-relative">
                        <textarea name="result" id="i-result" class="form-control" onclick="this.select();" readonly>{{ $result }}</textarea>

                        <div class="position-absolute top-0 right-0">
                            <div class="btn btn-sm btn-primary m-2" data-enable="tooltip-copy" title="{{ __('Copy') }}" data-copy="{{ __('Copy') }}" data-copied="{{ __('Copied') }}" data-clipboard-target="#i-result">{{ __('Copy') }}</div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col">
                    <button type="submit" name="submit" class="btn btn-primary">{{ __('Convert') }}</button>
                </div>
                <div class="col-auto">
                    <a href="{{ route('tools.text_to_slug') }}" class="btn btn-outline-secondary ml-auto">{{ __('Reset') }}</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    'use strict';

    window.addEventListener('DOMContentLoaded', function () {
        new ClipboardJS('.btn');
    });
</script>