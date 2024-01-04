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
    <section>
        <div class="inner_header">
            <div class="header_breadcrump">
                <div class="container-fluid">
                    <ul>
                        <li>
                            <a href="/">{{ __('layout.home') }}</a>
                        </li>
                        <li>
                            <span>Skin Care</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Header Image-->

    <about-sections></about-sections>

@endsection
@push('scripts')

@endpush
