

@section('bottom_js')
@parent

<script language="javascript">

$("#sectionfile").on('click', '.dropdown #folderaction #callEditShareFunc', function(e) {
    $('#FormEditShare')[0].reset();
    $('#FormEditShare').trigger("reset");
    var link = $(this).data('link');
    var id   = $(this).data('id');
    var protected   = $(this).data('protected');
    var exp_at   = $(this).data('expire_at');
    var expired   = $(this).data('expired');

    if (protected == 1)
    {
        $( "#edit_is_protected" ).prop( "checked", true );
    }
    else
    {
        $( "#edit_is_protected" ).prop( "checked", false );
    }

    if (exp_at)
    {
        if (expired)
        {
            var val = '<small id="sh-text1" class="form-text text-danger">Your link Expired.You may Extend the Date.</small>';
        }
        else
        {
            var val = '<small id="sh-text1" class="form-text text-muted">Your link will expire at <span id="link_exp_txt" class="text-primary">'+exp_at+'</span></small>';
        }

        $("#link_note").html(val);
    }
    else
    {
        $("#link_note").html('<small id="sh-text1" class="form-text text-primary">Your link wont expire.</small>');
    }





    $( '#edit_public_link' ).val(link);
    $( '#edit_share_file_uuid' ).val(id);
    $( '#edit_share_type' ).val('folder');
    $( '#ModalEditsharefile' ).modal( 'show' );
});

$("#sectionfile").on('click', '.dropdown #cclc #callEditShareFunc', function(e) {

    $('#FormEditShare')[0].reset();
    $('#FormEditShare').trigger("reset");
    var link = $(this).data('link');
    var id   = $(this).data('id');
    var protected   = $(this).data('protected');
    var exp_at   = $(this).data('expire_at');
    var expired   = $(this).data('expired');



    if (protected == 1)
    {
        $( "#edit_is_protected" ).prop( "checked", true );
    }
    else
    {
        $( "#edit_is_protected" ).prop( "checked", false );
    }

    if (exp_at)
    {
        var val = '';


        if (expired)
        {
            var val = '<small id="sh-text1" class="form-text text-danger">Your link Expired.You may Extend the Date.</small>';
        }
        else
        {
            var val = '<small id="sh-text1" class="form-text text-muted">Your link will expire at <span id="link_exp_txt" class="text-primary">'+exp_at+'</span></small>';
        }

        $("#link_note").html(val);
    }
    else
    {
        $("#link_note").html('<small id="sh-text1" class="form-text text-primary">Your link wont expire.</small>');
    }

    $( '#edit_public_link' ).val(link);
    $( '#edit_share_file_uuid' ).val(id);
    $( '#edit_share_type' ).val('');
    $( '#ModalEditsharefile' ).modal( 'show' );
});


$("#sectionfile").on('click', '.dropdown #cclc #callLinkShareFunc', function(e) {
    var link =$(this).data('link');
    var id =$(this).data('id');
    $( '#sharepublic_link' ).val(link);
    $( '#share_file_uuid' ).val(id);
    $( '#sharediscardMsg' ).html( "Discord" );
    $( '#Modalsharefile' ).modal( 'show' );
});

$("#sectionfile").on('click', '.dropdown #folderaction #callLinkShareFunc', function(e) {
    var link =$(this).data('link');
    var id =$(this).data('id');
    $( '#sharepublic_link' ).val(link);
    $( '#share_file_uuid' ).val(id);
    $( '#sharediscardMsg' ).html( "Discord" );
    $( '#Modalsharefile' ).modal( 'show' );

});


$("#sectionfile").on('click', '.dropdown #folderaction #callShareFunc', function(e) {
    var id =$(this).data('id');
    $( '#create_file_uuid' ).val(id);
    $( '#share_type' ).val('folder');
    $( '#ModalCreatesharefile' ).modal( 'show' );

});

$("#sectionfile").on('click', '.dropdown #cclc #callShareFunc', function(e) {
    var id =$(this).data('id');
    $( '#create_file_uuid' ).val(id);
    $( '#share_type' ).val('file');
    $( '#ModalCreatesharefile' ).modal( 'show' );

});


$('ul#link_expire li').click(function(e)
{
    var id = $(this).data("id");
    $( '#link_exp' ).val(id);

    $('ul li.active').removeClass('active');
    $(this).closest('li').addClass('active');

});

