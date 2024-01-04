{{-- extend layout --}}
@extends('layouts.websiteRegisterLayout')

{{-- page title --}}
@section('title', 'Verify SMS')

{{-- vendor styles --}}
@section('vendor-style')

@endsection

{{-- page style --}}
@section('page-style')
@endsection

{{-- page content --}}
@section('content')

<section class="login">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6 pl-0">
                <img src="/website/images/register.jpg" alt="">
            </div>
            <div class="col-md-6">
                <verify-update></verify-update>
            </div>
        </div>
    </div>
</section>

@endsection
@push('scripts')
    
@endpush