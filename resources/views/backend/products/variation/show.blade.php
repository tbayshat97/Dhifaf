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
                                    <h4 class="card-title">{{ 'Add Product' }}</h4>
                                </div>
                                <div class="col s12 m6 l2">
                                </div>
                            </div>
                        </div>
                        <div id="html-view-validations">
                            <form class="formValidate0" id="formValidate0" method="POST"
                                action="{{ route('admin.product-variation.add', $product->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col s12" id="product_attributes">
                                        <div class="repeaterAttributes">
                                            <div data-repeater-list="attributes">
                                                <div data-repeater-item class="row">
                                                    <div class="input-field col s4">
                                                        <input type="text" placeholder="Option (en)" name="attributes_en"
                                                            class="form-control" id="attributes_en" required>
                                                    </div>
                                                    <div class="input-field col s4">
                                                        <input type="text" placeholder="Option (ar)" name="attributes_ar"
                                                            id="attributes_ar" class="form-control" required>
                                                    </div>
                                                    <div class="form-group col-md-1 mt-4">
                                                        <button data-repeater-delete type="button"
                                                            class="btn-floating red pulse">
                                                            <i class="material-icons">delete</i>
                                                        </button>
                                                    </div>
                                                    <div class="col 12">
                                                        <!-- innner repeater -->
                                                        <div class="inner-repeater">
                                                            <div data-repeater-list="inner-list">
                                                                <div data-repeater-item class="row">
                                                                    <div class="input-field col s4">
                                                                        <input type="text" name="attributes_item_en"
                                                                            id="attributes_item_en" class="form-control"
                                                                            placeholder="Item (en)" required>
                                                                    </div>
                                                                    <div class="input-field col s4">
                                                                        <input type="text" name="attributes_item_ar"
                                                                            id="attributes_item_ar" class="form-control"
                                                                            placeholder="Item (ar)" required>
                                                                    </div>
                                                                    <div class="input-field col s4">
                                                                        <button data-repeater-delete type="button"
                                                                            class="btn-floating red pulse">
                                                                            <i class="material-icons">delete</i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button data-repeater-create type="button"
                                                                class="btn btn-warning ml-2 mb-2">Add sub item</button>
                                                        </div>
                                                        <!-- innner repeater -->
                                                    </div>
                                                </div>
                                            </div>

                                            <button data-repeater-create type="button"
                                                class="btn-floating cyan pulse right">
                                                <i class="material-icons">add</i>
                                            </button>
                                        </div>
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
        $(document).ready(function() {
            $('input[name="image"]').fileuploader({
                limit: 1,
                maxSize: 15,
            });
            $('input[name="gallery[]"]').fileuploader({
                limit: 10,
                maxSize: 15,
                addMore: true,
            });

            $('.repeater').repeater({
                initEmpty: true,
                show: function() {
                    $(this).slideDown();
                },
                hide: function(deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                    }
                },
                isFirstItemUndeletable: true
            });

            var $repeater = $('.repeaterAttributes').repeater({
                initEmpty: true,
                show: function() {
                    $(this).slideDown();
                },
                hide: function(deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                    }
                },
                isFirstItemUndeletable: true,
                repeaters: [{
                    selector: '.inner-repeater',
                    isFirstItemUndeletable: true,
                }]
            });

            $repeater.setList(@json($variants));
        });
    </script>
@endsection
