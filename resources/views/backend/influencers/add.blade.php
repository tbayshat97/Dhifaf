{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', 'Influencers')

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
                                <h4 class="card-title">Add New</h4>
                            </div>
                            <div class="col s12 m6 l2">
                            </div>
                        </div>
                    </div>
                    <div id="html-view-validations">
                        <form class="formValidate0" id="formValidate0" method="POST"
                            action="{{ route('admin.influencer.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="input-field col s12 m12 l12">
                                    <input type="text" name="username" id="username" value="{{ old('username') }}"
                                        class="validate" required />
                                    <label for="username">Username*</label>
                                </div>
                                @foreach ($langs as $key => $lang)
                                <div class="input-field col s12 m6 l6">
                                    <input type="text" name="name_{{$lang['code']}}" id="name_{{$lang['code']}}" value="{{ old('name') }}"
                                        class="validate" required />
                                    <label for="name_{{$lang['code']}}">Name ({{$lang['name']}})*</label>
                                </div>
                                @endforeach
                                @foreach ($langs as $key => $lang)
                                <div class="input-field col s12 m6 l6">
                                    <textarea name="bio_{{$lang['code']}}" id="bio_{{$lang['code']}}"
                                        class="materialize-textarea" required></textarea>
                                    <label for="bio_{{$lang['code']}}">Bio
                                        ({{$lang['name']}})*</label>
                                </div>
                                @endforeach
                                <div class="input-field col s12 m6 l6">
                                    <input type="number" step="1" name="percentage" id="percentage" value="{{ old('percentage') }}"
                                        class="validate"/>
                                    <label for="percentage">Fee Per Product</label>
                                </div>

                                <div class="input-field col s12">
                                    <input type="text" name="birthdate" class="datepicker" id="dob">
                                    <label for="dob">DOB</label>
                                </div>
                                <div class="col s12">
                                    <p>Gender</p>
                                    <p>
                                        <label>
                                            <input class="validate" name="gender" type="radio" value="1"/>
                                            <span>Male</span>
                                        </label>
                                    </p>
                                    <label>
                                        <input class="validate" name="gender" type="radio" value="2"/>
                                        <span>Female</span>
                                    </label>
                                    <div class="input-field">
                                    </div>
                                </div>
                                <div class="input-field col s12">
                                    <label for="password">Password</label>
                                    <input class="validate" id="password" type="password" name="password">
                                </div>
                                <div class="input-field col s12">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input class="validate" id="password_confirmation" type="password"
                                        name="password_confirmation">
                                </div>
                                <div class="input-field col s12">
                                    <label for="curl0">Phone Number *</label>
                                    <input type="tel" value="{{ old('phone_number') }}" class="validate"
                                        name="phone">
                                </div>

                                <div class="input-field col s12 m4 l4">
                                        <label for="curl0">Facebook Link</label>
                                        <input type="text" value="{{ old('facebook_link') }}" class="validate"
                                            name="facebook_link">
                                    </div>
                                    <div class="input-field col s12 m4 l4">
                                        <label for="curl0">Twitter Link</label>
                                        <input type="text" value="{{ old('twitter_link') }}" class="validate"
                                            name="twitter_link">
                                    </div>
                                    <div class="input-field col s12 m4 l4">
                                        <label for="curl0">LinkedIn Link</label>
                                        <input type="text" value="{{ old('linkedin_link') }}" class="validate"
                                            name="linkedin_link">
                                    </div>

                                <div class="col s12">
                                    <label for="image">Single Image*</label>
                                    <div class="jFiler-input-dragDrop pos-relative">
                                        <div class="jFiler-input-inner">
                                            <div class="jFiler-input-icon">
                                                <i class="icon-jfi-cloud-up-o"></i>
                                            </div>
                                            <div class="filediv">
                                                <input type="file" name="image" class="file" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col s12">
                                    <label for="header"> Header*</label>
                                    <div class="jFiler-input-dragDrop pos-relative">
                                        <div class="jFiler-input-inner">
                                            <div class="jFiler-input-icon">
                                                <i class="icon-jfi-cloud-up-o"></i>
                                            </div>
                                            <div class="filediv">
                                                <input type="file" name="header" class="file" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="col s12">
                                    <label for="gallery">Gallery</label>
                                    <div class="jFiler-input-dragDrop pos-relative">
                                        <div class="jFiler-input-inner">
                                            <div class="jFiler-input-icon">
                                                <i class="icon-jfi-cloud-up-o"></i>
                                            </div>
                                            <div class="filediv">
                                                <input type="file" name="gallery[]" class="file" multiple="" />
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="col s12">
                                    <label for="status">Status</label>
                                    <div class="s12 input-field">
                                        <div class="switch">
                                            <label>
                                                Inactive
                                                <input type="checkbox" name="status" id="status" checked>
                                                <span class="lever"></span>
                                                Active
                                            </label>
                                        </div>
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

<script>
        $(document).ready(function() {
            $('input[name="image"]').fileuploader({
                limit: 1,
                maxSize: 15,
            });
            $('input[name="header"]').fileuploader({
                limit: 1,
                maxSize: 15,
            });
            // $('input[name="gallery[]"]').fileuploader({
            //     limit: 10,
            //     maxSize: 15,
            //     addMore: true,
            // });
        });
</script>
@endsection
