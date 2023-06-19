@section('bottom_js')
@parent




<script language="javascript">
  function openmodel() {
    $("#savebtn").html('@lang("lang.add")');
    $('#roleform')[0].reset();
    $('#mode').val('create');
    $( '#openaddmodel' ).modal( 'show' );
  }

  function updateroles() {


    var datav = $( "#roleform" ).serialize();
    $( '#validation-errors' ).html( '' );
    swal( {
      title: '@lang("lang.please_wait")',
      text: '@lang("lang.updating_data")..',
      allowOutsideClick: false,
      closeOnEsc: false,
      allowEnterKey: false,
      buttons: false,
      onOpen: () => {
        swal.showLoading()
      }
    } )
    $.ajax( {
      url: "{{route('store_role')}}",
      type: 'post',
      headers: {
            'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
          },
      dataType: "json",
      data: datav,
      success: function ( result ) {
        if ( result.success != true ) {

          $.each( result.message, function ( key, value ) {
            $( '#validation-errors' ).append( '<div class="alert alert-danger mb-2">' + value + '</div' );
          } );



          swal.close()
        } else {

          swal({  icon: 'success',  title: '@lang("lang.done")!',text: '@lang("lang.role_update_success_msg")', button: '@lang("lang.okay")',});

          $( '#listtable tr:first' ).after( result.record );

          $( "input[type=text], textarea" ).val( "" );
          $( '#openaddmodel' ).modal( 'hide' );

        }
      },
      error: function ( xhr ) {
        if( xhr.status === 422 ) {
          var errors = $.parseJSON(xhr.responseText);
          $.each( errors.errors, function ( key, value ) {
            $( '#validation-errors' ).append( '<div class="alert alert-danger">' + value + '</div' );
          } );
          swal.close()
        }
        else
          {
            swal( '@lang("lang.error")', '@lang("lang.try_again")', "error" );
          }
      }
    } );
  }


  //edit
  $('#formedit').on('submit', function(event){
    event.preventDefault();
    $('.inputTxtError').remove();
    show_wait('update');
    var formData = new FormData();
    $.ajax( {
        url: "{{route('update_role_permission')}}",
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
            $( '#openeditmodel' ).modal( 'hide' );

            var data = result.record;
            swal({ icon: "success",  type: 'success',  title: '@lang("lang.done")!',text: '@lang("lang.update_success_msg")', confirmButtonText: '@lang("lang.okay")'});          $('#tr_' + result.id).replaceWith(data);
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
      swal( {
        title: '@lang("lang.please_wait")',
        text: '@lang("lang.fetching_data")..',
        allowOutsideClick: false,
        closeOnEsc: false,
        allowEnterKey: false,
        buttons: false,
        onOpen: () => {
          swal.showLoading()
        }
      } )
      $.ajax( {
        url: "{{route('get_role_with_permission')}}",
        type: 'get',
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
          },
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
                $('#render_editview').html(data);

                $('#openeditmodel').modal('show');
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
          url: '{{route('destroy_role' )}}',
          headers: {
            'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
          },
          type: 'delete',
          data: {
            id: id,
            _token: "{{ csrf_token() }}",
          },
          dataType: "html",
          success: function ( response ) {

            var response = jQuery.parseJSON( response );
            if ( response.success == false ) {
              swal( '@lang("lang.delete_error")', response.message, "error" );
            } else {

              swal({  icon: 'success',  title: '@lang("lang.done")!',text: '@lang("lang.delete_success")', button: '@lang("lang.okay")',});


              $( '#tr_' + id ).hide();
            }

          },
          error: function ( xhr, ajaxOptions, thrownError ) {
            swal( '@lang("lang.delete_error")', '@lang("lang.try_again")', "error" );
          }
        } );

      }
    } )
  });




</script>
@endsection
