@section('bottom_js')
@parent

<script language="javascript">


new FileUploadWithPreview('portfolio_image');

new FileUploadWithPreview('portfolio_banner');

$(document).ready(function() {
  $('.editor').summernote({
  height: 200
});
});


jQuery(document).ready(function($) {

$('#formadd').on('submit', function(event){

    event.preventDefault();
    $('#formadd')[0].checkValidity();

    var forms = document.getElementById('formadd');


    if (forms.checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
        //forms.classList.add('was-validated');
        //return false;
    }

    //





    $('.inputTxtError').remove();
    show_wait('update');
    var formData = new FormData();
    $.ajax( {
        url: "{{route('store_portfolio')}}",
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
