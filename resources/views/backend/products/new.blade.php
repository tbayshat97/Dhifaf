@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', __('admin-content.products'))

{{-- vendor styles --}}
@section('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/flag-icon/css/flag-icon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/data-tables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/data-tables/css/select.dataTables.min.css') }}">
@endsection

{{-- page style --}}
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/data-tables.css') }}">
    <style>
        .dataTables_wrapper {
            overflow: auto;
        }

        .btn-small {
            padding: 0 0.5rem;
        }

        i.left {
            float: left;
            margin-right: 5px;
        }

        tr>td:last-of-type {
            text-align: center;
            padding: 0px 0px !important;
        }

        #main .section-data-tables .dataTables_wrapper table.dataTable th {
            padding: 10px 10px;
            font-weight: bold;
        }

        b,
        strong {
            font-weight: bold;
            text-transform: capitalize;
        }

    </style>
@endsection

@section('content')
    <div class="section section-data-tables">
        <div class="row">
            <div class="col s12 m12 l12">
                <div id="button-trigger" class="card card card-default scrollspy">
                    <div class="card-content">
                        <h4 class="card-title">All Products: {{ $total }}</h4>
                        <div class="row">
                            <div class="input-field col s12 m2 l2">
                                <input type="text" id="code" name="code" value="" class="validate" />
                                <label for="code">{{ __('Code') }}</label>
                            </div>

                            <div class="input-field col s12 m2 l2">
                                <input type="text" id="barcode" name="barcode" value="" class="validate" />
                                <label for="barcode">{{ __('Barcode') }}</label>
                            </div>

                            <div class="input-field col s12 m2 l2">
                                <input type="number" id="price" min="0" step="0.01" name="price" value=""
                                    class="validate" />
                                <label for="price">{{ __('admin-content.price') }}</label>
                            </div>

                            <div class="input-field col s12 m6 l6 ">
                                <input type="text" name="title" id="title" value="" class="validate" />
                                <label for="title">{{ __('Title') }}</label>
                            </div>

                            <div class="input-field col s12 m4 l4">
                                {!! Form::select('brand', $brands, null, ['id' => 'brand', 'placeholder' => 'All brands']) !!}
                                <label>{{ __('Brand') }}</label>
                            </div>

                            <div class="input-field col s12 m4 l4">
                                {!! Form::select('category[]', $categories, null, ['id' => 'categories', 'multiple' => true]) !!}
                                <label>{{ __('Categories') }}</label>
                            </div>

                            <div class="input-field col s12 m3 l3">
                                {!! Form::select('status', $statuses, null, ['id' => 'status', 'placeholder' => 'All']) !!}
                                <label>{{ __('Status') }}</label>
                            </div>

                            <div class="input-field col s12 m1 l1">
                                <a href="{{ route('admin.product.index') }}"
                                    class="mb-6 btn-floating tooltipped waves-effect waves-light gradient-45deg-light-blue-cyan"
                                    data-position="bottom" data-tooltip="Reset">
                                    <i class="material-icons">refresh</i>
                                </a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s12">
                                <table id="products-datatable" class="display">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div id="modalDelete" class="modal">
        <div class="modal-content">
            <h4>{{ __('admin-content.delete') }}</h4>
            <p>{{ __('admin-content.are-you-sure-you-need-to-delete-this') }} ?</p>
        </div>
        <div class="modal-footer">
            <form id="frm_confirm_delete" action="#" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" value="" name="id" id="item_id">
                <a href="#!"
                    class="modal-action modal-close waves-effect waves-red btn-flat ">{{ __('admin-content.Cancel') }}</a>
                <button class="btn waves-effect waves-light" type="submit" name="action">{{ __('admin-content.submit') }}
                    <i class="material-icons right">send</i>
                </button>
            </form>
        </div>
    </div>
@endsection
{{-- vendor scripts --}}
@section('vendor-script')
    <script src="{{ asset('vendors/data-tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendors/data-tables/js/dataTables.select.min.js') }}"></script>
@endsection

