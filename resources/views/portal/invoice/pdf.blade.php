
<!doctype html>

<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="{{ base_path().'/public/cork/light/bootstrap/css/bootstrap.min.css' }}">
    <link rel="stylesheet" href="{{ base_path().'/public/cork/light/assets/css/plugins.css' }}">
    <link rel="stylesheet" href="{{ base_path().'/public/cork/light/assets/css/apps/invoice-preview.css' }}">
</head>
<body>
<div class="row invoice  layout-spacing layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

        <div class="doc-container">

            <div class="row">

                @include('portal.invoice.partial.invoicepreview')


            </div>


        </div>

    </div>
</div>
</body>
</html>
