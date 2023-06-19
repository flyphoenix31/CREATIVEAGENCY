

@section('bottom_js')
@parent

<script language="javascript">

$('#openaddmodel').on('hidden.bs.modal', function () {
    $("#formadd").trigger("reset");
});


$('#formadd').on('submit', function(event){
    event.preventDefault();
    $('.inputTxtError').remove();

    show_wait('update');
    var formData = new FormData();
    $.ajax( {
        url: "{{route('store_quotation')}}",
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


$(".datalist").on("click",".changestatus", function(){
      var id=$(this).data('id');
      $('.inputTxtError').remove();
      show_wait('fetch');
      $.ajax( {
        url: "{{route('get_quotation_status')}}",
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
                $('.renderuserstatusdata').html(data);

                $('#hidden_void').val(id);

                $('#openstatusmodel').modal('show');
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

            ajaxErrors(xhr.responseJSON.errors,xhr.status);
            //swal( '@lang("lang.error")', '@lang("lang.try_again")', "error" );
        }
      } );
    });


$('#formchangestatus').on('submit', function(event){
    event.preventDefault();
    $('.inputTxtError').remove();
    //var $form = $(this);
    //if(! $form.valid()) return false;
    show_wait('update');

    var formData = new FormData();
    $.ajax( {
        url: "{{route('update_quotation_status')}}",
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
            $( '#openstatusmodel' ).modal( 'hide' );

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


@section('initiate_ajax_load')
  @parent
  getdatalist( '' );

@endsection



</script>

@endsection