{{-- page script --}}
@section('page-script')
    <script src="{{ asset('js/scripts/data-tables.js') }}"></script>
    <script src="{{ asset('js/scripts/advance-ui-modals.js') }}"></script>

    <script>
        function setRoute($id, $route) {
            $('#item_id').val($id);
            $('#frm_confirm_delete').attr('action', $route);
        }

        var table = $('#products-datatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: "{{ route('admin.product.ajax') }}",
                data: function(data) {
                    data.new_arrival = true,
                    data.brand = $('#brand').val();
                    data.categories = $('#categories').val();
                    data.status = $('#status').val();
                    data.price = $('#price').val();
                    data.code = $('#code').val();
                    data.barcode = $('#barcode').val();
                    data.title = $('#title').val();
                },
            },
            order: false,
            columns: [{
                    orderable: false,
                    title: "{{ __('Code') }}",
                    render: function(data, type, row) {
                        return `<small>${row.code}</small>`;
                    },
                },
                {
                    orderable: false,
                    title: "{{ __('Thumbnail') }}",
                    render: function(data, type, row) {
                        return `
                        <img src="${row.image}" class="responsive-img photo-border mt-10" alt="" style="width: 60px; height: 60px;">`;
                    },
                },

                {
                    orderable: false,
                    title: "{{ __('admin-content.title') }}",
                    render: function(data, type, row) {
                        return `
                            <b><a href="${row.show_url}">${row.title}</a></b><br>
                            <small>{{ __('admin-content.added-date') }}: ${row.created_at}</small>
                                <br>
                            <small>{{ __('admin-content.modified-date') }}: ${row.updated_at}</small>
                        `;
                    },
                },
                {
                    orderable: false,
                    title: "{{ __('Type') }}",
                    render: function(data, type, row) {
                        return ` <span class="task-cat cyan">Simple</span>`;

                    },
                },
                {
                    orderable: false,
                    title: "{{ __('Is Featured?') }}",
                    render: function(data, type, row) {
                        console.log("ddd:", row.featured)
                        if (row.featured) {
                            return `<span class="task-cat green">Yes</span>`;
                        } else {
                            return `<span class="task-cat red">No</span>`;
                        }

                    },
                },
                {
                    orderable: false,
                    title: "{{ __('Barcode') }}",
                    render: function(data, type, row) {
                        return `<small>${row.barcode}</small>`;
                    },
                },

                {
                    orderable: false,
                    title: "{{ __('admin-content.price') }}",
                    render: function(data, type, row) {

                        if (row.sale_price > 0) {
                            return `<b>$${row.sale_price}</b> <del class="red-text">$${row.price}</del>`;
                        } else {
                            return `<b>$${row.price}</b>`;
                        }
                    },
                },
                {
                    orderable: false,
                    title: "{{ __('Qty') }}",
                    render: function(data, type, row) {
                        return row.qty;
                    },
                },
                {
                    orderable: false,
                    title: "{{ __('admin-content.status') }}",
                    render: function(data, type, row) {

                        if (row.status === 'Draft') {
                            return `<span class="task-cat blue">${row.status}</span>`;
                        } else if (row.status === 'Unpublished') {
                            return `<span class="task-cat pink">${row.status}</span>`;

                        } else {
                            return `<span class="task-cat green">${row.status}</span>`;
                        }

                    },
                },
                {
                    orderable: false,
                    title: "{{ __('admin-content.action') }}",
                    render: function(data, type, row) {
                        return `
                            <a href="${row.show_url}" class="waves-effect waves-light btn-small gradient-45deg-light-blue-cyan"><i class="material-icons left">edit</i>Edit</a>
                            <a href="${row.rate}" class="waves-effect waves-light btn-small gradient-45deg-amber-amber"><i class="material-icons left">star</i>Reviews</a>
                            <a href="#modalDelete" onclick="setRoute('${row.id}', '${row.delete_url}')" class="waves-effect waves-light btn-small gradient-45deg-red-pink modal-trigger"><i class="material-icons left">delete</i>Delete</a>
                        `;
                    },
                }
            ]
        });

        $('#brand, #categories, #status').change(function(e) {
            table.ajax.reload();
        });

        $("#price, #code, #barcode, #title").keyup(function(e) {
            table.ajax.reload();
        });
    </script>
@endsection
