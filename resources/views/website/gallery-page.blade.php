{{-- extend layout --}}
@extends('layouts.websiteLayoutMaster')

{{-- page title --}}
@section('title', 'Gallery')

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
                        <span>Gallery</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!--Header Image-->

<section class="gellery section_padding">
    <div class="container-fluid">
        <gallery-page></gallery-page>
    </div>
</section>

@endsection
@push('scripts')
    
@endpush