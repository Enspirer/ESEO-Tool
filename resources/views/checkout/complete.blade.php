@extends('layouts.app')

@section('site_title', formatTitle([__('Payment completed'), config('settings.title')]))

@section('content')
<div class="bg-base-1 d-flex align-items-center flex-fill">
    <div class="container">
        <div class="h-100 d-flex flex-column justify-content-center align-items-center my-5">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 201 201" class="w-100 mx-auto max-width-32 fill-current text-primary"><circle cx="100" cy="100" r="100" style="opacity:0.1"/><path d="M140.5,60.5h-80a9.92,9.92,0,0,0-10,10l0,60a10,10,0,0,0,10,10h80a10,10,0,0,0,10-10v-60A10,10,0,0,0,140.5,60.5Zm-5,70h-70a5,5,0,0,1-5-5v-25h80v25A5,5,0,0,1,135.5,130.5Zm5-50h-80v-10h80Z"/><circle cx="150" cy="141" r="24.5" style="fill:#4daa4d"/><polygon points="146.06 153.49 134.38 141.81 137.96 138.23 146.06 146.32 161.2 131.18 164.78 134.77 146.06 153.49" style="fill:#fff"/></svg>

            <div>
                <h5 class="mt-4 text-center">{{ __('Payment completed') }}</h5>
                <p class="text-center text-muted">{{ __('The payment was successful.') }}</p>

                <div class="text-center mt-5">
                    <a href="{{ route('home') }}" class="btn btn-primary">{{ __('Dashboard') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection