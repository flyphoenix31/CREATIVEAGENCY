

@section('bottom_js')
@parent

<script language="javascript">

$(".datalist").on("click",".sendquote", function(){
    var id=$(this).data('id');
});

$('#openaddmodel').on('hidden.bs.modal', function () {
    $("#formadd").trigger("reset");
});


$('#formadd').on('submit', function(event){
    event.preventDefault();
    $('.inputTxtError').remove();

    show_wait('update');
    var formData = new FormData();
    $.ajax( {
        url: "{{route('store_mail_account')}}",
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        data:new FormData(this),
        cache : false,
        processData: false,
        success: function ( result ) {

          $( '#openaddmodel' ).modal().hide();swal.close();
          $( '#openaddmodel' ).modal( 'hide' );
          swal({  icon: 'success',  title: '@lang("lang.done")!',text: '@lang("lang.record_added_success_msg")', button: '@lang("lang.okay")',});

          $( '#listtable tbody tr:first' ).before( result.record );

        },
        error: function ( xhr, ajaxOptions, thrownError ) {
          swal.close();
          displayFieldErrors(xhr.responseJSON.errors,xhr.status);
        }
      } );

  });


  $('#formedit').on('submit', function(event){
    event.preventDefault();
    $('.inputTxtError').remove();
    show_wait('update');
    var formData = new FormData();
    $.ajax( {
        url: "{{route('update_mail_account')}}",
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        data:new FormData(this),
        cache : false,
        processData: false,
        success: function ( result ) {
          if ( result.success == true ) {
            swal.close();

            $( '#formeditmodal' ).modal().hide();
            $( '#formeditmodal' ).modal( 'hide' );

            var data = result.record;
            swal({ icon: "success",  type: 'success',  title: '@lang("lang.done")!',text: '@lang("lang.update_success_msg")', confirmButtonText: '@lang("lang.okay")'});
            $('#tr_' + result.id).replaceWith(data);
          } else {
            swal( '@lang("lang.no_record_found")', '@lang("lang.try_again")', "error" );
          }
        },
        error: function ( xhr, ajaxOptions, thrownError ) {
          swal.close();
          displayFieldErrors(xhr.responseJSON.errors,xhr.status);
        }
      } );

  });


$(".datalist").on("click",".editrecord", function(){
      var id=$(this).data('id');
      $('.inputTxtError').remove();
      show_wait('fetch');

      $.ajax( {
        url: "{{route('show_mail_account')}}",
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
                $('#formeditmodal').modal('show');
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
          url: '{{route('delete_contact')}}',
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

            if (response.success ==true)
            {
                swal( {
                    type: 'success',
                    title: '@lang("lang.done")',
                    text: '@lang("lang.delete_success")',
                    showConfirmButton: true,
                    timer: 1000
                } );

                $( '#tr_' + response.id ).fadeOut("slow");
            }
            else
            {
                swal( '@lang("lang.delete_error")', response.error, "error" );
            }



          },
          error: function ( xhr, ajaxOptions, thrownError ) {

            swal( '@lang("lang.delete_error")', '@lang("lang.try_again")', "error" );
          }
        } );
      }
    } )
    });







$(".datalist").on("click",".changeaccount", function(){
      var id=$(this).data('id');
      Swal( {
      title: '@lang("lang.mailchange_confirmation")',
      text: '@lang("lang.mailchange_conf_text")',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: '@lang("lang.change")',
      cancelButtonText: '@lang("lang.cancel")',
      closeOnConfirm: false
    } ).then( ( result ) => {
      if ( result.value ) {
        show_wait('delete');
        $.ajax( {
          url: '{{route('changemailaccount')}}',
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

               swal( {
                type: 'success',
                title: '@lang("lang.done")',
                text: '@lang("lang.delete_success")',
                showConfirmButton: true,
                timer: 1000
              } );

              location.reload();

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
