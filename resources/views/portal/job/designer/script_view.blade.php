

@section('bottom_js')
@parent

<script language="javascript">

$("#accept_job").on("click", function(){
      var id=$(this).data('id');
      Swal( {
      title: '@lang("lang.acceptjob_confirmation")',
      text: '@lang("lang.acceptjob_conf_text")',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: '@lang("lang.accept")',
      cancelButtonText: '@lang("lang.cancel")',
      closeOnConfirm: false
    } ).then( ( result ) => {
      if ( result.value ) {
        show_wait('update');
        $.ajax( {
          url: '{{route('ack_job')}}',
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

            if (response.success == true)
            {
                $( '#divJobAction' ).html(response.render);

                swal( {
                type: 'success',
                title: '@lang("lang.done")',
                text: '@lang("lang.acceptjob_success_message")',
                showConfirmButton: true,
                timer: 1000
              } )

            }
            else
            {
                swal( '@lang("error.error")', response.message, "error" );
            }
          },
          error: function ( xhr, ajaxOptions, thrownError ) {

            swal( '@lang("lang.acceptjob_error")', '@lang("lang.try_again")', "error" );
          }
        } );

      }
    } )
    });




    $("#reject_job").on("click", function(){
      var id=$(this).data('id');
      Swal( {
      title: '@lang("lang.rejectjob_confirmation")',
      text: '@lang("lang.rejectjob_conf_text")',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: '@lang("lang.reject")',
      cancelButtonText: '@lang("lang.cancel")',
      closeOnConfirm: false
    } ).then( ( result ) => {
      if ( result.value ) {
        show_wait('update');
        $.ajax( {
          url: '{{route('reject_job')}}',
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

            if (response.success == true)
            {
                $( '#divJobAction' ).html(response.render);

                swal( {
                type: 'success',
                title: '@lang("lang.done")',
                text: '@lang("lang.acceptjob_success_message")',
                showConfirmButton: true,
                timer: 1000
              } )

            }
            else
            {
                swal( '@lang("error.error")', response.message, "error" );
            }
          },
          error: function ( xhr, ajaxOptions, thrownError ) {

            swal( '@lang("lang.acceptjob_error")', '@lang("lang.try_again")', "error" );
          }
        } );

      }
    } )
    });


</script>

@endsection
