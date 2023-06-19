

@section('bottom_js')
@parent

<script language="javascript">

$("#category_id").select2({
    tags: true,
    placeholder: "All Category",
    allowClear: true
});

$(document).on('change', '#date_posted', function() {
    $('#date_posted').not(this).prop('checked', false);
});


$("#clrForm").click(function(){
    $('#category_id').val('').trigger('change');
});


$('#formsearch').on('submit', function(event){
    event.preventDefault();
    $('.inputTxtError').remove();

    show_wait('update');
    var formData = new FormData();
    $.ajax( {
        url: "{{route('search_job')}}",
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
            $("#jobdiv").html(result.records);


            $("html, body").animate({ scrollTop: 0 }, "slow");


        },
        error: function ( xhr, ajaxOptions, thrownError ) {
          swal.close();
          displayFieldErrors(xhr.responseJSON.errors,xhr.status);
        }
      } );

  });


</script>

@endsection
