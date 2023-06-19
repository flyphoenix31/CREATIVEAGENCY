

@section('bottom_js')
@parent

<script language="javascript">


$(".dropdown #cclc").on('click', '#callRestoreFunc', function(e) {
    var id = $(this).data('id');
    var uuid = $(this).data('uuid');
      Swal( {
      title: '@lang("lang.restore_confirmation")',
      text: '@lang("lang.restore_conf_text")',
      type: 'info',
      showCancelButton: true,
      confirmButtonText: '@lang("lang.restore")',
      cancelButtonText: '@lang("lang.cancel")',
      confirmButtonColor: "#e7515a",
      closeOnConfirm: false
    } ).then( ( result ) => {
      if ( result.value ) {
        show_wait('update');
        $.ajax( {
          url: '{{route('restore_file')}}',
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

            if (response.success == true)
            {
                swal( {
                type: 'success',
                title: '@lang("lang.done")',
                text: '@lang("lang.restore_success")',
                showConfirmButton: true,
                timer: 1000
              } )
              $( '#file_uuid_' + uuid ).hide();
            }
            else
            {
                swal( '@lang("lang.restore_error")', response.message, "error" );
            }
          },
          error: function ( xhr, ajaxOptions, thrownError ) {
            if( xhr.status === 422 ) {

              var errors = $.parseJSON(xhr.responseText);
              console.log(errors.errors);
              $.each( errors.errors, function ( key, value ) {
                $( '#validation-errors' ).append( '<div class="alert alert-danger">' + value + '</div' );
              } );
              swal.close()
            }

            swal( '@lang("lang.restore_error")', '@lang("lang.try_again")', "error" );
          }
        } );

      }
    } )


});


$(".dropdown #cclc").on('click', '#callPerDelFunc', function(e) {
    var id = $(this).data('id');
    var uuid = $(this).data('uuid');alert(uuid);
      Swal( {
      title: '@lang("lang.delete_permanent_confirmation")',
      text: '@lang("lang.delete_permanent_conf_text")',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: '@lang("lang.delete")',
      cancelButtonText: '@lang("lang.cancel")',
      confirmButtonColor: "#e7515a",
      closeOnConfirm: false
    } ).then( ( result ) => {
      if ( result.value ) {
        show_wait('delete');
        $.ajax( {
          url: '{{route('delete_file_permanently')}}',
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

            if (response.success == true)
            {
                swal( {
                type: 'success',
                title: '@lang("lang.done")',
                text: '@lang("lang.delete_success")',
                showConfirmButton: true,
                timer: 1000
              } )
              $( '#file_uuid_' + uuid ).hide();
            }
            else
            {
                swal( '@lang("lang.delete_error")', response.message, "error" );
            }
          },
          error: function ( xhr, ajaxOptions, thrownError ) {
            if( xhr.status === 422 ) {

              var errors = $.parseJSON(xhr.responseText);
              console.log(errors.errors);
              $.each( errors.errors, function ( key, value ) {
                $( '#validation-errors' ).append( '<div class="alert alert-danger">' + value + '</div' );
              } );
              swal.close()
            }

            swal( '@lang("lang.delete_error")', '@lang("lang.try_again")', "error" );
          }
        } );

      }
    } )


});

</script>

@endsection