$('ul#et_link_expire li').click(function(e)
{
    var id = $(this).data("id");
    $( '#edit_link_exp' ).val(id);
    $('ul li.active').removeClass('active');
    $(this).closest('li').addClass('active');

});




$('#FormShareLink').on('submit', function(event){
event.preventDefault();
$('.inputTxtError').remove();

show_wait('update');
var formData = new FormData();
$.ajax( {
    url: "{{route('mail_share_link')}}",
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
        $( '#Modalsharefile' ).modal().hide();
        $( '#Modalsharefile' ).modal( 'hide' );

        const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500,
            padding: '2em'
        });

        toast({
            type: 'success',
            title: '@lang("lang.mail_sent_success")',
            padding: '1em',
        });

    },
    error: function ( xhr, ajaxOptions, thrownError ) {
      swal.close();
      displayFieldErrors(xhr.responseJSON.errors,xhr.status);
    }
  } );

});





$('#FormShareFile').on('submit', function(event){
event.preventDefault();
$('.inputTxtError').remove();

show_wait('update');
var formData = new FormData();
$.ajax( {
    url: "{{route('genarete_share_file_link')}}",
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
        $( '#ModalCreatesharefile' ).modal().hide();
        $( '#ModalCreatesharefile' ).modal( 'hide' );

        if(result.type == 'folder')
        {
            $('#foler_uuid_'+result.id).replaceWith(result.render);
        }
        else
        {
            $('#file_uuid_'+result.id).replaceWith(result.render);
        }



        lazyLoadInstance.update();

        const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500,
            padding: '2em'
        });

        toast({
            type: 'success',
            title: '@lang("lang.share_link_created_success")',
            padding: '1em',
        });

        $( '#sharepublic_link' ).val(result.record.link);
        $( '#share_file_uuid' ).val(result.record.item_id);



        $( '#sharediscardMsg' ).html( "I'm Done" );

        $( '#Modalsharefile' ).modal( 'show' );

    },
    error: function ( xhr, ajaxOptions, thrownError ) {
      swal.close();
      displayFieldErrors(xhr.responseJSON.errors,xhr.status);
    }
  } );

});



//get user details
$("#sectionfile").on("click","dropdown #cclc #callEditShareFunc", function(){
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


$('#FormEditShare').on('submit', function(event){
event.preventDefault();
$('.inputTxtError').remove();

show_wait('update');
var formData = new FormData();
$.ajax( {
    url: "{{route('edt_share')}}",
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
        $( '#ModalEditsharefile' ).modal().hide();
        $( '#ModalEditsharefile' ).modal( 'hide' );

        if(result.type == 'folder')
        {
            $('#foler_uuid_'+result.id).replaceWith(result.render);
        }
        else
        {
            $('#file_uuid_'+result.id).replaceWith(result.render);
        }



        lazyLoadInstance.update();

        const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500,
            padding: '2em'
        });

        toast({
            type: 'success',
            title: '@lang("lang.share_link_created_success")',
            padding: '1em',
        });

    },
    error: function ( xhr, ajaxOptions, thrownError ) {
      swal.close();
      displayFieldErrors(xhr.responseJSON.errors,xhr.status);
    }
  } );

});



$("#cancelsharing").on("click", function(){

      var id = $( '#edit_share_file_uuid' ).val();
      var sharetype = $( '#edit_share_type' ).val();

      Swal( {
      title: '@lang("lang.remove_sharing_confirmation")',
      text: '@lang("lang.remove_sharing_text")',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: '@lang("lang.remove")',
      cancelButtonText: '@lang("lang.cancel")',
      confirmButtonColor: "#e7515a",
      closeOnConfirm: false
    } ).then( ( result ) => {
      if ( result.value ) {
        show_wait('update');
        $.ajax( {
          url: '{{route('remove_share_link')}}',
          headers: {
            'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
          },
          type: 'delete',
          data: {
            sharetype: sharetype,
            id: id,
            _token: "{{ csrf_token() }}",
          },
          dataType: "json",
          success: function ( result ) {

            swal.close();
            $( '#ModalEditsharefile' ).modal().hide();
            $( '#ModalEditsharefile' ).modal( 'hide' );

            $('#file_uuid_'+result.id).replaceWith(result.render);

            lazyLoadInstance.update();

            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                padding: '2em'
            });

            toast({
                type: 'success',
                title: '@lang("lang.share_link_removed_success")',
                padding: '1em',
            });


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
