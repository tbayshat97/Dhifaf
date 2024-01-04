{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', $product->translate() ? $product->translateOrDefault()->title : __('Show product'))

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
    <link rel="stylesheet" href="{{ asset('plugins/tagify-master/dist/tagify.css') }}">
    <style>
        .material-icons.vertical-align-middle,
        .vertical-align-middle {
            vertical-align: middle;
        }

        .card .card-required {

            border: solid 2px red;
        }

        label {
            left: 0.75rem;
            text-transform: capitalize;
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
                            <li class="tab"><a target="_self" class="active"
                                    href="{{ route('admin.product.show', $product->id) }}">
                                    <i class="material-icons vertical-align-middle">photo_library</i> <b>Product
                                        Info</b>
                                </a>
                            </li>

                            <li @if (!$product->is_variant) class="tab disabled" @else class="tab" @endif><a target="_self"
                                    href="{{ route('admin.group-product.show', $product->id) }}"><i
                                        class="material-icons vertical-align-middle">grid_on</i>
                                    <b>Product Variation</b></a></li>

                            <li class="tab"><a target="_self" class="" href="
                                    {{ route('admin.related-product.show', $product->id) }}">
                                    <i class="material-icons vertical-align-middle">library_books</i>
                                    <b>Related Products</b></a>
                            </li>

                            <li class="tab"><a target="_self" class="" href="
                                    {{ route('admin.cross-sale-product.show', $product->id) }}">
                                    <i class="material-icons vertical-align-middle">library_add</i>
                                    <b>Cross-selling Products</b></a>
                            </li>

                            <li class="tab"><a target="_self" class="" href="
                                    {{ route('admin.up-sale-product.show', $product->id) }}">
                                    <i class="material-icons vertical-align-middle">collections_bookmark</i>
                                    <b>Up-selling Products</b></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="section">
        <div id="html-view-validations">
            <form class="formValidate0" id="formValidate0" method="POST"
                action="{{ route('admin.product.update', $product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col xl8 m8 s12">
                        <div class="card">
                            <div class="card-content px-36">
                                <h4 class="card-title">SAP Info</h4>
                                <div class="row mb-3">
                                    <div class="input-field col s12 m6 l6">
                                        <input type="text" name="code" value="{{ $product->code }}"
                                            class="validate" required disabled />
                                        <label for="code">{{ __('Code') }}*</label>
                                    </div>

                                    <div class="input-field col s12 m6 l6">
                                        <input type="text" name="barcode" value="{{ $product->barcode }}"
                                            class="validate" required disabled />
                                        <label for="barcode">{{ __('Barcode') }}*</label>
                                    </div>
                                    <div class="input-field col s12 m6 l6">
                                        <input type="text" name="qty" value="{{ $product->qty }}" class="validate"
                                            required disabled />
                                        <label for="qty">{{ __('Qty') }}*</label>
                                    </div>
                                    <div class="input-field col s12 m6 l6">

                                        <input type="number" id="priceOrginal" min="0" step="0.01" name="priceOrginal"
                                            value="{{ $product->price }}" class="validate" required disabled />
                                        <label for="priceOrginal">{{ __('Price') }}*</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-content card-required px-36">
                                <h4 class="card-title">Product Info</h4>
                                @foreach ($langs as $key => $lang)
                                    <div class="input-field s12">
                                        <input type="text" name="title_{{ $lang['code'] }}"
                                            id="title_{{ $lang['code'] }}" value="@if ($product->translate()){{ $product->translateOrDefault($lang['code'])->title }} @endif"
                                            class="validate" required />
                                        <label for="name_{{ $lang['code'] }}">{{ __('admin-content.name') }}
                                            ({{ $lang['name'] }})*</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-content px-36">
                                <h4 class="card-title">Product Content</h4>
                                <br>
                                @foreach ($langs as $key => $lang)
                                    <div class="input-field s12">
                                        <textarea name="description_{{ $lang['code'] }}"
                                            class="materialize-textarea">@if ($product->translate()){{ $product->translateOrDefault($lang['code'])->description }} @endif</textarea>
                                        <label
                                            for="description_{{ $lang['code'] }}">{{ __('admin-content.description') }}
                                            ({{ $lang['name'] }})</label>
                                    </div>
                                @endforeach

                                @foreach ($langs as $key => $lang)
                                    <div class="input-field s12">
                                        <textarea name="how_to_use_{{ $lang['code'] }}"
                                            id="how_to_use_{{ $lang['code'] }}"
                                            class="materialize-textarea">@if ($product->translate()){{ $product->translateOrDefault($lang['code'])->how_to_use }} @endif</textarea>
                                        <label for="how_to_use_{{ $lang['code'] }}">{{ __('How to use') }}
                                            ({{ $lang['name'] }})</label>
                                    </div>
                                @endforeach

                                @foreach ($langs as $key => $lang)
                                    <div class="input-field s12">
                                        <textarea name="ingredients_{{ $lang['code'] }}"
                                            id="ingredients_{{ $lang['code'] }}"
                                            class="materialize-textarea">@if ($product->translate()){{ $product->translateOrDefault($lang['code'])->ingredients }} @endif</textarea>
                                        <label for="ingredients_{{ $lang['code'] }}">{{ __('Ingredients') }}
                                            ({{ $lang['name'] }})</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-content px-36">
                                <h4 class="card-title">Product Price</h4>
                                <div class="input-field s6">
                                    <input type="number" id="price" min="0" step="0.01" name="price"
                                        value="{{ $product->price }}" class="validate" required disabled />
                                    <label for="price">{{ __('admin-content.price') }}</label>
                                </div>

                                <div class="input-field s6">
                                    <input type="number" class="validate" max="{{ $product->price }}"
                                        name="sale_price" value="{{ $product->sale_price }}" id="sale_price" />
                                    <label for="sale_price">{{ __('admin-content.sale-price') }}</label>
                                </div>

                                <div class="s6">
                                    <label for="sale_price_from">Sale price from <small>(required with sale
                                            price)</small></label>
                                    <input type="datetime-local" name="sale_price_from" class="validate"
                                        value="{{ optional($product->sale_price_from)->format('Y-m-d\TH:i') }}"
                                        id="sale_price_from">
                                </div>

                                <div class="s6">
                                    <label for="sale_price_to">Sale price to <small>(required with sale
                                            price)</small></label>
                                    <input type="datetime-local" name="sale_price_to" class="validate"
                                        value="{{ optional($product->sale_price_to)->format('Y-m-d\TH:i') }}"
                                        id="sale_price_to">
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-content px-36">
                                <h4 class="card-title">Product Attribute</h4>
                                <div class="input-field s12">
                                    {!! Form::select('color', $colors, $product->color_id, ['placeholder' => 'Select Color']) !!}
                                    <label>{{ __('Color') }}</label>
                                </div>
                                <br>
                                <div class="input-field s12">
                                    {!! Form::select('size', $sizes, $product->size_id, ['placeholder' => 'Select Size']) !!}
                                    <label>{{ __('Size') }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-content px-36">
                                <h4 class="card-title">Product Options</h4>
                                <div class="input-field s12">
                                    <input type="number" class="validate" max="80" name="age_group"
                                        value="{{ $product->age_group }}" id="age_group" />
                                    <label>{{ __('Age Group') }}</label>
                                </div>

                                <div class="input-field s12">
                                    {!! Form::select('gender', $productGender, $product->gender) !!}
                                    <label>{{ __('Gender') }}</label>
                                </div>

                                <div class="row">
                                    <div class="col s12 m6 l6">
                                        <label for="">New from</label>
                                        <input type="datetime-local" value="{{ optional($product->new_from)->format('Y-m-d\TH:i') }}" name="new_from">
                                    </div>

                                    <div class="col s12 m6 l6">
                                        <label for="">New to</label>
                                        <input type="datetime-local" value="{{ optional($product->new_to)->format('Y-m-d\TH:i') }}" name="new_to">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-content px-36">
                                <h4 class="card-title">Product SEO</h4>
                                <br>
                                <div class="input-field s12">
                                    <input type="text" name="meta_title" id="meta_title" value="{{ $product->meta_title }}" class="validate"/>
                                    <label for="meta_title">{{ __('Meta title') }}</label>
                                </div>

                                <div class="input-field s12">
                                    <textarea name="meta_description"
                                        class="materialize-textarea">{{ $product->meta_description }}</textarea>
                                    <label for="meta_description"> {{ __('Meta description') }} </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col xl4 m4 s12">
                        <div class="card">
                            <div class="card-content px-36">
                                <h4 class="card-title">Update</h4>
                                <div class="input-field s12">
                                    <button class="btn cyan waves-effect waves-light" type="submit"
                                        name="action">{{ __('admin-content.submit') }}
                                        <i class="material-icons right">send</i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-content px-36">
                                <h4 class="card-title">Status</h4>
                                <div class="input-field">
                                    {!! Form::select('status', $statuses, $product->status, ['placeholder' => 'Select Status']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-content px-36">
                                <h4 class="card-title">Stock Status</h4>
                                <div class="input-field">
                                    {!! Form::select('stock_status', $stockStatus, $product->stock_status, ['placeholder' => 'Select Stock Status']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-content card-required px-36">
                                <h4 class="card-title">Brand*</h4>
                                <div class="input-field">
                                    {!! Form::select('brand', $brands, $product->brand_id, ['id' => 'brand','placeholder' => 'Select Brand'], ['required']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-content px-36">
                                <h4 class="card-title">Sub Brand</h4>
                                <div class="input-field">
                                    {!! Form::select('sub_brand', $subBrands, $product->sub_brand_id, ['id' => 'sub_brand','placeholder' => 'Select Sub Brand']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-content px-36">
                                <h4 class="card-title">Division</h4>
                                <div class="input-field">
                                    {!! Form::select('division', $divisions, $product->division_id, ['placeholder' => 'Select Division']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-content card-required px-36">
                                <h4 class="card-title">Category*</h4>
                                <div class="input-field">
                                    {!! Form::select('category', $categories, $category, ['id' => 'category' ,'placeholder' => 'Select Category']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-content px-36">
                                <h4 class="card-title">Sub Categories</h4>
                                <div class="input-field">
                                    {!! Form::select('subcategory', $subcategories, $sub_category , ['id' => 'sub_category', 'required' => false, 'placeholder' => 'Select Sub Category']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-content px-36">
                                <h4 class="card-title">Tags</h4>
                                <div class="input-field">
                                    <input name='tags' @if ($product->tags) value='{{ implode(' , ', json_decode($product->tags)) }}' @endif>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-content px-36">
                                <h4 class="card-title">Is Featured?</h4>
                                <p>
                                    <label>
                                        <input class="filled-in" name="is_featured" @if ($product->is_featured)
                                        checked
                                        @endif type="checkbox">
                                        <span>Featured</span>
                                    </label>
                                </p>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-content px-36">
                                <h4 class="card-title">Product Type</h4>
                                <p>
                                    <label>
                                        <input class="with-gap" name="is_variant" value="0" @if (!$product->is_variant)
                                        checked
                                        @endif type="radio">
                                        <span>Simple Product</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input class="with-gap" name="is_variant" value="1" @if ($product->is_variant)
                                        checked
                                        @endif type="radio">
                                        <span>Variant Product</span>
                                    </label>
                                </p>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-content px-36">
                                <h4 class="card-title">Product Collections</h4>
                                <p>
                                    <label>
                                        <input class="filled-in" name="best_sellers" @if ($product->best_sellers)
                                        checked
                                        @endif type="checkbox">
                                        <span>Best sellers</span>
                                    </label>
                                </p>
                                <p>
                                    <label>
                                        <input class="filled-in" name="special_offer" @if ($product->special_offer)
                                        checked
                                        @endif type="checkbox">
                                        <span>Special offer</span>
                                    </label>
                                </p>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-content card-required px-36">
                                <h4 class="card-title">Featured Image*</h4>
                                <div class="jFiler-input-dragDrop pos-relative">
                                    <div class="jFiler-input-inner">
                                        <div class="jFiler-input-icon">
                                            <i class="icon-jfi-cloud-up-o"></i>
                                        </div>
                                        <div class="filediv">
                                            <input type="file" name="image"
                                                data-fileuploader-files="{{ getFileUploaderMedia($product->image) }}"
                                                class="file" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($product->is_variant)
                            <div class="card">
                                <div class="card-content px-36">
                                    <h4 class="card-title">Swatch Image</h4>
                                    <div class="jFiler-input-dragDrop pos-relative">
                                        <div class="jFiler-input-inner">
                                            <div class="jFiler-input-icon">
                                                <i class="icon-jfi-cloud-up-o"></i>
                                            </div>
                                            <div class="filediv">
                                                <input type="file" name="switcher"
                                                    data-fileuploader-files="{{ getFileUploaderMedia($product->switcher) }}"
                                                    class="file" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="card">
                            <div class="card-content px-36">
                                <h4 class="card-title">Gallery</h4>
                                <div class="jFiler-input-dragDrop pos-relative">
                                    <div class="jFiler-input-inner">
                                        <div class="jFiler-input-icon">
                                            <i class="icon-jfi-cloud-up-o"></i>
                                        </div>
                                        <div class="filediv">
                                            <input type="file" name="gallery[]" data-fileuploader-files="{{ getFileUploaderMedia($product->gallery) }}" class="file"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
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
    <script src="{{ asset('plugins/tagify-master/dist/tagify.js') }}"></script>
    <script>
        (function() {
            var input = document.querySelector('input[name=tags]'),
                // init Tagify script on the above inputs
                tagify = new Tagify(input, {
                    whitelist: [],
                    //  blacklist : [".NET", "PHP"] // <-- passed as an attribute in this demo
                });

            // Chainable event listeners
            tagify.on('add', onAddTag)
                .on('remove', onRemoveTag)
                .on('input', onInput)
                .on('invalid', onInvalidTag)
                .on('click', onTagClick);

            // tag added callback
            function onAddTag(e) {
                tagify.off('add', onAddTag) // exmaple of removing a custom Tagify event
            }

            // tag remvoed callback
            function onRemoveTag(e) {}

            // on character(s) added/removed (user is typing/deleting)
            function onInput(e) {}

            // invalid tag added callback
            function onInvalidTag(e) {}

            // invalid tag added callback
            function onTagClick(e) {}

        $('#category').change(function () {
                var id = $(this).val();
                $('#sub_category option').remove();
                var sub_category = M.FormSelect.getInstance($("#sub_category"))
                sub_category.destroy();
                $.ajax({
                    url: "{{ route( 'admin.category.sub' ) }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                    },
                    type: 'POST',
                    dataType: 'json',
                    success: function (result) {
                        $.each(result, function (k, v) {
                            $('#sub_category').append($('<option>', { value: k, text: v }));
                        });
                        $('#sub_category').formSelect();
                    },
                    error: function () {
                        alert('error...');
                    }
                });
            });

            $('#brand').change(function () {
                var id = $(this).val();
                $('#sub_brand option').remove();
                var sub_brand = M.FormSelect.getInstance($("#sub_brand"))
                sub_brand.destroy();
                $.ajax({
                    url: "{{ route( 'admin.brand.sub' ) }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                    },
                    type: 'POST',
                    dataType: 'json',
                    success: function (result) {
                        $.each(result, function (k, v) {
                            $('#sub_brand').append($('<option>', { value: k, text: v }));
                        });
                        $('#sub_brand').formSelect();
                    },
                    error: function () {
                        alert('error...');
                    }
                });
            });
        })()

        $(document).ready(function() {
            $('input[name="image"]').fileuploader({
                limit: 1,
                maxSize: 15,
            });

            $('input[name="switcher"]').fileuploader({
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
