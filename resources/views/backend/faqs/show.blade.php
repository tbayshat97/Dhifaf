{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', 'Faq')

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
                            action="{{ route('admin.faq.update', $faq) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                @foreach ($langs as $key => $lang)
                                <div class="input-field col s12 m6 l6">
                                    <input type="text" name="question_{{ $lang['code'] }}" id="question_{{ $lang['code'] }}"
                                    value="{{$faq->translateOrDefault($lang['code'])->question}}"
                                    class="validate" required />
                                    <label for="question_{{ $lang['code'] }}">Question ({{
                                        $lang['name'] }})*</label>
                                </div>
                                <div class="input-field col s12 m6 l6">
                                    <input type="text" name="answer_{{ $lang['code'] }}" id="answer_{{ $lang['code'] }}"
                                    value="{{$faq->translateOrDefault($lang['code'])->answer}}"
                                    class="validate" required />
                                    <label for="answer_{{ $lang['code'] }}">Answer ({{
                                        $lang['name'] }})*</label>
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
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterLabel">{{
                                        __('admin-content.delete-country')}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    {{ __('admin-content.are-you-sure-you-need-to-delete-this')}} {{
                                    __('admin-content.country')}}?
                                </div>
                                <div class="modal-footer">
                                    <form id="frm_confirm_delete_multiple_image" action="#" method="POST">
                                        @csrf
                                        <input type="hidden" value="" name="id" id="item_id">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{
                                            __('admin-content.close')}}</button>
                                        <button type="submit" class="btn btn-primary" href="">{{
                                            __('admin-content.delete')}}</button>
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
@endsection
