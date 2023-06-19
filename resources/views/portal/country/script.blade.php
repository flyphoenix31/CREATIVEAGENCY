

@section('bottom_js')
@parent

<script language="javascript">

$(".datalist").on("click",".activeRow", function(){
      var id=$(this).data('id');
      Swal( {
      title: 'Are You Sure?',
      text: 'This will Activate the Currency',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: '@lang("lang.change")',
      cancelButtonText: '@lang("lang.cancel")',
      closeOnConfirm: false
    } ).then( ( result ) => {
      if ( result.value ) {
        show_wait('update');
        $.ajax( {
          url: '{{route('activate_country')}}',
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
                text: 'Successfully Updated',
                showConfirmButton: true,
                timer: 1000
              } );

              $('#tr_' + response.id).replaceWith(response.data);

          },
          error: function ( xhr, ajaxOptions, thrownError ) {

            swal( '@lang("lang.delete_error")', '@lang("lang.try_again")', "error" );
          }
        } );
      }
    } )
    });



    $(".datalist").on("click",".disableRow", function(){
      var id=$(this).data('id');
      Swal( {
      title: 'Are You Sure?',
      text: 'This will Deactivate the Currency',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: '@lang("lang.change")',
      cancelButtonText: '@lang("lang.cancel")',
      closeOnConfirm: false
    } ).then( ( result ) => {
      if ( result.value ) {
        show_wait('update');
        $.ajax( {
          url: '{{route('disable_country')}}',
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
                text: 'Successfully Updated',
                showConfirmButton: true,
                timer: 1000
              } );

              $('#tr_' + response.id).replaceWith(response.data);

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
