@section('bottom_js')
@parent

<script language="javascript">

var banner = "{{ $record->banner }}";
var image  = "{{ $record->image  }}";


new FileUploadWithPreview('portfolio_image',{
    showDeleteButtonOnImages: true,
    text: {
      chooseFile: 'Choose file...',
      browse: 'Browse',
      selectedCount: 'files selected'
    },
    presetFiles: [
        image,
    ],
});

new FileUploadWithPreview('portfolio_banner',{
    showDeleteButtonOnImages: true,
    text: {
      chooseFile: 'Choose file...',
      browse: 'Browse',
      selectedCount: 'files selected'
    },
    presetFiles: [
        banner,
    ],
});

$(document).ready(function() {
  $('.editor').summernote({
  height: 200
});
});


jQuery(document).ready(function($) {

$('#formedit').on('submit', function(event){

    event.preventDefault();
    $('#formedit')[0].checkValidity();

    var forms = document.getElementById('formedit');


    if (forms.checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
        //forms.classList.add('was-validated');
        //return false;
    }
    $('.inputTxtError').remove();
    show_wait('update');
    var formData = new FormData();
    $.ajax( {
        url: "{{route('update_portfolio')}}",
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        data:new FormData(this),
        cache : false,
        processData: false,
        success: function ( response ) {

            swal.close();
            if (response.success ==true)
            {
                swal( '@lang("lang.done")', '@lang("lang.record_added_success_msg")', "success" );

                window.location.replace(response.url);
            }
            else
            {
                swal( '@lang("lang.error")', '@lang("lang.invoice_not_updated")', "error" );
            }

        },
        error: function ( xhr, ajaxOptions, thrownError ) {
          swal.close();
          displayFieldErrors(xhr.responseJSON.errors,xhr.status);
        }
      } );
  });

});


</script>
@endsection
