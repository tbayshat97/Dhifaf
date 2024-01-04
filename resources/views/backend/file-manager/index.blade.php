{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', 'File Manager')

{{-- page style --}}
@section('page-style')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
    <style>
        .fm-tree-branch li>p {
            margin-bottom: .1rem;
            padding: .4rem .4rem;
            white-space: nowrap;
            cursor: pointer;
            text-transform: capitalize;
            font-weight: bold;
        }

        .fm-tree .fm-tree-disk {
            padding: .2rem .3rem;
            margin-bottom: .3rem;
            background-color: #fff;
            font-size: 20px;
            text-transform: capitalize;
            font-weight: bold;
        }

        .btn i,
        .btn-floating i,
        .btn-large i,
        .btn-small i,
        .btn-flat i {
            font-size: 16px;
            line-height: inherit;
        }

        .fm-tree-branch li>p.selected,
        .fm-tree-branch li>p:hover {
            background-color: #7024a1;
            border-radius: 5px;
            color: #fff;
        }

        [type=radio]:not(:checked),
        [type=radio]:checked {
            opacity: 1;
        }

    </style>


@endsection

{{-- page content --}}
@section('content')
    <div class="section">
        <div class="row">
            <div class="col s12 m12 l12">
                <div style="height: 700px;">
                    <div id="fm"></div>
                </div>
            </div>
        </div>

    </div>
@endsection

{{-- vendor script --}}
@section('page-script')
    <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>

@endsection
