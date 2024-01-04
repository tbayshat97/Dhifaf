{{-- extend Layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', 'Treeview')

{{-- vendor style --}}
@section('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/jstree/themes/default/style.min.css') }}">
@endsection

{{-- page style --}}
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/extra-components-treeview.css') }}">
@endsection

{{-- page content --}}
@section('content')
    <!-- Treeview  -->
    <div class="section treeview-wrapper">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <div class="row mb-3">
                            <div class="col m6 s12">
                                <h6>Categories Tree View</h6>
                                <div class="jsTreedefault mt-3">
                                    <ul>
                                        @foreach ($divisions as $item)
                                            <li> {{ $item->name }} : {{ $item->id }}
                                                <ul>
                                                    @foreach ($item->categories() as $category)
                                                        <li>{{ $category->name }} :
                                                            {{ $category->id }}
                                                            <ul>
                                                                @foreach ($category->sub()->get() as $sub)
                                                                    <li data-jstree='{"icon" : "jstree-file"}'>
                                                                        {{ $sub->name }} : {{ $sub->id }}
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>

                                </div>
                            </div>
                            <div class="col m6 s12">
                                <h6>Brands Tree View</h6>
                                <div class="jsTreedefault mt-3">
                                    <ul>
                                        @foreach ($brands as $item)
                                            <li> {{ $item->name }} : {{ $item->id }}
                                                <ul>
                                                    @foreach ($item->childs()->get() as $value)
                                                        <li data-jstree='{"icon" : "jstree-file"}'>{{ $value->name }} :
                                                            {{ $value->id }}

                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>

                                </div>
                            </div>
                            {{-- <div class="col m6 s12">
                                <h6>Json data</h6>
                                <div class="jsondataTree mt-3">
                                </div>
                            </div> --}}
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- vendor script --}}
@section('vendor-script')
    <script src="{{ asset('vendors/jstree/jstree.min.js') }}"></script>
@endsection

{{-- page script --}}
@section('page-script')
    <script src="{{ asset('js/scripts/extra-components-treeview.js') }}"></script>
@endsection
