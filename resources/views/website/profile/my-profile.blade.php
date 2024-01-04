{{-- extend layout --}}
@extends('layouts.websiteLayoutMaster')

{{-- page title --}}
@section('title', 'My Profile')

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
                        <span>{{__('layout.my_profile')}}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="my-profile">
    <div class="container-fluid">
        <edit-profile></edit-profile>
    </div>
</section>
@endsection
@push('scripts')

@endpush
