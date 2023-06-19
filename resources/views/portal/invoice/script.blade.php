
@section('bottom_js')
@parent
<script language="javascript">

$(document).ready(function() {
  $('.editor').summernote();
});

/* var options = {
  debug: 'info',
  modules: {

  },
  placeholder: 'Compose an epic...',
  readOnly: true,
  theme: 'snow'
};
var editor = new Quill('.editor', options); */
/*
var quill = new Quill('.editor', {
    theme: 'snow'
  }); */

$('#sendquotation').on('hidden.bs.modal', function () {
    $("#formsend").trigger("reset");
});


$(".datalist").on("click",".replynow", function(){
    var id=$(this).data('id');
});

$(".datalist").on("click",".sendmail", function(){
    $("#formsend").trigger("reset");
    var id    = $(this).data('id');
    var email = $(this).data('email');
    $('#to_email').val(email);
    $('#invoice_id').val(id);

    $('#sendquotation').modal('show');
});


$('#formsend').on('submit', function(event){
    event.preventDefault();
    $('.inputTxtError').remove();
    show_wait('update');
    var formData = new FormData();
    $.ajax( {
        url: "{{route('send_quotation')}}",
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        data:new FormData(this),
        cache : false,
        processData: false,
        success: function ( result ) {

          $( '#sendquotation' ).modal().hide();swal.close();
          $( '#sendquotation' ).modal( 'hide' );
          swal({  icon: 'success',  title: '@lang("lang.done")!',text: '@lang("lang.record_mail_sent_success_msg")', button: '@lang("lang.okay")',});

        },
        error: function ( xhr, ajaxOptions, thrownError ) {
          swal.close();
          displayFieldErrors(xhr.responseJSON.errors,xhr.status);
        }
      } );

  });

$(".datalist").on("click",".sendmailold", function(){
    var id    = $(this).data('id');
    var email = $(this).data('email');
    Swal.fire({
  title: 'Email Invoice to',

  inputAttributes: {
    autocapitalize: 'off'
  },
  showCancelButton: true,
  confirmButtonText: 'Look up',
  showLoaderOnConfirm: true,
  input: 'email',
    buttonsStyling: false,
    confirmButtonClass: 'btn btn-primary btn-lg mr-2',
    cancelButtonClass: 'btn btn-dark btn-lg',
    inputValue: email,
    confirmButtonText: 'Send Email',
    showCancelButton: true,
    showLoaderOnConfirm: true,
    inputPlaceholder: "Add Email Address",
  preConfirm: (email) => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    return fetch('{{route('email_invoice')}}/' + id + '?email=' + email , {
        method  : 'post',
        data       : 'email=' + email + ',id=' + id,
        headers : new Headers({
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        })
    }).then( response => {

        return response.json(); // server returned valid JSON
    }).then( parsed_result => {

        if(parsed_result.success==true){
             Swal.fire(
                'Success!',
                'Mail Sent successfully.',
                'success'
            );return false;
        }
        else
        {
            Swal.fire(
                'Failed!',
                'Cannot send mail. Please contact admin',
                'error'
            );return false;

        }
    })

  },
  allowOutsideClick: () => !Swal.isLoading()
}).then((result) => {

})

});




$(".datalist").on("click",".deleterecord", function(){
      var id=$(this).data('id');
      Swal( {
      title: '@lang("lang.delete_confirmation")',
      text: '@lang("lang.delete_conf_text")',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: '@lang("lang.delete")',
      cancelButtonText: '@lang("lang.cancel")',
      closeOnConfirm: false
    } ).then( ( result ) => {
      if ( result.value ) {
        show_wait('delete');
        $.ajax( {
          url: '{{route('delete_invoice')}}',
          headers: {
            'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
          },
          type: 'delete',
          data: {
            id: id,
            _token: "{{ csrf_token() }}",
          },
          dataType: "json",
          success: function ( response ) {

              swal( {
                type: 'success',
                title: '@lang("lang.done")',
                text: '@lang("lang.delete_success")',
                showConfirmButton: true,
                timer: 1000
              } );

              $( '#tr_' + response.id ).fadeOut("slow");

          },
          error: function ( xhr, ajaxOptions, thrownError ) {

            swal( '@lang("lang.delete_error")', '@lang("lang.try_again")', "error" );
          }
        } );
      }
    } )
    });




</script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>




@endsection
