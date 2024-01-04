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
    <!--Header Image-->
    <div class="page-header text-center">
        <div class="container">
            <h1 class="page-title">
                {{ __('layout.new_arrivals') }}
            </h1>
        </div>
    </div>
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/">{{ __('layout.home') }}</a>
                </li>
                <li class="breadcrumb-item active">{{ __('layout.new_arrivals') }}</li>
            </ol>
        </div>
    </nav>
    <div class="page-content">
        <div class="container">
            <newarrivals-grid page_type="new"></newarrivals-grid>
        </div>
    </div>
@endsection
@push('scripts')


@endpush
