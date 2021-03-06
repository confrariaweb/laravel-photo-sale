<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('vendor/laravel-photo-sale/fonts/fontawesome/css/all.min.css') }}?time={{ time() }}" rel="stylesheet">
    <link href="{{ asset('vendor/laravel-photo-sale/css/bootstrap.min.css') }}?time={{ time() }}" rel="stylesheet">
    <link href="{{ asset('vendor/laravel-photo-sale/css/dataTables.bootstrap4.min.css') }}?time={{ time() }}" rel="stylesheet">
    <link href="{{ asset('vendor/laravel-photo-sale/css/template.css') }}?time={{ time() }}" rel="stylesheet">
</head>
<body>
@include('photoSale::partials.header')
<div class="container">
    @include('photoSale::partials.messages')
    {{ $slot }}
    @include('photoSale::partials.footer')
</div>
@include('photoSale::partials.alert')
<script src="{{ asset('vendor/laravel-photo-sale/js/jquery-3.5.1.min.js') }}?time={{ time() }}"></script>
<script src="{{ asset('vendor/laravel-photo-sale/js/bootstrap.min.js') }}?time={{ time() }}"></script>
<script src="{{ asset('vendor/laravel-photo-sale/js/bootstrap.bundle.min.js') }}?time={{ time() }}"></script>
<script src="{{ asset('vendor/laravel-photo-sale/js/popper.min.js') }}?time={{ time() }}"></script>
<script src="{{ asset('vendor/laravel-photo-sale/js/jquery.dataTables.min.js') }}?time={{ time() }}"></script>
<script src="{{ asset('vendor/laravel-photo-sale/js/dataTables.bootstrap4.min.js') }}?time={{ time() }}"></script>
<script src="{{ asset('vendor/laravel-photo-sale/js/jquery.mask.min.js') }}?time={{ time() }}"></script>
<script src="{{ asset('vendor/laravel-photo-sale/js/template.js') }}?time={{ time() }}"></script>
</body>
</html>
