

@section('bottom_js')
@parent

<script language="javascript">

$(".datalist").on("click",".viewrecord", function(){
      var id=$(this).data('id');
      $('.inputTxtError').remove();
      show_wait('fetch');

      $.ajax( {
        url: "{{route('audit_show_record')}}",
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



@section('initiate_ajax_load')
  @parent
  getdatalist( '' );

@endsection




</script>

@endsection
