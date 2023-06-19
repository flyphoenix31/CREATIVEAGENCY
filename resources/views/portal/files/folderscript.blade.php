

@section('bottom_js')
@parent

<script language="javascript">

$("#sectionfile").on('click', '.dropdown #folderaction #callFolderRenameFunc', function(e) {
    $('#Formfolderrename')[0].reset();
    var name =$(this).data('name');
    var id =$(this).data('id');
    $( '#folder_edit_name' ).val(name);
    $( '#folerid' ).val(id);
    $( '#ModalFolderRename' ).modal( 'show' );
});

function CreateFolder() {
    $('#Formcreatefolder')[0].reset();
    $( '#ModalCreateFolder' ).modal( 'show' );
}


$('#Formcreatefolder').on('submit', function(event){
    event.preventDefault();
    $('.inputTxtError').remove();
    show_wait('update');
    //var formData = new FormData();
    var formData = new FormData(this)
    formData.append('uuid', $( '#uuid' ).val());
    $.ajax( {
        url: "{{route('create_folder')}}",
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        data:formData,
        cache : false,
        processData: false,
        success: function ( result ) {
            swal.close();
            $( '#ModalCreateFolder' ).modal().hide();
            $( '#ModalCreateFolder' ).modal( 'hide' );

            $( "#divFolderList" ).prepend( result.render );

            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                padding: '2em'
            });

            toast({
                type: 'success',
                title: '@lang("lang.new_folder_success_message")',
                padding: '1em',
            });



        },
        error: function ( xhr, ajaxOptions, thrownError ) {
          swal.close();
          displayFieldErrors(xhr.responseJSON.errors,xhr.status);
        }
      } );

  });

$('#Formfolderrename').on('submit', function(event){

    event.preventDefault();
    $('.inputTxtError').remove();

    show_wait('update');
    var formData = new FormData();
    $.ajax( {
        url: "{{route('rename_folder')}}",
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
            $( '#ModalFolderRename' ).modal().hide();
            $( '#ModalFolderRename' ).modal( 'hide' );

            $('#folname_'+result.id).text(result.name);

            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                padding: '2em'
            });

            toast({
                type: 'success',
                title: '@lang("lang.rename_folder_success_message")',
                padding: '1em',
            });

        },
        error: function ( xhr, ajaxOptions, thrownError ) {
          swal.close();
          displayFieldErrors(xhr.responseJSON.errors,xhr.status);
        }
      } );

  });

$("#sectionfile").on('click', '.dropdown #folderaction #callFolderDelFunc', function(e) {
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
          url: '{{route('delete_foler')}}',
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
              $( '#fol_' + id ).hide();
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
