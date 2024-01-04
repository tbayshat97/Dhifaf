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
    <category-card></category-card>
@endsection
@push('scripts')

@endpush
