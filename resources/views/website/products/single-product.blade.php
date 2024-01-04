{{-- extend layout --}}
@extends('layouts.websiteLayoutMaster')

{{-- page title --}}
@section('title', $product->title)

@push('head')
    <meta property='og:title' content="{{ $product->title }}">
    <meta property='og:description' content='{{ $product->description }}'>
    <meta property='og:image' content="{{ $product->product->getProductImage() }}">
@endpush
{{-- vendor styles --}}
@section('vendor-style')

@endsection

{{-- page style --}}
@section('page-style')
@endsection

{{-- page content --}}
@section('content')

    {{-- <section>
        <div class="inner_header">
            <div class="header_breadcrump">
                <div class="container-fluid">
                    <ul>
                        <li>
                            <a href="#">{{ __('layout.home') }}</a>
                        </li>
                        <li>
                            <span>{{ __('layout.product') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section> --}}

    <div class="page-content">
        <div class="container">
            <single-product language='{{ app()->getLocale() }}'></single-product>
            <div class="">
                <div class="section_tittle text-center">
                    <h2>{{ __('layout.related_products') }}</h2>
                </div>
                <related-products></related-products>
            </div>
        </div>
    </div>



@endsection

{{-- page script --}}
@section('page-script')

@endsection
