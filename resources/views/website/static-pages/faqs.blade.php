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
                            <span>{{$data->translateOrDefault()->title}}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Header Image-->

    <section class="static_pages section_padding">
        <div class="container-fluid">
            <div class="section_tittle text-center">
                <h2 class="text-center">{{$data->translateOrDefault()->title}}</h2>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    {!!$data->translateOrDefault()->content!!}
                </div>
            </div>
        </div>
    </section>

@endsection
@push('scripts')

@endpush
