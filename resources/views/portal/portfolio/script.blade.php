
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
        url: "{{route('view_portfolio')}}",
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
          url: '{{route('delete_portfolio')}}',
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
