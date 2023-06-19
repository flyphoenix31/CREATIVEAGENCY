

@section('bottom_js')
@parent

<script language="javascript">


$('#openaddmodel').on('hidden.bs.modal', function () {
    $("#formadd").trigger("reset");
    $('#uploadfiles')[0].reset();
    $('.inputTxtError').remove();
});

var secondUpload = new FileUploadWithPreview('mySecondImage')

function openmodel() {
    $('.inputTxtError').remove();
    $('#uploadfiles')[0].reset();
    $( '#uploadFiles' ).modal( 'show' );
}


$("#sectionfile").on('click', '.dropdown #cclc #callDelFunc', function(e) {
    var id = $(this).data('id');
    var uuid = $(this).data('uuid');
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
          url: '{{route('delete_file')}}',
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



$("#sectionfile").on('click', '.dropdown #cclc #callRenameFunc', function(e) {

    $('#Formrename')[0].reset();
    var name =$(this).data('name');
    var id =$(this).data('id');
    $( '#edit_name' ).val(name);
    $( '#fileid' ).val(id);
    $( '#ModalRename' ).modal( 'show' );

});


$('#Formrename').on('submit', function(event){

event.preventDefault();
$('.inputTxtError').remove();

show_wait('update');
var formData = new FormData();
$.ajax( {
    url: "{{route('rename_file')}}",
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
        $( '#ModalRename' ).modal().hide();
        $( '#ModalRename' ).modal( 'hide' );

        $('#filename_'+result.id).text(result.name);

        const toast = swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500,
            padding: '2em'
        });

        toast({
            type: 'success',
            title: '@lang("lang.rename_file_success_message")',
            padding: '1em',
        });

    },
    error: function ( xhr, ajaxOptions, thrownError ) {
      swal.close();
      displayFieldErrors(xhr.responseJSON.errors,xhr.status);
    }
  } );

});

/*
$( "#callRenameFunc" ).click(function() {
  alert( "Handler for .click() called." );
}); */


$('#uploadfiles').on('submit', function(event){
    event.preventDefault();
    $('.inputTxtError').remove();

    show_wait('update');
    var formData = new FormData(this);
    formData.append('uuid', $( '#uuid' ).val());
    $.ajax( {
        url: "{{route('upload_files')}}",
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        data:formData,
        cache : false,
        processData: false,
        success: function ( result ) {

            $( "#divFileList" ).prepend( result.render );
            swal.close();
            $( '#uploadFiles' ).modal().hide();
            $( '#uploadFiles' ).modal( 'hide' );
            lazyLoadInstance.update();

        },
        error: function ( xhr, ajaxOptions, thrownError ) {
          swal.close();
          displayFieldErrors(xhr.responseJSON.errors,xhr.status);
        }
      } );

  });



</script>

@endsection
