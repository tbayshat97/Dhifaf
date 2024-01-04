{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', 'Settings')

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
                            action="{{ route('admin.setting.save') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                @if($minimumQty)
                                    <div class="input-field col s12">
                                        <input id={{$minimumQty->option_key}} name={{$minimumQty->option_key}}  required type="number" step="1" min="0"
                                        value="{{$minimumQty->option_value}}">

                                        <label for={{$minimumQty->option_key}}>
                                            {{$minimumQty->option_name}}
                                            <span class="text-red">*</span>
                                        </label>
                                    </div>
                                @endif

                                @if ($freeDeliveryOver)
                                    <div class="input-field col s12">
                                        <input id={{$freeDeliveryOver->option_key}} name={{$freeDeliveryOver->option_key}}  required type="number" step="1" min="0"
                                        value="{{$freeDeliveryOver->option_value}}">

                                        <label for={{$freeDeliveryOver->option_key}}>
                                            {{$freeDeliveryOver->option_name}}
                                            <span class="text-red">*</span>
                                        </label>
                                    </div>
                                @endif

                                @if ($dollarToIraqi)
                                    <div class="input-field col s12">
                                        <input id={{$dollarToIraqi->option_key}} name={{$dollarToIraqi->option_key}}  required type="number" step="1" min="0"
                                        value="{{$dollarToIraqi->option_value}}">

                                        <label for={{$dollarToIraqi->option_key}}>
                                            {{$dollarToIraqi->option_name}}
                                            <span class="text-red">*</span>
                                        </label>
                                    </div>
                                @endif

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
