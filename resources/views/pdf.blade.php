@php
$page_name         = $attri['page_name']        ?? '';
$has_scrollspy     = $attri['has_scrollspy']    ?? '0';
$scrollspy_offset  = $attri['scrollspy_offset'] ?? '';
$alt_menu          = $attri['alt_menu']         ?? '0';
$category_name     = $attri['category_name']    ?? '';
$has_action_btn    = $attri['has_action_btn']   ?? '';

$template = 'cork';
$theme    = $template. '/' . 'light'."/";

@endphp


<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link href="{{public_path($theme . 'bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{public_path($theme . 'assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{public_path($theme . 'assets/css/apps/invoice-preview.css')}}" rel="stylesheet" type="text/css" />

    <style>
        body {
           background-color: white;
        }
    </style>
</head>

<body>

        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                @include('portal.'.$page)
            </div>
        </div>


</body>
</html>
