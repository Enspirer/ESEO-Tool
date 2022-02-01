@section('site_title', formatTitle([__('Report'), __('Settings'), config('settings.title')]))

@include('shared.breadcrumbs', ['breadcrumbs' => [
    ['url' => route('admin.dashboard'), 'title' => __('Admin')],
    ['title' => __('Settings')],
]])

<h2 class="mb-3 d-inline-block">{{ __('Report') }}</h2>

<div class="card border-0 shadow-sm">
    <div class="card-header"><div class="font-weight-medium py-1">{{ __('Report') }}</div></div>
    <div class="card-body">

        <ul class="nav nav-pills d-flex flex-fill flex-column flex-md-row mb-3" id="pills-tab" role="tablist">
            <li class="nav-item flex-grow-1 text-center">
                <a class="nav-link active" id="pills-report-tab" data-toggle="pill" href="#pills-report" role="tab" aria-controls="pills-smtp" aria-selected="true">{{ __('Report') }}</a>
            </li>
            <li class="nav-item flex-grow-1 text-center">
                <a class="nav-link" id="pills-screenshot-tab" data-toggle="pill" href="#pills-screenshot" role="tab" aria-controls="pills-screenshot" aria-selected="false">{{ __('Screenshot') }}</a>
            </li>
            <li class="nav-item flex-grow-1 text-center">
                <a class="nav-link" id="pills-gsb-tab" data-toggle="pill" href="#pills-gsb" role="tab" aria-controls="pills-contact" aria-selected="false">{{ __('Google Safe Browsing') }}</a>
            </li>
        </ul>

        @include('shared.message')

        <form action="{{ route('admin.settings', 'report') }}" method="post" enctype="multipart/form-data">

            @csrf

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-report" role="tabpanel" aria-labelledby="pills-report-tab">
                    <div class="form-group">
                        <label for="i-demo-url">{{ __(':name URL', ['name' => __('Demo')]) }}</label>
                        <input type="text" dir="ltr" name="demo_url" id="i-demo-url" class="form-control{{ $errors->has('demo_url') ? ' is-invalid' : '' }}" value="{{ old('settings.demo_url') ?? config('settings.demo_url') }}">
                        @if ($errors->has('demo_url'))
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $errors->first('demo_url') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="i-short-bad-words">{{ __('Bad words') }}</label>
                         <textarea name="report_bad_words" id="i-short-bad-words" class="form-control{{ $errors->has('report_bad_words') ? ' is-invalid' : '' }}" rows="3" placeholder="{{ __('One per line.') }}">{{ config('settings.report_bad_words') }}</textarea>
                        @if ($errors->has('report_bad_words'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('report_bad_words') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-screenshot" role="tabpanel" aria-labelledby="pills-screenshot-tab">
                    <div class="form-group">
                        <label for="i-report-screenshot">{{ __('Enabled') }}</label>
                        <select name="report_screenshot" id="i-report-screenshot" class="custom-select{{ $errors->has('report_screenshot') ? ' is-invalid' : '' }}">
                            @foreach([0 => __('No'), 1 => __('Yes')] as $key => $value)
                                <option value="{{ $key }}" @if ((old('report_screenshot') !== null && old('report_screenshot') == $key) || (config('settings.report_screenshot') == $key && old('report_screenshot') == null)) selected @endif>{{ $value }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('report_screenshot'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('report_screenshot') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="i-report-screenshot-key">{{ __('API key') }}</label>
                        <input type="password" name="report_screenshot_key" id="i-report-screenshot-key" class="form-control{{ $errors->has('report_screenshot_key') ? ' is-invalid' : '' }}" value="{{ old('report_screenshot_key') ?? config('settings.report_screenshot_key') }}">
                        @if ($errors->has('report_screenshot_key'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('report_screenshot_key') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-gsb" role="tabpanel" aria-labelledby="pills-gsb-tab">
                    <div class="form-group">
                        <label for="i-report-gsb">{{ __('Enabled') }}</label>
                        <select name="report_gsb" id="i-report-gsb" class="custom-select{{ $errors->has('report_gsb') ? ' is-invalid' : '' }}">
                            @foreach([0 => __('No'), 1 => __('Yes')] as $key => $value)
                                <option value="{{ $key }}" @if ((old('report_gsb') !== null && old('report_gsb') == $key) || (config('settings.report_gsb') == $key && old('report_gsb') == null)) selected @endif>{{ $value }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('report_gsb'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('report_gsb') }}</strong>
                            </span>
                        @endif
                    </div>

                    {{--<div class="form-group">
                        <label for="i-report-gsb-key">{{ __('API key') }}</label>
                        <input type="password" name="report_gsb_key" id="i-report-gsb-key" class="form-control{{ $errors->has('report_gsb_key') ? ' is-invalid' : '' }}" value="{{ old('report_gsb_key') ?? config('settings.report_gsb_key') }}">
                        @if ($errors->has('report_gsb_key'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('report_gsb_key') }}</strong>
                            </span>
                        @endif
                    </div>--}}
                </div>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">{{ __('Save') }}</button>
        </form>

    </div>
</div>