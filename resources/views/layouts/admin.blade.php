<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <title>{{ config('app.name', 'Beauty Bliss') }}</title>

    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('admin/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/base/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('admin/images/favicon.png') }}" />

    <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">

    {{-- aug 12 --}}
    <!-- Add Bootstrap CSS if you haven't already -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Add DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">

    @livewireStyles
</head>
<body>
    <div class="container-scroller">
        @include('layouts.include.admin.navbar')

        <div class="container-fluid page-body-wrapper">
            @include('layouts.include.admin.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
            </div>

        </div>
    </div>

     <!-- plugins:js -->
     {{-- aug 12 --}}
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
     {{-- end --}}

   
     {{-- end --}}
    <script src="{{ asset('admin/vendors/base/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="{{ asset('admin/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{ asset('admin/js/off-canvas.js') }}"></script>
    <script src="{{ asset('admin/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('admin/js/template.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('admin/js/dashboard.js') }}"></script>
    <script src="{{ asset('admin/js/data-table.js') }}"></script>
    <script src="{{ asset('admin/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/js/dataTables.bootstrap4.js') }}"></script>
    <!-- End custom js for this page-->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    
    {{-- form validation scripts --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <script src="{{ asset('admin/jsvalidation/category-validation.js') }}"></script>
    <script src="{{ asset('admin/jsvalidation/customer-validation.js') }}"></script>
    <script src="{{ asset('admin/jsvalidation/product-validation.js') }}"></script>
    {{-- form validation scripts` --}}
    @yield('scripts')
    @livewireScripts
    @stack('script')
</body>
</html>