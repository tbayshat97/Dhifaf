{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', 'Update Driver')

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
                        <form id="addform" class="formValidate0" method="POST"
                        action="{{ route('admin.driver.update', $driver) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            <div class="row">
                                <div class="input-field col s12 m6 l6">
                                    <label for="curl0">First Name *</label>
                                    <input type="text" class="validate" name="first_name" value="{{ $driver->first_name}}">
                                </div>
                                <div class="input-field col s12 m6 l6">
                                    <label for="curl0">Last_name *</label>
                                    <input type="text" class="validate" name="last_name" value="{{ $driver->last_name}}">
                                </div>
                                <div class="input-field col s12">
                                    <label for="curl0">phone *</label>
                                    <input type="text" class="validate" name="phone" value="{{ $driver->phone}}">
                                </div>
                                <div class="input-field col s12">
                                    <label for="curl0">Email</label>
                                    <input type="text" class="validate" name="Email" value="{{ $driver->profile->email}}">
                                </div>
                                <div class="input-field col s12">
                                    <input type="text" name="birthdate" class="datepicker" id="dob" @if ($driver->profile
                                    && $driver->profile->birthdate)
                                    value="{{ $driver->profile->birthdate->format('d/m/Y') }}"
                                    @endif>
                                    <label for="dob">{{ __('admin-content.DOB') }}</label>
                                </div>
                                <div class="col s12">
                                    <p>{{ __('admin-content.gender') }}</p>
                                    <p>
                                        <label>
                                            <input class="validate" name="gender" type="radio" value="1"
                                                @if($driver->profile->gender && $driver->profile->gender ===
                                            App\Enums\GenderTypes::Male)
                                            checked
                                            @endif />
                                            <span>{{ __('admin-content.male') }}</span>
                                        </label>
                                    </p>
                                    <label>
                                        <input class="validate" name="gender" type="radio" value="2"
                                            @if($driver->profile->gender && $driver->profile->gender ===
                                        App\Enums\GenderTypes::Female)
                                        checked
                                        @endif />
                                        <span>{{ __('admin-content.female') }}</span>
                                    </label>
                                    <div class="input-field">
                                    </div>
                                </div>
                                <div class="col s12">
                                <label for="image">{{ __('admin-content.image') }}</label>
                                    <div class="s12 input-field">
                                        <input type="file" name="image" id="input-file-events" class="dropify-event"
                                        data-default-file="{{ asset('storage') . '/' .$driver->profile->image }}"
                                        accept="image/*"/>
                                    </div>
                                </div>
                                <div class="input-field col s12">
                                    <button class="btn waves-effect waves-light right" type="submit">Submit
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
<script src="{{ asset('plugins/fileuploader/dist/jquery.fileuploader.min.js') }}"></script>
<script>
   $(document).ready(function () {
   $('input[name="image"]').fileuploader({
       limit: 1,
       maxSize: 15,
   });
</script>
@endsection
