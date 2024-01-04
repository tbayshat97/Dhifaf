{{-- extend layout --}}
@extends('layouts.websiteLayoutMaster')

{{-- page title --}}
@section('title', 'My Orders')

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
                        <span>{{__('layout.my_orders')}}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="my-orders section_padding">
    <div class="container-fluid">
        <my-orders></my-orders>
    </div>
</section>
@endsection
@push('scripts')

@endpush
