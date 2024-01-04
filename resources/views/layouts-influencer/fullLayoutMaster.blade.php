{{-- pageConfigs variable pass to Helper's updatePageConfig function to update page configuration --}}
@isset($pageConfigs)
{!! Helper::updatePageConfig($pageConfigs) !!}
@endisset
<!DOCTYPE html>
@php
$configData = Helper::applClasses();
@endphp
<!--
Template Name: Tubishat - Tubishat Admin Template
Author: Tubishat
Website: https://www.tubishat.com/
Contact: hello@tubishat.com
Follow: www.twitter.com/tubishat
Like: www.facebook.com/tubishat

-->
<html class="loading"
    lang="@if(session()->has('locale')){{session()->get('locale')}}@else{{$configData['defaultLanguage']}}@endif"
    data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | Tubishat - Tubishat Admin</title>
    <link rel="apple-touch-icon" href="{{asset('images/favicon/apple-touch-icon-152x152.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/favicon/favicon-32x32.png')}}">

    <!-- Include core + vendor Styles -->
    @include('panels-influencer.styles')

</head>
<!-- END: Head-->

<body
    class="{{$configData['mainLayoutTypeClass']}} @if(!empty($configData['bodyCustomClass'])) {{$configData['bodyCustomClass']}} @endif"
    data-open="click" data-menu="vertical-modern-menu" data-col="1-column">
    <div class="row">
        <div class="col s12">
            <div class="container">
                <!--  main content -->
                @yield('content')
            </div>
            {{-- overlay --}}
            <div class="content-overlay"></div>
        </div>
    </div>
    {{-- vendor scripts and page scripts included --}}
    @include('panels-influencer.scripts')
</body>
</html>
