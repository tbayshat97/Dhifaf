@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', $product->translateOrDefault()->title . ' Combinations' )

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
</style>
@endsection

@section('content')
<div class="section section-data-tables">
    <div class="row">
        <div class="col s12 m12 l12">
            <div id="button-trigger" class="card card card-default scrollspy">
                <div class="card-content">
                    <h4 class="card-title">{{ __('admin-content.list') }}</h4>
                    <div class="row">
                        <div class="col s12">
                            <table id="page-length-option" class="display">
                                <thead>
                                    <tr>
                                        <th>{{ __('Id') }}</th>
                                        <th>{{ __('Price')}}</th>
                                        <th>{{ __('Combination')}}</th>
                                        <th>{{ __('QTY')}}</th>
                                        <th>{{ __('SKU')}}</th>
                                        <th class="no-sort">{{ __('admin-content.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($combinations as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->translateOrDefault()->combination }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ $item->sku }}</td>
                                        <td class="center-align">
                                            <a href="{{ route('admin.product-combination.show', $item) }}"
                                                class="btn-floating cyan pulse"><i class="material-icons">edit</i></a>
                                            <a href="#modalDelete"
                                                onclick="setRoute('{{ $item->id }}', '{{ route('admin.product-combination.destroy', $item) }}')"
                                                class="modal-trigger btn-floating red pulse"><i
                                                    class="material-icons">delete</i></a>
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
            <input type="hidden" value="" name="id" id="item_id">
            <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat ">{{ __('admin-content.Cancel') }}</a>
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
</script>
@endsection
