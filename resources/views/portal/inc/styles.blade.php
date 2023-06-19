<link href="{{asset($theme . 'assets/css/loader.css')}}" rel="stylesheet" type="text/css" />
<script src="{{asset($theme . 'assets/js/loader.js')}}"></script>
<link href="{{ asset('fa/css/all.min.css') }}" rel="stylesheet" type="text/css" />

<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
<link href="{{asset($theme . 'bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

<link href="{{asset($theme . 'assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset($theme . 'assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
<script src="{{asset($theme . 'plugins/sweetalerts/promise-polyfill.js')}}"></script>
<link href="{{asset($theme . 'plugins/sweetalerts/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset($theme . 'plugins/sweetalerts/sweetalert.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset($theme . 'assets/css/components/custom-sweetalert.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset($theme . 'assets/css/elements/tooltip.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset($theme . 'assets/css/elements/avatar.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset($theme . 'plugins/animate/animate.css')}}">



<!-- END GLOBAL MANDATORY STYLES -->




@switch($page_name)

    @case('dashboard')
        <link href="{{asset($theme . 'plugins/apex/apexcharts.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset($theme .'assets/css/widgets/modules-widgets.css')}}" rel="stylesheet" type="text/css" />
    @break

    @case('enquiryList')
        <link href="{{asset($theme . 'assets/css/elements/custom-pagination.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css"/>
    @break

    @case('UserList')
        <link href="{{asset($theme . 'assets/css/elements/custom-pagination.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset($theme . 'assets/css/components/custom-modal.css')}}" rel="stylesheet" type="text/css" />
    @break

    @case('contactList')
        <link href="{{asset($theme . 'assets/css/elements/custom-pagination.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset($theme . 'assets/css/components/custom-modal.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset($theme . 'assets/css/forms/custom-clipboard.css')}}" rel="stylesheet" type="text/css" >
    @break

    @case('InvoiceList')
        <link href="{{asset($theme . 'assets/css/elements/custom-pagination.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" integrity="sha512-KbfxGgOkkFXdpDCVkrlTYYNXbF2TwlCecJjq1gK5B+BYwVk7DGbpYi4d4+Vulz9h+1wgzJMWqnyHQ+RDAlp8Dw==" crossorigin="anonymous" />

    @break

    @case('create_invoice')
        <link href="{{asset($theme . 'assets/css/apps/invoice-edit.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset($theme . 'assets/css/plugins/dropify/dropify.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset($theme . 'assets/css/forms/theme-checkbox-radio.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset($theme . 'plugins/flatpickr/flatpickr.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset($theme . 'plugins/flatpickr/custom-flatpickr.css')}}" rel="stylesheet" type="text/css" />
    @break

    @case('edit_invoice')
        <link href="{{asset($theme . 'assets/css/apps/invoice-edit.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset($theme . 'assets/css/plugins/dropify/dropify.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset($theme . 'assets/css/forms/theme-checkbox-radio.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset($theme . 'plugins/flatpickr/flatpickr.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset($theme . 'plugins/flatpickr/custom-flatpickr.css')}}" rel="stylesheet" type="text/css" />
    @break

    @case('preview_invoice')
        <link href="{{asset($theme . 'assets/css/apps/invoice-preview.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset($theme . 'assets/css/components/custom-modal.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css"/>
    @break

    @case('previewquotation')
        <link href="{{asset($theme . 'assets/css/apps/invoice-preview.css')}}" rel="stylesheet" type="text/css" />
    @break

    @case('quotationList')
        <link href="{{asset($theme . 'assets/css/elements/custom-pagination.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset($theme . 'assets/css/components/custom-modal.css')}}" rel="stylesheet" type="text/css" />
    @break

    @case('setting')
        <link href="{{asset($theme . 'assets/css/plugins/dropify/dropify.min.css')}}" rel="stylesheet" type="text/css" />
    @break

    @case('portfolio_list')
        <link href="{{asset($theme . 'assets/css/elements/custom-pagination.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" />
    @break

    @case('add_portfolio')
        <link href="{{asset($theme . 'assets/css/plugins/file-upload/file-upload-with-preview.min.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" />

    @break

    @case('edit_portfolio')
        <link href="{{asset($theme . 'assets/css/plugins/file-upload/file-upload-with-preview.min.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" />
    @break

    @case('myProfile')
        <link rel="stylesheet" type="text/css" href="{{asset($theme . 'plugins/dropify/dropify.min.css')}}">
        <link href="{{asset($theme . 'assets/css/users/account-setting.css')}}" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" type="text/css" href="{{asset($theme . 'assets/css/forms/custom-clipboard.css')}}">
        <link href="{{asset($theme . 'plugins/flatpickr/flatpickr.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset($theme . 'plugins/flatpickr/custom-flatpickr.css')}}" rel="stylesheet" type="text/css">
    @break

    @case('filelist')

        <link href="{{asset($theme . 'assets/css/forms/theme-checkbox-radio.css')}}" rel="stylesheet" type="text/css" />

        <link href="{{asset($theme . 'assets/css/components/custom-modal.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset($theme . 'assets/css/plugins/dropify/dropify.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset($theme . 'assets/css/plugins/file-upload/file-upload-with-preview.min.css')}}" rel="stylesheet" type="text/css" />

        <link href="{{asset('css/da.css')}}" rel="stylesheet" type="text/css" />


        {{-- <link href="{{asset($theme . 'assets/css/dashboard/dash_1.css')}}" rel="stylesheet" type="text/css" /> --}}
        <link href="{{asset($theme . 'assets/css/widgets/modules-widgets.css')}}" rel="stylesheet" type="text/css" />

        <link href="{{asset($theme . 'assets/css/dashboard/dash_1.css')}}" rel="stylesheet" type="text/css" />

        <link href="{{asset($theme . 'assets/css/elements/custom-pagination.css')}}" rel="stylesheet" type="text/css" />

        <link href="{{asset($theme . 'assets/css/forms/switches.css')}}" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" type="text/css" href="{{asset($theme . 'assets/css/forms/custom-clipboard.css')}}">




    @break

    @case('auditList')
        <link href="{{asset($theme . 'assets/css/elements/custom-pagination.css')}}" rel="stylesheet" type="text/css" />
    @break

    @case('create_job')
        <link href="{{asset($theme . 'plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    @break

    @case('edit_jobs')
        <link href="{{asset($theme . 'plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    @break


    @case('jobCards')
        <link href="{{asset($theme . 'plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset($theme . 'assets/css/forms/theme-checkbox-radio.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('css/job.css')}}" rel="stylesheet" type="text/css" />
    @break

    @case('countryList')
        <link href="{{asset($theme . 'assets/css/elements/custom-pagination.css')}}" rel="stylesheet" type="text/css" />
    @break

    @case('domainList')
        <link href="{{asset($theme . 'plugins/flatpickr/flatpickr.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset($theme . 'plugins/flatpickr/custom-flatpickr.css')}}" rel="stylesheet" type="text/css">
    @break


@endswitch


@section('top_css')

@show


<link href="{{ asset('admin/css/custom.css') }}" rel="stylesheet" type="text/css" />
