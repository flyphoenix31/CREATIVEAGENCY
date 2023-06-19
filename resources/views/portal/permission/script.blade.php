@section('bottom_js')
@parent

<script language="javascript">
  
function openmodel() 
{
    $("#savebtn").html('@lang("lang.add")');
    $('#formadd')[0].reset();
    $( '#openaddmodel' ).modal( 'show' );
}

$('#formadd').on('submit', function(event){
    event.preventDefault();
    $('.inputTxtError').remove();
    
    show_wait('update');        
    var formData = new FormData();    
    $.ajax( {
        url: "{{route('add_permission')}}",
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST', 
        data:new FormData(this),
        cache : false, 
        processData: false,
        success: function ( result ) {          
          swal.close();
          $( '#openaddmodel' ).modal( 'hide' );           
          swal({  icon: 'success',  title: '@lang("lang.done")!',text: '@lang("lang.record_added_success_msg")', button: '@lang("lang.okay")',});
          $( '#listtable tr:first' ).after( result.record );            

                
        },
        error: function ( xhr, ajaxOptions, thrownError ) {
          swal.close();
          displayFieldErrors(xhr.responseJSON.errors,xhr.status); 
        }
      } );
    
  });
  
//edit 
  $('#formedit').on('submit', function(event){
    event.preventDefault();
    $('.inputTxtError').remove();
    show_wait('update');        
    var formData = new FormData();    
    $.ajax( {
        url: "{{route('update_permission')}}",
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
//get receipt details 
  $(".datalist").on("click",".editrecord", function(){
      var id=$(this).data('id');
      $('.inputTxtError').remove();
      show_wait('fetch');
      
      $.ajax( {
        url: "{{route('get_permission')}}",
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
                $('#renderdata').html(data);
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
          url: '{{route('delete_permission')}}',
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
              } )

              $( '#tr_' + id ).hide();
            

          },
          error: function ( xhr, ajaxOptions, thrownError ) {
            if( xhr.status === 422 ) {
          
              var errors = $.parseJSON(xhr.responseText);
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