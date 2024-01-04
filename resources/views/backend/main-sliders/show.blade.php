{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', 'Main Slider')

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
                        <form class="formValidate0" id="formValidate0" method="POST" action="{{ route('admin.main-slider.update', $mainSlider->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                @foreach ($langs as $key => $lang)
                                <div class="input-field col s12 m6 l6">
                                    <input type="text" name="line_one_{{$lang['code']}}" id="line_one_{{$lang['code']}}"
                                    value="{{$mainSlider->translateOrDefault($lang['code'])->line_one}}"
                                    class="validate" required />
                                    <label for="line_one_{{$lang['code']}}">Line One
                                        ({{$lang['name']}})*</label>
                                </div>
                                @endforeach
                                @foreach ($langs as $key => $lang)
                                <div class="input-field col s12 m6 l6">
                                    <input type="text" name="line_two_{{$lang['code']}}" id="line_two_{{$lang['code']}}"
                                    value="{{$mainSlider->translateOrDefault($lang['code'])->line_two}}"
                                    class="validate" required />
                                    <label for="line_two_{{$lang['code']}}">Line Two
                                        ({{$lang['name']}})*</label>
                                </div>
                                @endforeach
                                @foreach ($langs as $key => $lang)
                                <div class="input-field col s12 m6 l6">
                                    <input type="text" name="line_three_{{$lang['code']}}" id="line_three_{{$lang['code']}}"
                                    value="{{$mainSlider->translateOrDefault($lang['code'])->line_three}}"
                                    class="validate" required />
                                    <label for="line_three_{{$lang['code']}}">Line Three
                                        ({{$lang['name']}})*</label>
                                </div>
                                @endforeach
                                @foreach ($langs as $key => $lang)
                                <div class="input-field col s12 m6 l6">
                                    <input type="text" name="line_four_{{$lang['code']}}" id="line_four_{{$lang['code']}}"
                                    value="{{$mainSlider->translateOrDefault($lang['code'])->line_four}}"
                                    class="validate" required />
                                    <label for="line_four_{{$lang['code']}}">Line Four
                                        ({{$lang['name']}})*</label>
                                </div>
                                @endforeach
                                @foreach ($langs as $key => $lang)
                                <div class="input-field col s12 m6 l6">
                                    <input type="text" name="btn_text_{{$lang['code']}}" id="btn_text_{{$lang['code']}}"
                                    value="{{$mainSlider->translateOrDefault($lang['code'])->btn_text}}"
                                    class="validate" required />
                                    <label for="btn_text_{{$lang['code']}}">Button Text
                                        ({{$lang['name']}})*</label>
                                </div>
                                @endforeach
                                <div class="input-field col s12">
                                    <input type="text" name="btn_link" id="btn_link"
                                        class="validate" value="{{ $mainSlider->btn_link }}" required />
                                    <label for="btn_link">Button Link*</label>
                                </div>
                                <div class="col s12">
                                    <label for="image">Image</label>
                                    <div class="s12 input-field">
                                        <input type="file" name="image" id="input-file-events" class="dropify-event"
                                        data-default-file="{{ asset('storage') . '/' .$mainSlider->image }}"
                                        accept="image/*"/>
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
@endsection
