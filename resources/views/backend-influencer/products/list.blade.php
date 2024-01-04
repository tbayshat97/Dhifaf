@extends('layouts-influencer.contentLayoutMaster')

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
<link rel="stylesheet" type="text/css" href="{{asset('vendors/sweetalert/sweetalert.css')}}">
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
                                        <th>{{ __('#') }}</th>
                                        <th>{{ __('admin-content.image')}}</th>
                                        <th>{{ __('admin-content.name')}}</th>
                                        <th>{{ __('admin-content.price')}}</th>
                                        <th>{{ __('admin-content.sale-price')}}</th>
                                        <th class="no-sort">{{ __('admin-content.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><img src="{{ $item->getProductImage() }}" width="75" height="75" class="" />
                                        </td>
                                        <td>
                                            <b>{{$item->translateOrDefault()->title}}</b>
                                            <br>
                                            <small><b>{{ __('admin-content.added-date')}}:</b> {{ $item->created_at }} </small>
                                            <br>
                                            <small><b>{{ __('admin-content.modified-date')}}:</b> {{ $item->updated_at }} </small>
                                        </td>
                                        <td> <b>
                                                {{$item->price.' '.__('admin-content.jod')}}
                                            </b>
                                        </td>
                                        <td>
                                            <b>
                                                @if ($item->sale_price)
                                                {{$item->sale_price .' '.__('admin-content.jod')}}
                                                @endif
                                            </b>
                                        </td>
                                        <td class="center-align">
                                            @if (!count($item->influencerProducts))
                                            <a href='javascript:live("{{ route('influencer.add.product.influencer', $item)
                                                }}");' class="btn-floating tooltipped  cyan pulse"
                                                data-position="top" data-tooltip="Add"><i
                                                    class="material-icons">add</i></a>
                                            @endif

                                            {{-- <form id="frm_confirm_delete" action="{{ route('influencer.add.product.influencer', $item) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                class="btn-floating cyan pulse">
                                                <i class="material-icons">add</i>
                                            </button>
                                            </form> --}}

                                            {{-- <a href="#modalDelete"
                                                onclick="setRoute('{{ $item->id }}', '{{ route('admin.product.destroy', $item->id) }}')"
                                                class="modal-trigger btn-floating red pulse"><i
                                                    class="material-icons">delete</i></a> --}}
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
<script src="{{asset('vendors/sweetalert/sweetalert.min.js')}}"></script>

@endsection

{{-- page script --}}
@section('page-script')
<script src="{{ asset('js/scripts/data-tables.js') }}"></script>
<script src="{{ asset('js/scripts/advance-ui-modals.js') }}"></script>
<script src="{{asset('js/scripts/extra-components-sweetalert.js')}}"></script>

<script>
    function setRoute($id, $route) {
        $('#item_id').val($id);
        $('#frm_confirm_delete').attr('action', $route);
    }
</script>

<script>
    function live(route) {
    swal({
        title: "Are you sure you want add this product?",
        icon: 'warning',
        dangerMode: true,
        buttons: {
            cancel: 'No, Please!',
            delete: 'Yes'
        }
    }).then(function (willDelete) {
        if (willDelete) {
            $.ajax({
                type: "POST",
                url: route,
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                beforeSend: function () {
                    swal({
                        icon: "success",
                        text: "Redirecting ...",
                        timer: 3000,
                        buttons: false
                    });
                },
                success: function (response) {
                    setTimeout(goTo("{{ route('influencer.influencer.product.index') }}"), 2000);
                }
            });
        } else {
            swal("Your imaginary file is safe", {
                title: 'Cancelled',
                icon: "error",
            });
        }
    });
}

function goTo(url) {
    window.location.href = url;
}
</script>
@endsection
