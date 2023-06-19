

@section('bottom_js')
@parent

<script language="javascript">

$("#closeJob").on("click", function(){
      var id=$(this).data('id');
      Swal( {
      title: '@lang("lang.close_job_confirmation")',
      text: '@lang("lang.close_job_conf_text")',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: '@lang("lang.confirm")',
      cancelButtonText: '@lang("lang.cancel")',
      closeOnConfirm: false
    } ).then( ( result ) => {
      if ( result.value ) {
        show_wait('post');
        $.ajax( {
          url: '{{route('close_job_ad')}}',
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


            $( '#divJobAction' ).html(response.render)

               swal( {
                type: 'success',
                title: '@lang("lang.done")',
                text: '@lang("lang.delete_success")',
                showConfirmButton: true,
                timer: 1000
              } );

          },
          error: function ( xhr, ajaxOptions, thrownError ) {

            swal( '@lang("lang.close_job_error")', '@lang("lang.try_again")', "error" );
          }
        } );
      }
    } )
    });



</script>

@endsection
