<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{asset($theme . 'assets/js/libs/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset($theme . 'bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset($theme . 'bootstrap/js/bootstrap.min.js')}}"></script>


<script src="{{asset($theme . 'plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
<script>
    $(document).ready(function() {
        App.init();
    });
</script>
<script src="{{asset('cork/js/custom.js')}}"></script>
<script src="{{asset($theme . 'plugins/highlight/highlight.pack.js')}}"></script>

{{-- <script src="{{asset($theme . 'assets/js/scrollspyNav.js')}}"></script> --}}


<!-- END GLOBAL MANDATORY SCRIPTS -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
@switch($page_name)

    @case('dashboard')
        <script src="{{asset($theme . 'plugins/apex/apexcharts.min.js')}}"></script>
        <script src="{{asset($theme . 'assets/js/widgets/modules-widgets.js')}}"></script>
    @break

    @case('myprofile')
        <script src="{{asset($theme . 'plugins/dropify/dropify.min.js')}}"></script>
        <script src="{{asset($theme . 'plugins/blockui/jquery.blockUI.min.js')}}"></script>
        <script src="{{asset($theme . 'assets/js/clipboard/clipboard.min.js')}}"></script>
        <script src="{{asset($theme . 'assets/js/forms/custom-clipboard.js')}}"></script>
        <script src="{{asset($theme . 'plugins/flatpickr/flatpickr.js')}}"></script>
        <script src="{{asset($theme . 'plugins/flatpickr/custom-flatpickr.js')}}"></script>
    @break

    @case('users')
        <script src="{{asset($theme . 'plugins/flatpickr/flatpickr.js')}}"></script>
    @break

    @case('create_invoice')
        <script src="{{asset($theme . 'plugins/dropify/dropify.min.js')}}"></script>
        <script src="{{asset($theme . 'plugins/flatpickr/flatpickr.js')}}"></script>
        <script src="{{asset('js/invoice-add.js')}}"></script>
    @break

    @case('edit_invoice')
        <script src="{{asset($theme . 'plugins/dropify/dropify.min.js')}}"></script>
        <script src="{{asset($theme . 'plugins/flatpickr/flatpickr.js')}}"></script>
        <script src="{{asset('js/invoice-edit.js')}}"></script>
    @break

    @case('preview_invoice')
        <script src="{{asset($theme . 'assets/js/apps/invoice-preview.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>
    @break

    @case('previewquotation')
        <script src="{{asset($theme . 'assets/js/apps/invoice-preview.js')}}"></script>
    @break

    @case('contactList')
        <script src="{{asset($theme . 'assets/js/clipboard/clipboard.min.js')}}"></script>
    @break

    @case('InvoiceList')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>
    @break

    @case('enquiryList')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>
    @break

    @case('setting')
        <script src="{{asset($theme . 'plugins/dropify/dropify.min.js')}}"></script>
        <script>
            $('.dropify').dropify({
                messages: { 'default': 'Click to Upload Picture/Logo', 'replace': 'Upload or Drag n Drop' }
            });
        </script>
    @break

    @case('portfolio_list')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>
    @break

    @case('add_portfolio')
        <script src="{{asset($theme . 'plugins/file-upload/file-upload-with-preview.min.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>
    @break

    @case('edit_portfolio')
        <script src="{{asset($theme . 'plugins/file-upload/file-upload-with-preview.min.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>
    @break

    @case('myProfile')
        <script src="{{asset($theme . 'plugins/dropify/dropify.min.js')}}"></script>
        <script src="{{asset($theme . 'plugins/blockui/jquery.blockUI.min.js')}}"></script>
        <script src="{{asset($theme . 'assets/js/clipboard/clipboard.min.js')}}"></script>
        <script src="{{asset($theme . 'assets/js/forms/custom-clipboard.js')}}"></script>
        <script src="{{asset($theme . 'plugins/flatpickr/flatpickr.js')}}"></script>
        <script src="{{asset($theme . 'plugins/flatpickr/custom-flatpickr.js')}}"></script>
    @break


    @case('filelist')
        <script src="{{asset($theme . 'plugins/file-upload/file-upload-with-preview.min.js')}}"></script>

        <script src="{{asset($theme . 'assets/js/dashboard/dash_1.js')}}"></script>
        <script src="{{asset($theme . 'assets/js/clipboard/clipboard.min.js')}}"></script>
        <script src="{{asset($theme . 'assets/js/forms/custom-clipboard.js')}}"></script>
        <script src="{{asset($theme . 'assets/js/clipboard/clipboard.min.js')}}"></script>
        <script src="{{asset($theme . 'assets/js/forms/custom-clipboard.js')}}"></script>

    @break



    @case('sharepage')
        <script src="{{asset($theme . 'plugins/lightbox/photoswipe.min.js')}}"></script>
        <script src="{{asset($theme . 'plugins/lightbox/photoswipe-ui-default.min.js')}}"></script>
        <script src="{{asset($theme . 'plugins/lightbox/custom-photswipe.js')}}"></script>

    @break

    @case('create_job')
        <script src="{{asset($theme . 'plugins/select2/select2.min.js')}}"></script>
    @break

    @case('edit_jobs')
        <script src="{{asset($theme . 'plugins/select2/select2.min.js')}}"></script>
    @break

    @case('jobCards')
        <script src="{{asset($theme . 'plugins/select2/select2.min.js')}}"></script>
        <script>
            var ss = $(".basic").select2({
                tags: true,
            });
        </script>
    @break

    @case('domainList')
        <script src="{{asset($theme . 'plugins/flatpickr/flatpickr.js')}}"></script>
        <script src="{{asset($theme . 'plugins/flatpickr/custom-flatpickr.js')}}"></script>
    @break




    @default
@endswitch
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->


@include('portal.inc.corescript')
