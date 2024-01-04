{{-- extend layout --}}
@extends('layouts.websiteLayoutMaster')

{{-- page title --}}
@section('title', 'Notifications')

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
                        <span>{{__('layout.notifications')}}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="notifications section_padding">
    <div class="container-fluid">
        <notifications-page></notifications-page>
    </div>
</section>
@endsection
@push('scripts')

@endpush
