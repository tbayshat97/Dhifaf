{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', 'Import')

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
                    <div id="html-view-validations">
                        <form class="update-products-form" id="update-products-form" method="POST" action="#"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col s12">
                                    <div class="card">
                                        <div class="card-content">
                                            <h4 class="card-title">Choose import type</h4>
                                            <!-- language options -->
                                            <div class="language-options">
                                                <p>
                                                    <label for="All">
                                                        <input id="All"
                                                            name="type" type="radio" checked value="all"/>
                                                        <span>All</span>
                                                    </label>
                                                </p>
                                                <p>
                                                    <label for="Updated">
                                                        <input id="Updated"
                                                            name="type" type="radio" value="updated"/>
                                                        <span>Updated</span>
                                                    </label>
                                                </p>
                                            </div>
                                            <!--/language options -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12" id="updateDate" style="display: none">
                                    <label for="date">Date</label>
                                    <input type="text" name="updateDate" id="date" class="datepicker" >
                                </div>
                            </div>
                            <div class="row">
                                <!-- Data Loader -->
                                <div class="auto-load center" style="display: none">
                                    <p>Please wait ...</p>
                                    <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="60"
                                        viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                                        <path fill="#000"
                                            d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                                            <animateTransform attributeName="transform" attributeType="XML"
                                                type="rotate" dur="1s" from="0 50 50" to="360 50 50"
                                                repeatCount="indefinite" />
                                        </path>
                                    </svg>
                                </div>
                                <div class="input-field col s12">
                                    <button id="import-btn" class="btn cyan waves-effect waves-light right"
                                        type="submit" name="action">Import
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
<script>
    $('input[name="type"').change(function (e) {
        e.preventDefault();
        var checkedType = $('input[name="type"]:checked').val();

        if(checkedType === 'updated')
        {
            $("#updateDate").show();
            return;
        }

        $("#updateDate").hide();
    });

    $('#update-products-form').submit(function (e) {
        e.preventDefault();

        $("#import-btn").attr("disabled", true);

        let date = $("#date").val();

        $.ajax({
            type: "get",
            url: "{{ route('sap.update-products') }}",
            data: {
                date: date
            },
            beforeSend: function () {
                $('.auto-load').show();
            },
            success: function (response) {
                $('.auto-load').hide();
                $("#import-btn").attr("disabled", false);

                var toastHTML = `<span>Products updated successfully</span><i class="material-icons green-text right">check</i>`;
                M.toast({ html: toastHTML });
            }
        });
    });
</script>
@endsection
