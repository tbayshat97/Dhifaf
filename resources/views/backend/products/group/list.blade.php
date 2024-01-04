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
<link rel="stylesheet" type="text/css" href="{{ asset('css/pages/data-tables.css') }}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2-materialize.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') }}">
@endsection

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{ asset('css/pages/data-tables.css') }}">
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/form-select2.css')}}">
<style>
    .dataTables_wrapper {
        overflow: auto;
    }

    .material-icons.vertical-align-middle,
    .vertical-align-middle {
        vertical-align: middle;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col s12">
        <div class="card blue">
            <div class="card-content pd-0" style="padding:0">
                <div class="card-tabs">
                    <ul class="tabs tabs-fixed-width">
                        <li class="tab"><a target="_self" class="" href="
                                    {{ route('admin.product.show', $product->id) }}">
                                <i class="material-icons vertical-align-middle">photo_library</i> <b>Product
                                    Info</b>
                            </a>
                        </li>

                        <li class="tab"><a target="_self" class="active"
                                href="{{ route('admin.group-product.show', $product->id) }}"><i
                                    class="material-icons vertical-align-middle">grid_on</i>
                                <b>Product Variation</b></a></li>

                        <li class="tab"><a target="_self" class="" href="
                                    {{ route('admin.related-product.show', $product->id) }}">
                                <i class="material-icons vertical-align-middle">library_books</i>
                                <b>Related</b></a>
                        </li>
                        <li class="tab"><a target="_self" class="" href="
                                    {{ route('admin.cross-sale-product.show', $product->id) }}">
                                <i class="material-icons vertical-align-middle">library_add</i>
                                <b>Cross-selling</b></a>
                        </li>
                        <li class="tab"><a target="_self" href="
                                        {{ route('admin.up-sale-product.show', $product->id) }}">
                                <i class="material-icons vertical-align-middle">collections_bookmark</i>
                                <b>Up-selling</b></a>
                        </li>
                    </ul>

                </div>

            </div>


        </div>
    </div>
</div>
<div class="section section-data-tables">
    <div class="row">
        <div class="col s12 m12 l12">
            <div id="button-trigger" class="card card card-default scrollspy">
                <div class="card-content">
                    <h4 class="card-title">Add Product Variation</h4>
                    <div id="html-view-validations">
                        <form class="formValidate0" id="formValidate0" method="post"
                            action="{{ route('admin.group-product.update', $product->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="input-field col s6">
                                    <select name="group" id="group" required class="select2-size-sm browser-default">
                                    </select>
                                </div>
                                <div class="input-field col s3" style="margin-top: 2%">
                                    <button class="btn cyan waves-effect waves-light right" type="submit"
                                        name="action">{{ __('admin-content.submit') }}
                                        <i class="material-icons right">send</i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <table id="page-length-option" class="display">
                                <thead>
                                    <tr>
                                        <th>{{ __('Code') }}</th>
                                        <th>{{ __('admin-content.thumbnail') }}</th>
                                        <th>{{ __('admin-content.name') }}</th>
                                        <th>{{ __('Barcode') }}</th>
                                        <th>{{ __('admin-content.price') }}</th>
                                        <th class="no-sort">{{ __('admin-content.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $key => $item)
                                    <tr>
                                        <td><small>{{ $item->code }}</small></td>
                                        <td><img src="{{ $item->getProductImage() }}" width="75" height="75" class="" />
                                        </td>
                                        <td>
                                            <b>{{ optional($item->translateOrDefault())->title }}</b>
                                            <br>
                                            <small><b>{{ __('admin-content.added-date') }}:</b> {{ $item->created_at }}
                                            </small>
                                            <br>
                                            <small><b>{{ __('admin-content.modified-date') }}:</b> {{ $item->updated_at
                                                }} </small>
                                        </td>
                                        <td><small>{{ $item->barcode }}</small></td>
                                        <td> <b>
                                                {{ $item->price }}
                                            </b>
                                        </td>
                                        <td class="center-align">
                                            <a href="#modalDelete" data-position="bottom" data-delay="50"
                                                data-tooltip="Delete"
                                                onclick="setRoute('{{ $item->id }}', '{{ route('admin.group-product.destroy', $item) }}')"
                                                class="tooltipped modal-trigger btn-floating red pulse"><i
                                                    class="material-icons">delete</i></a>
                                            <a href="javascript:;"
                                                data-tooltip="Mark as Default"
                                                onclick="markAsDefault('{{ $item->id }}', '{{ route('admin.group-product.default') }}', '{{ $product->id }}')"
                                                class="tooltipped btn-floating yellow pulse"><i
                                                    class="material-icons">star_outline</i></a>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
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
            <input type="hidden" value="{{ $product->id }}" name="product_id" id="product_id">
            <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat ">{{ __('admin-content.Cancel')
                }}</a>
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
<script src="{{asset('vendors/select2/select2.full.min.js')}}"></script>
<script>
    $(document).ready(function () {
        var id = "{{ $product->id }}"
        var url = "{{ route('admin.group-product.ajax.show', ':id') }}";
        url = url.replace(':id', id);

        $('#group').select2({
            dropdownAutoWidth: true,
            width: '100%',
            containerCssClass: 'select-sm',
            ajax: {
                url: url,
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (index, item) {
                            return {
                                text: index,
                                id: item
                            }
                        })
                    };
                },
                cache: true
            }
        });
    });

    function markAsDefault(newDefault, route, oldDefault) {
        $.ajax({
            type: "POST",
            url: route,
            data: {
                "_token": "{{ csrf_token() }}",
                newDefault: newDefault,
                oldDefault: oldDefault
            },
            success: function (response) {
                var toastHTML = `<span>${response.message}</span><button class="btn-flat toast-action">Ok</button>`;
                M.toast({ html: toastHTML });

                setTimeout(() => {
                    goToShow(response.url);
                }, 2000);
            }
        });
    }

    function setRoute($id, $route) {
        $('#item_id').val($id);
        $('#frm_confirm_delete').attr('action', $route);
    }

    function goToShow(url) {
        window.location.href = url;
    }
</script>
@endsection
