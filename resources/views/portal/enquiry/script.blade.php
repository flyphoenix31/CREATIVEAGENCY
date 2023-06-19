
@section('bottom_js')
@parent

<script language="javascript">

$(document).ready(function() {
  $('.editor').summernote({
  height: 200
});
});

$(".datalist").on("click",".replynow", function(){
    $("#formsend").trigger("reset");
    var id    = $(this).data('id');
    var email = $(this).data('email');
    $('#to_email').val(email);
    $('#enquiry_id').val(id);
    $('#sendquotation').modal('show');
});


$('#sendquotation').on('hidden.bs.modal', function () {
    $("#formsend").trigger("reset");
});



$(".datalist").on("click",".viewrecord", function(){
      var id=$(this).data('id');
      $('.inputTxtError').remove();
      show_wait('fetch');

      $.ajax( {
        url: "{{route('view_enquiry')}}",
        type: 'get',
        dataType: "json",
        data: {
          _method: 'get',
          _token: "{{ csrf_token() }}",
          id:  id,
        },
        success: function ( result ) {
          if ( result.success == true ) {
            swal.close();
            var data = result.record;
            if (data != null)
              {
                $('.renderdata').html(data);
                $('#formviewmodal').modal('show');
              }
            else
              {
                swal( '@lang("lang.no_record_found")', '@lang("lang.try_again")', "error" );
              }
          } else {
            swal( '@lang("lang.no_record_found")', '@lang("lang.try_again")', "error" );
          }
        },
        error: function ( xhr, ajaxOptions, thrownError ) {
          swal( '@lang("lang.error")', '@lang("lang.try_again")', "error" );
        }
      } );
    });



$('#formsend').on('submit', function(event){
    event.preventDefault();
    $('.inputTxtError').remove();
    show_wait('update');
    var formData = new FormData();
    $.ajax( {
        url: "{{route('reply_enquiry')}}",
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        data:new FormData(this),
        cache : false,
        processData: false,
        success: function ( response ) {

          $( '#sendquotation' ).modal().hide();swal.close();
          $( '#sendquotation' ).modal( 'hide' );
          swal({  icon: 'success',  title: '@lang("lang.done")!',text: '@lang("lang.record_mail_sent_success_msg")', button: '@lang("lang.okay")',});

          $('#tr_' + response.id).replaceWith(response.render);

        },
        error: function ( xhr, ajaxOptions, thrownError ) {
          swal.close();
          displayFieldErrors(xhr.responseJSON.errors,xhr.status);
        }
      } );

  });

$(".datalist").on("click",".moverecord", function(){
      var id=$(this).data('id');
      Swal( {
      title: 'Are you Sure?',
      text: 'This will create a new contact',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: '@lang("lang.yes")',
      cancelButtonText: '@lang("lang.cancel")',
      closeOnConfirm: false
    } ).then( ( result ) => {
      if ( result.value ) {
        show_wait('delete');
        $.ajax( {
          url: '{{route('convert_enquiry')}}',
          headers: {
            'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
          },
          type: 'post',
          data: {
            id: id,
            _token: "{{ csrf_token() }}",
          },
          dataType: "json",
          success: function ( response ) {

            swal({ icon: "success",  type: 'success',  title: '@lang("lang.done")!',text: '@lang("lang.update_success_msg")', confirmButtonText: '@lang("lang.okay")'});

            $('#tr_' + response.id).replaceWith(response.render);

          },
          error: function ( xhr, ajaxOptions, thrownError ) {

            swal( 'Cannot move the data', '@lang("lang.try_again")', "error" );
          }
        } );
      }
    } )
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
          url: '{{route('delete_enquiry')}}',
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


    @section('initiate_ajax_load')
  @parent
  getdatalist( '' );

@endsection




</script>



@endsection
