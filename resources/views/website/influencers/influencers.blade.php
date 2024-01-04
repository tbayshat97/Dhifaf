{{-- extend layout --}}
@extends('layouts.websiteLayoutMaster')

{{-- page title --}}
@section('title', 'Influencers')

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
                        <a href="/">Home</a>
                    </li>
                    <li>
                        <span>Influencers</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="influencers-page section_padding">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3>Influencers</h3>
                <influencers-list></influencers-list>
            </div>
        </div>
    </div>
</section>


@endsection
@push('scripts')
    
@endpush