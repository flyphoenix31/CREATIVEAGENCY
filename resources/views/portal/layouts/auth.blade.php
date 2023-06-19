
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title class="text-capitalize"> @lang('lang.welcome') - @lang('lang.product_name') </title>

    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}"/>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <link href="{{asset('cork/light/assets/css/loader.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('cork/light/assets/js/loader.js')}}"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{asset('cork/light/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Styles -->
    <link href="{{asset('cork/light/assets/css/main.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('cork/light/assets/css/authentication/form-2.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('cork/light/assets/css/forms/switches.css')}}">



     <link rel="stylesheet" type="text/css" href="{{asset('cork/light/assets/css/forms/theme-checkbox-radio.css')}}">




</head>
<body  class="">

    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">
        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN CONTENT PART  -->
        <div id="content" class="main-content">

            @yield('content')

        </div>
        <!--  END CONTENT PART  -->

    </div>
    <!-- END MAIN CONTAINER -->



</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="{{asset('cork/light/assets/js/authentication/form-2.js')}}"></script>
</html>
