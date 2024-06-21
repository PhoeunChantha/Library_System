<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', ' Library | System')</title>

    {{-- toastr --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('AdminLTE') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/summernote/summernote-bs4.min.css">
    {{-- Fon't awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/dist/css/adminlte.min.css">
    {{-- toastr --}}
    {{-- <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <link rel="stylesheet"
        href="{{ asset('AdminLTE') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    @stack('css')
</head>
<style>
    .required:after {
        content: '*';
        color: red;
        font-size: 1rem;
        margin-left: 0.2rem;
    }

    .scroll-table {
        overflow-y: auto;
        overflow-y: scroll;
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .scroll-table ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .scroll-table ::-webkit-scrollbar {
        display: none;
    }
</style>
<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    /* .text-sm .btn {
        font-size: 12px !important;
    } */

    /* .dropdown-item {
        cursor: pointer;
    } */

    /* Hide scrollbar for Chrome, Safari, and Opera */
    ::-webkit-scrollbar {
        display: none;
    }

    /* Hide scrollbar for Firefox */
    * {
        scrollbar-width: none;
        /* Firefox */
    }

    /* Hide scrollbar for Internet Explorer, Edge */
    * {
        -ms-overflow-style: none;
        /* IE and Edge */
    }

    /* .layout-navbar-fixed.sidebar-mini.sidebar-collapse.text-sm .wrapper .brand-link {
        height: calc(6.7rem + 1px) !important;
    } */
</style>
