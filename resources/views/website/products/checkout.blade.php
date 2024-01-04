{{-- extend layout --}}
@extends('layouts.websiteLayoutMaster')

{{-- page title --}}
@section('title', 'Checkout')

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
            {{ __('layout.checkout') }}
        </h1>
    </div>
</div>
<nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/">{{ __('layout.home') }}</a>
            </li>
            <li class="breadcrumb-item active">{{ __('layout.checkout') }}</li>
        </ol>
    </div>
</nav>
 <!--Header Image-->
 <div class="page-content">
    <div class="container">
        <checkout-component></checkout-component>
    </div>
</div>

{{-- <section>
    <div class="inner_header">
        <div class="header_breadcrump">
            <div class="container-fluid">
                <ul>
                    <li>
                        <a href="/">{{ __('layout.home') }}</a>
                    </li>
                    <li>
                        <span>{{ __('layout.checkout') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div> --}}


{{-- <section class="single_product_list_slider section_padding">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section_tittle text-center">
                    <h2>{{ __('layout.up_selling') }}</h2>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 20px; position:relative;">
            <div class="col-lg-12">
                <up-selling></up-selling>
            </div>
        </div>
    </div>
</section> --}}

@endsection
@push('scripts')

@endpush
