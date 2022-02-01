@extends('layouts.app')

@section('site_title', formatTitle([__('Projects'), __('Developers'), config('settings.title')]))

@section('head_content')

@endsection

@section('content')
    <div class="bg-base-1 flex-fill">
        <div class="container h-100 py-3 my-3">

            @include('shared.breadcrumbs', ['breadcrumbs' => [
                ['url' => route('home'), 'title' => __('Home')],
                ['url' => route('developers'), 'title' => __('Developers')],
                ['title' => __('Projects')]
            ]])

            <h2 class="mb-0 d-inline-block">{{ __('Projects') }}</h2>

            @include('developers.notes')

            <div class="card border-0 shadow-sm mt-3">
                <div class="card-header align-items-center">
                    <div class="row">
                        <div class="col"><div class="font-weight-medium py-1">{{ __('List') }}</div></div>
                    </div>
                </div>

                <div class="card-body">
                    <p class="mb-1">
                        {{ __('API endpoint') }}:
                    </p>

                    <div class="bg-dark text-light p-3 rounded d-flex align-items-center mb-3" dir="ltr">
                        <span class="badge bg-light text-success px-2 py-1 mr-3">GET</span>
                        <pre class="m-0 text-light">{{ route('api.projects.index') }}</pre>
                    </div>

                    <p class="mb-1">
                        {{ __('Request example') }}:
                    </p>
                    <pre class="bg-dark text-light p-3 mb-0 rounded text-left" dir="ltr">
curl --location --request GET '{{ route('api.projects.index') }}' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer <span class="text-success">{api_key}</span>'
</pre>

                    @include('developers.projects.list', ['type' => 0])
                </div>
            </div>

            <div class="card border-0 shadow-sm mt-3">
                <div class="card-header align-items-center">
                    <div class="row">
                        <div class="col"><div class="font-weight-medium py-1">{{ __('Delete') }}</div></div>
                    </div>
                </div>

                <div class="card-body">
                    <p class="mb-1">
                        {{ __('API endpoint') }}:
                    </p>

                    <div class="bg-dark text-light p-3 rounded d-flex align-items-center mb-3" dir="ltr">
                        <span class="badge bg-light text-danger px-2 py-1 mr-3">DELETE</span>
                        <pre class="m-0 text-light">{!! str_replace(':project', '<span class="text-success">{project}</span>', route('api.projects.destroy', ['project' => ':project'])) !!}</pre>
                    </div>

                    <p class="mb-1">
                        {{ __('Request example') }}:
                    </p>
                    <pre class="bg-dark text-light p-3 mb-0 rounded text-left" dir="ltr">
curl --location --request DELETE '{!! str_replace(':project', '<span class="text-success">{project}</span>', route('api.projects.destroy', ['project' => ':project'])) !!}' \
--header 'Authorization: Bearer <span class="text-success">{api_key}</span>'
</pre>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('shared.sidebars.user')