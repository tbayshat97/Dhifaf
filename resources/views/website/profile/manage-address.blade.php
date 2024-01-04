{{-- extend layout --}}
@extends('layouts.websiteLayoutMaster')

{{-- page title --}}
@section('title', 'Manage Address')

{{-- vendor styles --}}
@section('vendor-style')

@endsection

{{-- page style --}}
@section('page-style')
@endsection

{{-- page content --}}
@section('content')

<section>
    <div class="inner_header">
        <div class="header_breadcrump">
            <div class="container-fluid">
                <ul>
                    <li>
                        <a href="/">{{__('layout.home')}}</a>
                    </li>
                    <li>
                        <span>{{__('layout.manage_address')}}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="manage_address section_padding">
    <div class="container-fluid">
        <manage-address></manage-address>
    </div>
</section>
@endsection
@push('scripts')

@endpush
