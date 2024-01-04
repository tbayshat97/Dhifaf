{{-- extend layout --}}
@extends('layouts.websiteLayoutMaster')

{{-- page title --}}
@section('title', 'Contact Us')

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
                            <span>{{ __('layout.contact') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Header Image-->

    <section class="contact-us section_padding">
        <div class="container-fluid">
            <div class="section_tittle text-center">
                <h2 class="text-center">{{ __('layout.contact') }}</h2>
            </div>
            <contact-us></contact-us>
        </div>
    </section>

@endsection
@push('scripts')

@endpush
