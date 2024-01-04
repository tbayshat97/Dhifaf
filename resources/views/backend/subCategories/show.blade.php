{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', 'Sub Categories')

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
                            action="{{ route('admin.subCategory.update', $subCategory->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                @foreach ($langs as $key => $lang)
                                <div class="input-field col s12 m6 l6 ">
                                    <input type="text" name="name_{{ $lang['code'] }}" id="name_{{ $lang['code'] }}"
                                        value="{{ $subCategory->translateOrDefault($lang['code'])->name }}"
                                        class="validate" required />
                                    <label for="name_{{ $lang['code'] }}">{{ __('admin-content.name') }}
                                        ({{ $lang['name'] }})*</label>
                                </div>
                                @endforeach

                                <div class="col s12">
                                    <label for="Image">Image <small>(720 x 1520)</small></label>
                                    <div class="s12 input-field">
                                        <input type="file" name="image" id="input-file-events" class="dropify-event"
                                            data-default-file="{{ asset('storage') . '/' .$subCategory->image }}"
                                            accept="image/*" />
                                    </div>
                                </div>

                                <div class="col s12">
                                    <label for="Header">Banner <small>( 1920 x 575)</small></label>
                                    <div class="s12 input-field">
                                        <input type="file" name="header" id="input-file-events" class="dropify-event"
                                            data-default-file="{{ asset('storage') . '/' . $subCategory->header }}"
                                            accept="image/*"/>
                                    </div>
                                </div>

                                <div class="input-field col s12 m6 l6">
                                    {!! Form::select('category_id', $categories, $subCategory->category_id, ['multiple' => false, 'id' => 'category_id']) !!}
                                    <label>{{ __('Parent Category') }}</label>
                                </div>

                                <div class="col s12 m6 l6">
                                    <label for="status">Status</label>
                                    <div class="s12 input-field">
                                        <div class="switch">
                                            <label>
                                                Unpublished
                                                <input type="checkbox" name="is_active" id="status" @if($subCategory->is_active) checked @endif>
                                                <span class="lever"></span>
                                                Published
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
@endsection
