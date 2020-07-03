<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">
<!--begin::Head-->

<head>
    <base href="{{ env('APP_URL') }}">
    <meta charset="utf-8" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="Pricing table example" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{ URL::to('assets/plugins/global/plugins.bundle.css?v=7.0.5') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.5') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('assets/css/style.bundle.css?v=7.0.5') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="{{ URL::to('assets/media/logos/favicon.ico') }}" />
</head>
<!--end::Head-->

@include('layouts.body')

</html>
