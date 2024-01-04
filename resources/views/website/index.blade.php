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
    <div class="main home-page">
        <main-slider-component language='{{ app()->getLocale() }}'></main-slider-component>




        <!--Home Slider-->
        <!--Luxury Brands-->
        <div class="pt-5">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section_tittle text-center">
                            <h2>{{ __('layout.our_luxury_brands') }}</h2>
                            <p><a href="/brands">{{ __('layout.view_all') }}</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <luxury-brands></luxury-brands>
        </div>




        <!--Luxury Brands-->
        <!--Featured Items-->
        <featured-component></featured-component>
        <!--Featured Items-->
        <!--Offers-->
        <offer-card></offer-card>
        <!--Offers-->
        <!--New Arrivals-->
        <newarrivals-component></newarrivals-component>
        <!--New Arrivals-->
        <!--Top Rated / Top Seller-->
        <toprated-component></toprated-component>
        <!--Top Rated / Top Seller-->
        <!--Divisions-->
        <section class="divisions section_padding">
            <div class="container-fluid">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-1">
                        <div class="section_tittle text-center">
                            <h2>{{ __('layout.divisions') }}</h2>
                        </div>
                    </div>
                    <division-card></division-card>
                </div>
            </div>
        </section>
        <!--Divisions-->
        <!--Brands-->
        <div class="brands section_padding">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section_tittle text-center">
                            <h2>{{ __('layout.brands') }}</h2>
                            <p><a href="/brands">{{ __('layout.view_all') }}</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <brands-section></brands-section>
        </div>
    </div>
    <!--Brands-->
@endsection
@push('scripts')


@endpush
