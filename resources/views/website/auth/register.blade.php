{{-- extend layout --}}
@extends('layouts.websiteLayoutMaster')

{{-- page title --}}
@section('title', 'Register')

{{-- vendor styles --}}
@section('vendor-style')

@endsection

{{-- page style --}}
@section('page-style')
@endsection

{{-- page content --}}
@section('content')
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/">{{ __('layout.home') }}</a>
                </li>
                <li class="breadcrumb-item active">{{ __('layout.register') }}</li>
            </ol>
        </div>
    </nav>
    <div class="page-content">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 pl-0">
                    <img src="/website/images/register.jpg" alt="">
                </div>
                <div class="col-md-6">
                    <register-component></register-component>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('scripts')

@endpush
