<!DOCTYPE html>
<html lang="en">
<head>
    @include('chat.layouts.title-meta')
    @include('chat.layouts.head')
</head>
<body>
     <!-- Begin page -->
     <div class="layout-wrapper d-lg-flex">
         <!-- Start left sidebar-menu -->
        @include('chat.layouts.sidebar')
        <!-- end left sidebar-menu -->

        @yield('content')
    </div>
    <!-- END layout-wrapper -->
<!-- JAVASCRIPT -->
@include('chat.layouts.vendor-scripts')
</body>
</html>
