{{-- extend layout --}}
@extends('layouts.websiteLayoutMaster')

{{-- page title --}}
@section('title', 'Single Product')

    {{-- vendor styles --}}
@section('vendor-style')

@endsection

{{-- page style --}}
@section('page-style')
@endsection

{{-- page content --}}
@section('content')

    <section id="single-product" class="luxury_single">
        <div class="container-fluid">
            <single-product></single-product>
        </div>
    </section>
    <section class="related-products luxury_single luxury_new_arrivals section_padding">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section_tittle text-center">
                        <h2 class="text-center">Related Products</h2>
                    </div>
                </div>
            </div>
            <div class="">
                <related-products></related-products>
            </div>
        </div>
    </section>

@endsection

{{-- page script --}}
@section('page-script')

@endsection