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
<?php header('Access-Control-Allow-Origin: *'); ?>

<html lang="{{ App::getLocale() }}" @if (App::getLocale() == 'ar') dir="rtl" @endif>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="api-base-url" content="https://dhifaf.tubishat.info/" />
    <meta name="base-lang" content="{{ App::getLocale() }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | Dhifaf Baghdad</title>
    <link rel="apple-touch-icon" href="{{ asset('website/images/favicon.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('website/images/favicon.png') }}">
    @include('website.panels.styles')
    @stack('head')


</head>

<body>
    <div id="app">
        <main class="main">
            @include('website.panels.header')
            @yield('content')
            @include('website.panels.footer')
            {{-- @include('website.panels.bottom-menu') --}}
        </main>
    </div>
    @include('website.panels.scripts')
</body>

</html>
