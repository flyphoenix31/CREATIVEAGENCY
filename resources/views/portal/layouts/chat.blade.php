@include('portal.inc.function')
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ setTitle($page_name) }}</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico"/>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    @include('portal.inc.styles')




    <!-- App css -->
    {{-- <link href="{{ URL::asset('/cchat/assets/css/bootstrap-dark.min.css')}}" id="bootstrap-dark-style" rel="stylesheet" type="text/css" disabled="disabled" />
    <link href="{{ URL::asset('/cchat/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/cchat/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/cchat/assets/css/app-dark.min.css')}}" id="app-dark-style" rel="stylesheet" type="text/css" disabled="disabled" />
    <link href="{{ URL::asset('/cchat/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css"  />
    <link href="{{ URL::asset('/cchat/vendor/emoji-picker/lib/css/emoji.css')}}" rel="stylesheet"> --}}






    {{-- <link href="{{ URL::asset('/cchat/assets/css/app.css')}}" rel="stylesheet" type="text/css" /> --}}

    <link href="{{ URL::asset('/cchat/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/cchat/assets/css/app.css')}}" id="app-style" rel="stylesheet" type="text/css"  />
    <link href="{{ URL::asset('/cchat/vendor/emoji-picker/lib/css/emoji.css')}}" rel="stylesheet">






    <!-- magnific-popup css -->
    <link href="{{ URL::asset('/cchat/assets/libs/magnific-popup/magnific-popup.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- owl.carousel css -->
    <link href="{{ URL::asset('/cchat/assets/libs/owl.carousel/owl.carousel.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    .affix
    {
        top:150px;
        position:fixed;
    }
</style>

</head>
<body {{ ($has_scrollspy) ? scrollspy($scrollspy_offset) : '' }} class=" {{ ($page_name === 'alt_menu') ? 'alt-menu' : '' }} {{ ($page_name === 'error404') ? 'error404 text-center' : '' }} {{ ($page_name === 'error500') ? 'error500 text-center' : '' }} {{ ($page_name === 'error503') ? 'error503 text-center' : '' }} {{ ($page_name === 'maintenence') ? 'maintanence text-center' : '' }}">

    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    @include('portal.inc.navbar')

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">


        <div class="overlay"></div>
        <div class="search-overlay"></div>

        @include('portal.inc.sidebar')

        <!--  BEGIN CONTENT PART  -->
        <div id="content9" class="main-content">

                        <!---New Chat -->
                        <div class="layout-wrapper d-lg-flex sticky-top">
                            <!-- Start left sidebar-menu -->
                           @include('portal.chat.layouts.sidebar')
                           <!-- end left sidebar-menu -->

                           @yield('content')
                       </div>
                        <!-- END -->







        </div>
        <!--  END CONTENT PART  -->

    </div>
    <!-- END MAIN CONTAINER -->



</body>




<!-- JAVASCRIPT -->
<script src="{{ URL::asset('/cchat/assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{ URL::asset('/cchat/assets/libs/node-waves/node-waves.min.js')}}"></script>
<script src="{{ URL::asset('/cchat/js/app.js')}}"></script>
<script src="{{ URL::asset('/cchat/vendor/emoji-picker/lib/js/config.js')}}"></script>
<script src="{{ URL::asset('/cchat/vendor/emoji-picker/lib/js/util.js')}}"></script>
<script src="{{ URL::asset('/cchat/vendor/emoji-picker/lib/js/jquery.emojiarea.js')}}"></script>
<script src="{{ URL::asset('/cchat/vendor/emoji-picker/lib/js/emoji-picker.js')}}"></script>



<!-- Magnific Popup-->
<script src="{{ URL::asset('/cchat/assets/libs/magnific-popup/magnific-popup.min.js')}}"></script>
<!-- owl.carousel js -->
<script src="{{ URL::asset('/cchat/assets/libs/owl.carousel/owl.carousel.min.js')}}"></script>



<!-- page init -->
<script src="{{ URL::asset('/cchat/assets/js/pages/index.init.js')}}"></script>

<script>
    // global app configuration object
    var my_id = "{{ Auth::id() }}";
    var config = {
        routes: {
            nameupdate: "e('nameupdate')}}",
            updateavatar: "",
            groups: "{{ route('groups')}}",
            url: "{{ URL::asset('') }}"
        }
    };

</script>
@include('portal.inc.corescript')

</html>
