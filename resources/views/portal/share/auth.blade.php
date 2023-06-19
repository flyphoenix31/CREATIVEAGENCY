@include('portal.inc.function')

@php
$page_name         = $attri['page_name']        ?? '';
$has_scrollspy     = $attri['has_scrollspy']    ?? '0';
$scrollspy_offset  = $attri['scrollspy_offset'] ?? '';
$alt_menu          = $attri['alt_menu']         ?? '0';
$category_name     = $attri['category_name']    ?? '';
$has_action_btn    = $attri['has_action_btn']   ?? '';
//echo $category_name;
$template = 'cork';
$theme    = $template. '/' . 'dark'."/";

@endphp

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>3Studio - Your Share Link is Protected</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico"/>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="{{asset($theme . 'bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset($theme . 'assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset($theme . 'assets/css/pages/error/style-maintanence.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('fa/css/all.min.css') }}" rel="stylesheet" type="text/css" />



</head>
<body class="maintanence text-center">


    <!--  BEGIN MAIN CONTAINER  -->
    <div class="container-fluid maintanence-content">
        <div class="">


            <p>{{getfileicon($result, 'fullview', 'skipimage')}}</p>
            <h6 class="limitchar" id="filename_{{$result->id}}"><span class=""></span> {{ $result->name}}.{{$result->mimetype}}</h6>
					<span> {{$result->filesize}}</span>


                    <h1>Your Share Link is Protected</h1>
                    <h3>Please type the password to get shared content</h3>

                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">


                    <form name="formcheck" id="formcheck" class="form-inline justify-content-center mt-5" autocomplete="off">






                        @csrf
                        <input type="hidden" name="token" value="{{$token}}">

                        <div class="col-12 mb-4">

                            <input type="text" class="form-control mr-sm-2" id="password" name="password" placeholder="Type Password" value="" required>
                            <button type="submit" id="subBtn" class="btn btn-primary ml-2 btn-lg">Submit</button>
                        </div>


                    </form></div>
        </div>
    </div>
    <!-- END MAIN CONTAINER -->


<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{asset($theme . 'assets/js/libs/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset($theme . 'bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset($theme . 'bootstrap/js/bootstrap.min.js')}}"></script>


<script src="{{asset($theme . 'plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset($theme . 'assets/js/app.js')}}"></script>
@include('portal.inc.corescript')
<script>


$('#formcheck').on('submit', function(event){
    event.preventDefault();
    $('.inputTxtError').remove();
    $("#subBtn").html("Please Wait..");
    $("#subBtn").attr("disabled", true);
    //show_wait('update');
    var formData = new FormData();
    $.ajax( {
        url: "{{route('check_share_password')}}",
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        data:new FormData(this),
        cache : false,
        processData: false,
        success: function ( result ) {

            $("#subBtn").html("Submit");
            $("#subBtn").attr("disabled", false);

            location.reload();

        },
        error: function ( xhr, ajaxOptions, thrownError ) {
            $("#subBtn").html("Submit");
            $("#subBtn").attr("disabled", false);
          displayFieldErrors(xhr.responseJSON.errors,xhr.status);
        }
      } );

  });
</script>
</body>
</html>
