{{-- extend layout --}}
@extends('layouts.websiteLayoutMaster')

{{-- page title --}}
@section('title', 'Home')

{{-- vendor styles --}}
@section('vendor-style')

@endsection

{{-- page style --}}
@section('page-style')
@endsection

{{-- page content --}}
@section('content')

    <div class="page-header text-center">
        <div class="container">
            <h1 class="page-title">
                {{ __('layout.brands') }}
            </h1>
        </div>
    </div>
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/">{{ __('layout.home') }}</a>
                </li>
                <li class="breadcrumb-item active">{{ __('layout.brands') }}</li>
            </ol>
        </div>
    </nav>
    <div class="page-content">
        <div class="container">
            <brands-page></brands-page>
        </div>
    </div>

@endsection
@push('scripts')

@endpush
