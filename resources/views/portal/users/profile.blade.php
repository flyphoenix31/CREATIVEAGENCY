
<form id="formprofile" name="formprofile" class="section general-info" enctype="multipart/form-data">
            <div class="layout-px-spacing">

                <div class="account-settings-container layout-top-spacing">

                    <div class="account-content">
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">

                                      @csrf
                                        <div class="info">
                                            <h6 class="">General Information</h6>
                                            <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-xl-2 col-lg-12 col-md-4">
                                                            <div class="upload mt-4 pr-md-4">

                                                               <input type="file" id="profile_pic" name="profile_pic" accept="image/*" class="dropify" data-default-file="{{ $user->thumb}}" data-max-file-size="2M" />

                                                                <p class="mt-2 text-capitalize"><i class="fad fa-cloud-upload mr-1"></i>  @lang('lang.change_picture')</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4 text-capitalize">
                                                            <div class="form">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="name">@lang('lang.name')</label>
                                                                            <input type="text" class="form-control mb-4" id="name" name="name" placeholder="@lang('lang.name')" value="{{$user->name}}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                              <label for="birthdate">@lang('lang.dob')</label>
                                                                              <input type="text" class="form-control" id="birthdate" name="birthdate" value="{{$user->birthdate}}">
                                                                          </div>
                                                                      </div>

                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="email">@lang('lang.email')</label>
                                                                            <input type="text" class="form-control" id="email" name="email" aria-describedby="email" placeholder="@lang('lang.email')" value="{{$user->email}}">
                                                                            <small id="sh-text1" class="form-text text-muted">@lang('lang.note_email_change').</small>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-6">
                                                                      <div class="form-group">
                                                                            <label for="phone">@lang('lang.phone')</label>
                                                                            <input type="text" class="form-control" id="phone" name="phone" aria-describedby="email" placeholder="@lang('lang.phone')" value="{{$user->phone}}">
                                                                            <small id="sh-text1" class="form-text text-muted">@lang('lang.note_phone_change').</small>
                                                                        </div>
                                                                    </div>



                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">

                                        <div class="info">
                                            <h5 class=""> @lang('lang.about')</h5>
                                            <div class="row">
                                                <div class="col-md-11 mx-auto">
                                                    <div class="form-group">
                                                        <textarea class="form-control" id="aboutBio" placeholder="Tell something interesting about yourself" rows="10"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>




                            </div>
                        </div>
                    </div>

                    <div class="account-settings-footer">

                        <div class="as-footer-container">

                            <button id="multiple-reset" type="button" class="btn btn-primary">Reset All</button>
                            <div class="blockui-growl-message">
                                <i class="flaticon-double-check"></i>&nbsp; Profile picture has been changed
                            </div>





                            <button id="multiple-messages" type="submit" class="btn btn-success">Save Changes</button>



                        </div>

                    </div>
                </div>

            </div>

        </form>


@section('bottom_js')
@parent
<script type="text/javascript">
jQuery(document).ready(function($) {

  var f1 = flatpickr(document.getElementById('birthdate'));

  $('.dropify').dropify({
      messages: { 'default': 'Click to Upload or Drag n Drop', 'remove':  '<i class="flaticon-close-fill"></i>', 'replace': 'Upload or Drag n Drop' }
  });



  $('#formprofile').on('submit', function(event){
    event.preventDefault();
    $('.inputTxtError').remove();
    show_wait('update');
    var formData = new FormData(this);
    $.ajax( {
        url: "{{route('updatemyprofile')}}",
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
            lazyLoadInstance.update();

            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2500,
                padding: '2em'
            });

            toast({
                type: 'success',
                title: '@lang("lang.profile_update_message")',
                padding: '1em',
            });


        },
        error: function ( xhr, ajaxOptions, thrownError ) {
          swal.close();
          displayFieldErrors(xhr.responseJSON.errors,xhr.status);
        }
      } );

  });

  // Save notification messagae
  $('#multiple-messagses').on('click', function() {
      $.blockUI({
          message: $('.blockui-growl-message'),
          fadeIn: 700,
          fadeOut: 700,
          timeout: 3000, //unblock after 3 seconds
          showOverlay: false,
          centerY: false,
          css: {
              width: '300px',
              backgroundColor: 'transparent',
              top: '80px',
              left: 'auto',
              right: '15px',
              border: 0,
              opacity: .95,
              zIndex: 1200,
          }
      });
  });

  setTimeout(function(){ $('.list-group-item.list-group-item-action').last().removeClass('active'); }, 100);

});


//uploader event


$("#profile_pic").on("change", function() {
    var file_data = $("#profile_pic").prop("files")[0];
    var form_data = new FormData();
    form_data.append("profile_image", file_data);
    form_data.append("_token", "{{ csrf_token() }}");

    $.ajax({
        url: "{{route('store_profile_image')}}",
        dataType: 'script',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(){
            $.blockUI({
          message: $('.blockui-growl-message'),
          fadeIn: 700,
          fadeOut: 700,
          timeout: 3000, //unblock after 3 seconds
          showOverlay: false,
          centerY: false,
          css: {
              width: '300px',
              backgroundColor: 'transparent',
              top: '80px',
              left: 'auto',
              right: '15px',
              border: 0,
              opacity: .95,
              zIndex: 1200,
          }
      });
        }
    });
});



</script>
@endsection
