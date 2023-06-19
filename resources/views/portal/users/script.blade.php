@section('bottom_js')
@parent

<script language="javascript">
$(".datalist").on("click","#checkAll", function(){
     $('input:checkbox').not(this).prop('checked', this.checked);
});

 $(".bulkdelete").on('click', function(e) {

  if($('.datalist input:checked').length <= 0)
  {
    const toast = swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1500,
        padding: '2em'
    });

    toast({
        type: 'error',
        title: '@lang("error.no_record_selected")',
        padding: '1em',
    });
    return false;
  }

  var userids = [];

  $(".checkbox:checked").each(function() {

    userids.push($(this).attr('data-id'));

  });


  show_wait('update');
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax( {
        url: "{{route('bulk_delete_user')}}" + '?ids=' +userids,
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        type: 'delete',
        data: {ids:userids},
        cache : false,
        processData: false,
        success: function ( result ) {
          swal.close();
          $(".checkbox:checked").each(function() {
            $("#tr_"+$(this).attr('data-id')).fadeOut('slow');
          });

          if (result.message)
          {
            swal({  icon: 'success',  title: '@lang("lang.done")!',text: result.message, button: '@lang("lang.okay")',});
          }
          else{
            swal({  icon: 'success',  title: '@lang("lang.done")!',text: '@lang("lang.record_deleted_success_msg")', button: '@lang("lang.okay")',});
          }



        },
        error: function ( xhr, ajaxOptions, thrownError ) {
          swal.close();
          swal( '@lang("lang.error")', '@lang("error.something_went_wrong")', "error" );
          displayFieldErrors(xhr.responseJSON.errors,xhr.status);
        }
      } );
});

function openmodel() {
    $("#savebtn").html('@lang("lang.add")');
    $('#formadd')[0].reset();
    $( '#openaddmodel' ).modal( 'show' );
}

function openBulkStatusmodel() {
    if($('.datalist input:checked').length <= 0)
    {
        const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500,
            padding: '2em'
        });

        toast({
            type: 'error',
            title: '@lang("error.no_record_selected")',
            padding: '1em',
        });
        return false;
    }
    $("#savebtn").html('@lang("lang.add")');
	var ids = [];
	$('input[type=checkbox]:checked').map(function(i, el) {
    	ids[i] = $(el).data('id');
	}).get();
    $('#formchangebulkstatus')[0].reset();
	$('.inputTxtError').remove();
	$('#usersIds').val(ids);
    $( '#openbulkstatusmodel' ).modal( 'show' );
}

function openBulkRolemodel() {
    $("#savebtn").html('@lang("lang.add")');
	var ids = [];
	$('input[type=checkbox]:checked').map(function(i, el) {
    	ids[i] = $(el).data('id');
	}).get();
    $('#formchangebulkrole')[0].reset();
	$('.inputTxtError').remove();
	$('#usersRoleIds').val(ids);
    $( '#openbulkrolemodel' ).modal( 'show' );
}


jQuery(document).ready(function($) {

$('#formadd').on('submit', function(event){
    event.preventDefault();
    $('.inputTxtError').remove();

    show_wait('update');
    var formData = new FormData();
    $.ajax( {
        url: "{{route('store_user')}}",
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

//edit
  $('#formedit').on('submit', function(event){
    event.preventDefault();
    $('.inputTxtError').remove();
    show_wait('update');
    var formData = new FormData();
    $.ajax( {
        url: "{{route('update_user')}}",
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
            $( '#formeditmodel' ).modal( 'hide' );
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
//get user details
  $(".datalist").on("click",".editrecord", function(){
      var id=$(this).data('id');
      $('.inputTxtError').remove();
      show_wait('fetch');

      $.ajax( {
        url: "{{route('show_user')}}",
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
                $('#formeditmodel').modal('show');
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
      confirmButtonColor: "#e7515a",
      closeOnConfirm: false
    } ).then( ( result ) => {
      if ( result.value ) {
        show_wait('delete');
        $.ajax( {
          url: '{{route('delete_user')}}',
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
              $( '#tr_' + id ).hide();
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

$(".datalist").on("click",".changepassword", function(){
  var id=$(this).data('id');
  $('#formchangepassword')[0].reset();
  $('.inputTxtError').remove();
  $('#id').val(id);
  $( '#openpasswordmodel' ).modal( 'show' );
});


$('#formchangepassword').on('submit', function(event){
    event.preventDefault();
    $('.inputTxtError').remove();
    //var $form = $(this);
    //if(! $form.valid()) return false;
    show_wait('update');

    var formData = new FormData();
    $.ajax( {
        url: "{{route('update_password')}}",
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
            $( '#openpasswordmodel' ).modal( 'hide' );
            swal({ icon: "success",  type: 'success',  title: '@lang("lang.done")!',text: '@lang("lang.update_success_msg")', confirmButtonText: '@lang("lang.okay")'});
          } else {
            swal( result.message, "error" );
          }
        },
        error: function ( xhr, ajaxOptions, thrownError ) {
          swal.close();
          displayFieldErrors(xhr.responseJSON.errors,xhr.status);
        }
      } );

  });

$('#formchangebulkstatus').on('submit', function(event){
    event.preventDefault();
    $('.inputTxtError').remove();
    //var $form = $(this);
    //if(! $form.valid()) return false;
    show_wait('update');

    var formData = new FormData();
    $.ajax( {
        url: "{{route('update_bulk_userstatus')}}",
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
            $( '#openbulkstatusmodel' ).modal( 'hide' );

            if (result.message)
            {
                swal({  icon: 'success',  title: '@lang("lang.done")!',text: result.message, button: '@lang("lang.okay")',});
            }
            else{
                swal({ icon: "success",  type: 'success',  title: '@lang("lang.done")!',text: '@lang("lang.update_success_msg")', confirmButtonText: '@lang("lang.okay")'});
            }

            var data = result.record;
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


$(".datalist").on("click",".changestatus", function(){
      var id=$(this).data('id');
      $('.inputTxtError').remove();
      show_wait('fetch');
      $.ajax( {
        url: "{{route('get_userstatus')}}",
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
          swal( '@lang("lang.error")', '@lang("lang.try_again")', "error" );
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
        url: "{{route('update_userstatus')}}",
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

  $(".datalist").on("click",".changeprofileimage", function(){
    var id = $(this).data('id');
	$('#hidden_void').val(id)	;
	$('#formprofile')[0].reset();
	$('.imga, .imgdiv').hide();
	$( '#openprofilemodel' ).modal( 'show' );
  });


});
@section('initiate_ajax_load')
  @parent
  getdatalist( '' );

@endsection
</script>
@endsection
