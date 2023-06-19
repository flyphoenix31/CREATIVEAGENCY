@section('bottom_js')

@show

<script src="{{ asset('cork/js/lazyload.min.js') }}"></script>
<script src="{{asset($theme . 'plugins/sweetalerts/sweetalert2.min.js')}}"></script>
<script src="{{asset($theme . 'plugins/sweetalerts/custom-sweetalert.js')}}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js"></script> --}}

<script src="{{ asset('cork/js/feather.min.js') }}"></script>

<script language="javascript">



   var lazyLoadInstance = new LazyLoad({
      elements_selector: ".lazy",
     load_delay: 300,
  });

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    //document.body.scrollTop = 0; // For Safari
    //document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera

  $('html, body').animate({scrollTop:0}, 'slow');

}

//global ajax pagination

    $( function () {

      @section('initiate_ajax_load')

      @show

        $( ".filter" ).on( "click", ".search", function ( e ) {
            e.preventDefault();
            getdatalist( '' );
        } );

        $( ".filter" ).on( "click", "#reset_search", function ( e ) {
            e.preventDefault();
            $( '#searchform' )[ 0 ].reset();
            getdatalist( '' );
        } );

        $( 'body' ).on( 'click', '.pagination a', function ( e ) {
            e.preventDefault();
            var url = $( this ).attr( 'href' );
            getdatalist( url );
        } );

        function getdatalist( url ) {
            if ( !url ) {
                var url = "{{url()->current()}}";
            }
            window.history.pushState( "", "", url );

            /* $('html, body').animate({
                scrollTop: $(".datalist").offset().top - 250
            }, 500); */

            swal( {
                title: '@lang("lang.please_wait")',
                text: '@lang("lang.updating_data")..',
                allowOutsideClick: false,
                allowEnterKey: false,
                onOpen: () => {
                    swal.showLoading()
                }
            } );

            $.ajax( {
                url: url,
                datap: {
                    _method: 'get',
                    _token: "{{ csrf_token() }}",
                    _data: $( "#searchform" ).serialize(),
                },
                data: $( "#searchform" ).serialize(),
            } ).done( function ( data ) {
                $( '.datalist' ).html( data );
                swal.close();
                lazyLoadInstance.update();

            } ).fail( function () {

                $( ".ajaxloadlabel" ).removeClass( "text-primary" ).addClass( "text-danger" ).text("@lang('lang.something_went_wrong')");
                swal.close();
            } );
        }
    } );

  function swal_close()
  {
    swal.close();
  }
  function show_wait(type)
  {
    var stext = '@lang("lang.fetching_data")..';
    if (type =='update')
    {
      var stext = '@lang("lang.updating_data")..';
    }
    else if (type =='fetch')
    {
      var stext = '@lang("lang.fetching_data")..';
    }
    else if (type =='delete')
    {
      var stext = '@lang("lang.deleting_data")..';
    }
    else if (type =='redirect')
    {
      var stext = '@lang("lang.redirect_page")..';
    }
    swal( {
                title: '@lang("lang.please_wait")',
                text: stext,
                allowOutsideClick: false,
                closeOnEsc: false,
                allowEnterKey: false,
                buttons: false,
                onOpen: () => {
                    swal.showLoading()
                }
            } )
  }

  function ajaxErrors(response,error_code)
  {

    console.info(error_code);

    if (error_code == 422)
    {
        swal( '@lang("lang.error")', '@lang("error.error_fill_required")', "error" );
    }
    else if (error_code == 403)
    {
        swal( '@lang("lang.error")', '@lang("error.permission_denied")', "error" );
    }
    else
    {
      swal( '@lang("lang.error")', '@lang("lang.try_again")', "error" );
    }
  }


  function displayFieldErrors(response,error_code)
  {
    $('.inputTxtError').remove();

    if (error_code == 422)
    {
      $.each(response, function (key, item) {
        var msg = '<label class="invalid-feedbackf mb-1 text-danger inputTxtError" for="'+key+'">'+item+'</label>';
        $('input[id="' + key + '"], select[id="' + key + '"], textarea[id="' + key + '"]').addClass('form-control-danger needs-validation').after(msg);

      });
    }
    else if (error_code == 403)
    {
        swal( '@lang("lang.error")', '@lang("error.permission_denied")', "error" );
    }
    else
    {
      swal( '@lang("lang.error")', '@lang("lang.try_again")', "error" );
    }
  }

$( document ).ready(function() {

    //block all sepcial char
    $(".blockSpecialChar").on('keypress change input paste', function(e) {
        var k;
        document.all ? k = e.keyCode : k = e.which;
        return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57));
    });

    //block all sepcial char & Space
    $(".blockSpecialCharandSpace").on('keypress change input paste', function(e) {
        var k;
        document.all ? k = e.keyCode : k = e.which;
        return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || (k >= 48 && k <= 57));
    });

    //allow only Numeric Values

    $(".allowNumberonly").on('keypress change input paste', function(e) {
        var k = (e.which) ? e.which : e.keyCode
        if (k > 31 && (k < 48 || k > 57))
            return false;
        return true;
    });

    //Allow Only Price numeric values.
    $(".allowPriceonly").on('keypress change input paste', function(event) {
            var $this = $(this);
            if ((event.which != 46 || $this.val().indexOf('.') != -1) &&
            ((event.which < 48 || event.which > 57) &&
            (event.which != 0 && event.which != 8))) {
                event.preventDefault();
            }
            var text = $(this).val();
            if ((event.which == 46) && (text.indexOf('.') == -1)) {
                setTimeout(function() {
                    if ($this.val().substring($this.val().indexOf('.')).length > 3) {
                        $this.val($this.val().substring(0, $this.val().indexOf('.') + 3));
                    }
                }, 1);
            }
            if ((text.indexOf('.') != -1) &&
                (text.substring(text.indexOf('.')).length > 2) &&
                (event.which != 0 && event.which != 8) &&
                ($(this)[0].selectionStart >= text.length - 2)) {
                    event.preventDefault();
            }
        });

});





$.ajax({
    url :'{{route('notificationlist')}}',
    type:'GET',
    headers: {
            'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
          },
    success:function(data){
        $('#notificationList').html(data.render);
        feather.replace();
    }
});

var elementsToReplace = document.querySelectorAll('[data-feather]');

                Array.from(elementsToReplace).forEach(function (element) {
                    let icon = element.getAttribute('data-feather');
                    if (typeof feather.icons[icon] === "undefined") {
                        element.removeAttribute('data-feather');
                    }
                });

//feather.replace();


</script>
