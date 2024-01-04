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
                {{ __('layout.wishlist') }}
            </h1>
        </div>
    </div>
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/">{{ __('layout.home') }}</a>
                </li>
                <li class="breadcrumb-item active">{{ __('layout.wishlist') }}</li>
            </ol>
        </div>
    </nav>
    <div class="page-content">
        <div class="container">
            <div class="text-center"><i class="icon-gift wishlist-empty d-block"></i> <span class="d-block mt-2">No
                    products added to wishlist</span> <a href="/" class="btn btn-primary mt-2">Go Shop</a></div>
            <wishlist-component></wishlist-component>
        </div>
    </div>


@endsection
@push('scripts')

@endpush
