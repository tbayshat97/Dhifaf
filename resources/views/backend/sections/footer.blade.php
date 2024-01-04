@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Footer Section')
{{-- vendor style --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/flag-icon/css/flag-icon.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/dropify/css/dropify.min.css') }}">
@endsection

{{-- page content --}}
@section('content')
<div class="row">
    <div class="col s12">
        <div id="html-validations" class="card card-tabs">
            <div class="card-content">
                <div class="card-title">
                    <div class="row">
                        <div class="col s12 m6 l10">
                            <h4 class="card-title">Footer Section</h4>
                        </div>
                        <div class="col s12 m6 l2">
                        </div>
                    </div>
                </div>
                <div id="html-view-validations">
                    <form id="addform" class="formValidate0" method="POST"
                        action="{{ route('admin.section-footer-update', $section) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            @foreach ($langs as $key => $lang)
                            @php
                            $sectionData = json_decode($section->translateOrDefault($lang['code'])->data);
                            @endphp
                            <div class="input-field col s12 m6 l6">
                                <input type="text" name="content_{{ $lang['code'] }}" id="content_{{ $lang['code'] }}"
                                value="{{$sectionData->content}}"
                                 class="validate" required />
                                <label for="content_{{ $lang['code'] }}">Content {{ $lang['code'] }}*</label>
                            </div>
                            @endforeach
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

