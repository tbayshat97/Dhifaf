{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', 'Contact')

{{-- vendor styles --}}
@section('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/flag-icon/css/flag-icon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/dropify/css/dropify.min.css') }}">
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
                                    <h4 class="card-title">Update</h4>
                                </div>
                                <div class="col s12 m6 l2">
                                </div>
                            </div>
                        </div>
                        <div id="html-view-validations">
                            <form id="addform" class="forms-sample" method="POST"
                                action="{{ route('admin.contact.update', $contact) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    @foreach ($langs as $key => $lang)
                                        <div class="input-field col s12">
                                            <label for="content_{{ $lang['code'] }}">Content
                                                ({{ $lang['code'] }})*</label>
                                            <textarea name="content_{{ $lang['code'] }}"
                                                id="content_{{ $lang['code'] }}" class="materialize-textarea"
                                                class="validate"
                                                required>{{ $contact->translateOrDefault($lang['code'])->content }}</textarea>
                                        </div>
                                    @endforeach
                                    {{-- contact us locations --}}
                                    <div class="col s12">
                                        <label for="location_old">Locations</label>
                                        @if ($contact->contactLocations)
                                            @foreach ($contact->contactLocations as $key => $item)
                                                <div class="row mb-2">
                                                    <input type="hidden" name="location_old[{{ $key }}][id]"
                                                        value="{{ $item->id }}">
                                                    <div class="input-field col s12 m3 l3">
                                                        <input type="text"
                                                            name="location_old[{{ $key }}][country_en]"
                                                            class="form-control"
                                                            value="{{ $item->translateOrDefault('en')->country }}"
                                                            placeholder="Country English Name">
                                                    </div>
                                                    <div class="input-field col s12 m3 l3">
                                                        <input type="text"
                                                            name="location_old[{{ $key }}][country_ar]"
                                                            class="form-control"
                                                            value="{{ $item->translateOrDefault('ar')->country }}"
                                                            placeholder="Country Arabic Name">
                                                    </div>
                                                    <div class="input-field col s12 m3 l3">
                                                        <input type="text"
                                                            name="location_old[{{ $key }}][street_en]"
                                                            class="form-control"
                                                            value="{{ $item->translateOrDefault('en')->street }}"
                                                            placeholder="Street English Name">
                                                    </div>
                                                    <div class="input-field col s12 m3 l3">
                                                        <input type="text"
                                                            name="location_old[{{ $key }}][street_ar]"
                                                            class="form-control"
                                                            value="{{ $item->translateOrDefault('ar')->street }}"
                                                            placeholder="Street Arabic Name">
                                                    </div>
                                                    <div class="input-field col s12 m3 l3">
                                                        <input type="text"
                                                            name="location_old[{{ $key }}][area_en]"
                                                            class="form-control"
                                                            value="{{ $item->translateOrDefault('en')->area }}"
                                                            placeholder="Area English Name">
                                                    </div>
                                                    <div class="input-field col s12 m3 l3">
                                                        <input type="text"
                                                            name="location_old[{{ $key }}][area_ar]"
                                                            class="form-control"
                                                            value="{{ $item->translateOrDefault('ar')->area }}"
                                                            placeholder="Area Arabic Name">
                                                    </div>
                                                    <div class="input-field col s12 m3 l3">
                                                        <input type="text"
                                                            name="location_old[{{ $key }}][city_en]"
                                                            class="form-control"
                                                            value="{{ $item->translateOrDefault('en')->city }}"
                                                            placeholder="City English Name">
                                                    </div>
                                                    <div class="input-field col s12 m3 l3">
                                                        <input type="text"
                                                            name="location_old[{{ $key }}][city_ar]"
                                                            class="form-control"
                                                            value="{{ $item->translateOrDefault('ar')->city }}"
                                                            placeholder="City Arabic Name">
                                                    </div>
                                                    <button type="button"
                                                        class="btn-floating red pulse ml-2 btn-remove-old-cl">
                                                        <i class="material-icons">delete</i>
                                                    </button>
                                                </div>
                                            @endforeach
                                        @endif
                                        <div class="repeater">
                                            <div data-repeater-list="locations">
                                                <div data-repeater-item class="row mb-2">
                                                    <div class="input-field col s12 m3 l3">
                                                        <input type="text" name="location_country_en" class="form-control"
                                                            placeholder="Country English Name">
                                                    </div>
                                                    <div class="input-field col s12 m3 l3">
                                                        <input type="text" name="location_country_ar" class="form-control"
                                                            placeholder="Country Arabic Name">
                                                    </div>
                                                    <div class="input-field col s12 m3 l3">
                                                        <input type="text" name="location_street_en" class="form-control"
                                                            placeholder="Street English Name">
                                                    </div>
                                                    <div class="input-field col s12 m3 l3">
                                                        <input type="text" name="location_street_ar" class="form-control"
                                                            placeholder="Street Arabic Name">
                                                    </div>
                                                    <div class="input-field col s12 m3 l3">
                                                        <input type="text" name="location_area_en" class="form-control"
                                                            placeholder="Area English Name">
                                                    </div>
                                                    <div class="input-field col s12 m3 l3">
                                                        <input type="text" name="location_area_ar" class="form-control"
                                                            placeholder="Area Arabic Name">
                                                    </div>
                                                    <div class="input-field col s12 m3 l3">
                                                        <input type="text" name="location_city_en" class="form-control"
                                                            placeholder="City English Name">
                                                    </div>
                                                    <div class="input-field col s12 m3 l3">
                                                        <input type="text" name="location_city_ar" class="form-control"
                                                            placeholder="City Arabic Name">
                                                    </div>
                                                    <button data-repeater-delete type="button"
                                                        class="btn-floating red pulse">
                                                        <i class="material-icons">delete</i>
                                                    </button>
                                                </div>
                                            </div>
                                            <button data-repeater-create type="button"
                                                class="btn-floating cyan pulse right">
                                                <i class="material-icons">add</i>
                                            </button>
                                        </div>
                                    </div>
                                    {{-- end contact us locations --}}

                                    {{-- contact us contact Info --}}
                                    <div class="col s12">
                                        <label for="info_old">Contact Info</label>
                                        @if ($contact->contactInfos)
                                            @foreach ($contact->contactInfos as $key => $item)
                                                <div class="row mb-2">
                                                    <input type="hidden" name="info_old[{{ $key }}][id]"
                                                        value="{{ $item->id }}">
                                                    <div class="input-field col s12 m3 l3">
                                                        <input type="text"
                                                            name="info_old[{{ $key }}][title_en]"
                                                            class="form-control"
                                                            value="{{ $item->translateOrDefault('en')->title }}"
                                                            placeholder="English Title">
                                                    </div>
                                                    <div class="input-field col s12 m3 l3">
                                                        <input type="text"
                                                            name="info_old[{{ $key }}][title_ar]"
                                                            class="form-control"
                                                            value="{{ $item->translateOrDefault('ar')->title }}"
                                                            placeholder="Arabic Title">
                                                    </div>
                                                    <div class="input-field col s12 m3 l3">
                                                        <input type="text"
                                                            name="info_old[{{ $key }}][phone]"
                                                            class="form-control"
                                                            value="{{ $item->phone }}"
                                                            placeholder="Phone">
                                                    </div>
                                                    <button type="button"
                                                        class="btn-floating red pulse ml-2 btn-remove-old-ci">
                                                        <i class="material-icons">delete</i>
                                                    </button>
                                                </div>
                                            @endforeach
                                        @endif
                                        <div class="repeater">
                                            <div data-repeater-list="infos">
                                                <div data-repeater-item class="row mb-2">
                                                    <div class="input-field col s12 m3 l3">
                                                        <input type="text" name="info_title_en" class="form-control"
                                                            placeholder="English Title">
                                                    </div>
                                                    <div class="input-field col s12 m3 l3">
                                                        <input type="text" name="info_title_ar" class="form-control"
                                                            placeholder="Arabic Title">
                                                    </div>
                                                    <div class="input-field col s12 m3 l3">
                                                        <input type="text" name="info_phone" class="form-control"
                                                            placeholder="Phone">
                                                    </div>
                                                    <button data-repeater-delete type="button"
                                                        class="btn-floating red pulse">
                                                        <i class="material-icons">delete</i>
                                                    </button>
                                                </div>
                                            </div>
                                            <button data-repeater-create type="button"
                                                class="btn-floating cyan pulse right">
                                                <i class="material-icons">add</i>
                                            </button>
                                        </div>
                                    </div>
                                    {{-- end contact us infos --}}


                                    {{-- contact us contact Info --}}
                                    <div class="col s12">
                                        <label for="email_old">Contact Email</label>
                                        @if ($contact->contactEmails)
                                            @foreach ($contact->contactEmails as $key => $item)
                                                <div class="row mb-2">
                                                    <input type="hidden" name="email_old[{{ $key }}][id]"
                                                        value="{{ $item->id }}">
                                                    <div class="input-field col s12 m3 l3">
                                                        <input type="text"
                                                            name="email_old[{{ $key }}][email]"
                                                            class="form-control"
                                                            value="{{ $item->email }}"
                                                            placeholder="Email">
                                                    </div>
                                                    <button type="button"
                                                        class="btn-floating red pulse ml-2 btn-remove-old-ce">
                                                        <i class="material-icons">delete</i>
                                                    </button>
                                                </div>
                                            @endforeach
                                        @endif
                                        <div class="repeater">
                                            <div data-repeater-list="emails">
                                                <div data-repeater-item class="row mb-2">
                                                    <div class="input-field col s12 m3 l3">
                                                        <input type="text" name="info_email" class="form-control"
                                                            placeholder="Email">
                                                    </div>
                                                    <button data-repeater-delete type="button"
                                                        class="btn-floating red pulse">
                                                        <i class="material-icons">delete</i>
                                                    </button>
                                                </div>
                                            </div>
                                            <button data-repeater-create type="button"
                                                class="btn-floating cyan pulse right">
                                                <i class="material-icons">add</i>
                                            </button>
                                        </div>
                                    </div>
                                    {{-- end contact us emai;s --}}

                                    <div class="input-field col s12">
                                        <button class="btn cyan waves-effect waves-light right" type="submit"
                                            name="action">{{ __('admin-content.submit') }}
                                            <i class="material-icons right">send</i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterLabel">
                                            {{ __('admin-content.delete-country') }}
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        {{ __('admin-content.are-you-sure-you-need-to-delete-this') }}
                                        {{ __('admin-content.country') }}?
                                    </div>
                                    <div class="modal-footer">
                                        <form id="frm_confirm_delete_multiple_image" action="#" method="POST">
                                            @csrf
                                            <input type="hidden" value="" name="id" id="item_id">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">{{ __('admin-content.close') }}</button>
                                            <button type="submit" class="btn btn-primary"
                                                href="">{{ __('admin-content.delete') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
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
    <script>
        $('.btn-remove-old-cl').click(function(e) {
            if (confirm('Are you sure you want to delete this element?')) {
                $(this).parent().remove();
            }
        });
        $('.btn-remove-old-ci').click(function(e) {
            if (confirm('Are you sure you want to delete this element?')) {
                $(this).parent().remove();
            }
        });
        $('.btn-remove-old-ce').click(function(e) {
            if (confirm('Are you sure you want to delete this element?')) {
                $(this).parent().remove();
            }
        });

        $('.repeater').repeater({
            initEmpty: true,
            show: function() {
                $(this).slideDown();
                $(function() {});
            },
            hide: function(deleteElement) {
                if (confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }
            },
            isFirstItemUndeletable: true
        });
    </script>

@endsection
