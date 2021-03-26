<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('/img/brand/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>XLASHIE 微圈</title>

    <link rel="icon" href="{{ asset('/img/brand/ico.png') }}" type="image/png">
    <link rel="apple-touch-icon" sizes="57x57" href="/assets/img/brand/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/assets/img/brand/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/assets/img/brand/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/brand/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/assets/img/brand/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/assets/img/brand/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/assets/img/brand/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/assets/img/brand/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/brand/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/assets/img/brand/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/brand/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/assets/img/brand/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/brand/favicon-16x16.png">
    <link rel="manifest" href="/assets/img/brand/manifest.json">

    <link rel="preload" as="style" href="{{ asset('assets/vendor/nucleo/css/nucleo.css') }}" type="text/css" onload="this.rel='stylesheet'">
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" onload="this.rel='stylesheet'">
    <link rel="preload" as="style" href="{{ asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" type="text/css"onload="this.rel='stylesheet'">


    <link rel="stylesheet" href="{{ mix('css/main.css') }}" type="text/css">

    @include('common.ga')

    <script type="text/javascript"><!--
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>;
    //--></script>
</head>
