{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', __('admin-content.products'))

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/flag-icon/css/flag-icon.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/dropify/css/dropify.min.css') }}">
@endsection

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{ asset('css/pages/data-tables.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/fileuploader/dist/font/font-fileuploader.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/fileuploader/dist/jquery.fileuploader.min.css') }}">
@endsection

@section('content')
<div class="section">
    <div class="row">
        <div class="col s12">
            <div id="html-validations" class="card card-tabs">
                <div class="card-content">
                    <div class="card-title">
                        <div class="row">
                            <div class="col s12 m6 l10">
                                <h4 class="card-title">{{ __('admin-content.update') }}</h4>
                            </div>
                            <div class="col s12 m6 l2">
                            </div>
                        </div>
                    </div>
                    <div id="html-view-validations">
                        <form class="formValidate0" id="formValidate0" method="POST"
                            action="{{ route('admin.product-combination.update', $productCombination->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                @foreach ($langs as $key => $lang)
                                <div class="input-field col s12 m6 l6 ">
                                    <input type="text" name="title_{{ $lang['code'] }}" id="title_{{ $lang['code'] }}"
                                        value="{{ $productCombination->translateOrDefault($lang['code'])->combination }}" class="validate"
                                        disabled />
                                    <label for="name_{{ $lang['code'] }}">{{ __('Combination') }} ({{ $lang['name'] }})*</label>
                                </div>
                                @endforeach

                                <div class="input-field col s12 m6 l6">
                                    <input type="text" class="validate" name="sku" value="{{ $productCombination->sku }}" id="sku" />
                                    <label for="sku">{{ __('SKU') }}</label>
                                </div>

                                <div class="input-field col s12 m6 l6">
                                    <input type="number" class="validate" name="qty" value="{{ $productCombination->qty }}" id="qty" />
                                    <label for="qty">{{ __('admin-content.price') }}</label>
                                </div>

                                <div class="input-field col s12 m6 l6">
                                    <input type="number" class="validate" name="price" value="{{ $productCombination->price }}" id="price" />
                                    <label for="price">{{ __('admin-content.sale-price') }}</label>
                                </div>

                                <div class="input-field col s12">
                                    <button class="btn cyan waves-effect waves-light right" type="submit"
                                        name="action">{{ __('admin-content.submit') }}
                                        <i class="material-icons right">send</i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- vendor script --}}
@section('vendor-script')
<script src="{{ asset('vendors/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('vendors/jquery-validation/jquery.validate.min.js') }}"></script>
@endsection

{{-- page script --}}
@section('page-script')
<script src="{{ asset('js/scripts/form-file-uploads.js') }}"></script>
<script src="{{ asset('js/scripts/form-validation.js') }}"></script>
<script src="{{ asset('plugins/jquery.repeater/jquery.repeater.min.js') }}"></script>
<script src="{{ asset('plugins/fileuploader/dist/jquery.fileuploader.min.js') }}"></script>
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<script>
    $(document).ready(function () {
        $('input[name="image"]').fileuploader({
            limit: 1,
            maxSize: 15,
        });
        $('input[name="gallery[]"]').fileuploader({
            limit: 10,
            maxSize: 15,
            addMore: true,
        });
    });
</script>
@endsection
