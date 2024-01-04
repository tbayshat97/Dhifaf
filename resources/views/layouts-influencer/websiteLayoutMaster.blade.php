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
        <html lang="{{App::getLocale()}}" @if(App::getLocale()=='ar' ) dir="rtl" @endif>
        <!-- BEGIN: Head-->
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <title>@yield('title') |Dhifaf Baghdad</title>
            <link rel="apple-touch-icon" href="{{ asset('frontend/images/favicon.png') }}">
            <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/images/favicon.png') }}">
            <!-- Include core + vendor Styles -->
            @include('website.panels-influencer.styles')
        </head>
        <!-- END: Head-->
        <body>
            <div id="app">
                @include('website.panels-influencer.header')
                <!--  main content -->
                @yield('content')
                @include('website.panels-influencer.footer')
                @include('website.panels-influencer.bottom-menu')
            </div>
                {{-- vendor scripts and page scripts included --}}
                @include('website.panels-influencer.scripts')
        </body>
</html>
