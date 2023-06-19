@include('portal.inc.function')
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <link href="{{ asset('fa/css/all.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ setTitle($page_name) }}</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico"/>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="{{asset($theme . 'bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset($theme . 'assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset($theme . 'assets/css/pages/error/style-maintanence.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset($theme . 'assets/css/elements/color_library.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset($theme . 'plugins/lightbox/photoswipe.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset($theme . 'plugins/lightbox/default-skin/default-skin.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset($theme . 'plugins/lightbox/custom-photswipe.css')}}" rel="stylesheet" type="text/css" />

<style>
    .cl-example
    {
        height: 100% !important ;
    }
    </style>

</head>
<body class="maintanence text-center">

    <div class="row ml-5">
        @if($folderId)
            <a href="{{url()->previous()}}">
                <h4 class="nk-block-title text-info-light text-capitalize"><i class="fal fa-angle-left"></i> Back</h4>
            </a>
        @endif
    </div>

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="container-fluid maintanence-content9" style="width: 100%">
        <div class="mt-5 pt-5">

            @if($shared->type == 'file')
                <p>{{getsharefileicon($result, 'fullview', '', 'issingle', $token)}}</p>
                <h6 class="limitchar" id="filename_{{$result->id}}"><span class=""></span> {{ $result->name}}.{{$result->mimetype}}</h6>
                        <span> {{$result->filesize}}</span>

                <p class="text"></p>
                <a href="{{route('download_files', ['uuid' =>$token, 'folder' => $folderId ] )}}" class="btn btn-info mt-2">Download</a>
            @else

            <div class="row">
                @foreach($result['folders'] as $folder)

                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6  layout-spacing">
                    <a href="{{route('shared_filesorfolder', ['uuid'=>$token,'folder'=>$folder->unique_id])}}" class="task-hinfo">
                    <div class="color-box">
                        <span class="cl-example"><i class="fad fa-folder text-danger fa-5x"></i></span>
                        <div class="cl-info">
                            <h5 class="cl-title text-left">{{$folder->name}}</h5>
                            <p class="text-left">@if($folder->items > 0) {{$folder->items}} Items @else Empty @endif</p>
                        </div>
                    </div>
                </a>
                </div>
                @endforeach
            </div>

            <div class="row">
                @foreach($result['files'] as $file)

                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 layout-spacing">
                        <div class="color-box">
                            <span class="cl-example">{{ getsharefileicon($file, 'fullview') }}</span>
                            <div class="cl-info">
                                <h5 class="cl-title text-left">yy-{{$file->name}}</h5>
                                <p class="text-left">{{$file->filesize}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row ml-5">
                <a href="{{route('download_files', ['uuid' =>$token, 'folder' => $folderId ] )}}" class="btn btn-info mt-2">Download All</a>
            </div>
            @endif

        </div>



        @include('portal.share.comment')


    </div>
    <!-- END MAIN CONTAINER -->

    @include('portal.inc.scripts')

</body>
</html>
