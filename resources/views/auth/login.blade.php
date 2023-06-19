@extends('admin.layout.master-mini')
@section('content')

<div class="content-wrapper d-flex align-items-center justify-content-center auth theme-one" style="background-image: url({{ url('admin/assets/images/auth/login_1.jpg') }}); background-size: cover;">
  <div class="row w-100">
    <div class="col-lg-4 mx-auto">
      <div class="auto-form-wrapper">
        <form class="text-left" name="authform" id="authform" action="{{route('submit_login')}}" method="post" autocomplete="off">
                            {!! csrf_field() !!}
                            <div class="" id="loginvalidation-errors"></div>
          <div class="form-group">
            <label class="label">Email</label>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Email" id="authusername" name="username" >
              <div class="input-group-append">
                <span class="input-group-text">
                  <i class="mdi mdi-check-circle-outline"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="label">Password</label>
            <div class="input-group">
              <input type="password" class="form-control" placeholder="*********" id="password" name="password">
              <div class="input-group-append">
                <span class="input-group-text">
                  <i class="mdi mdi-check-circle-outline"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <button id="dologin" type="submit" class="btn btn-primary submit-btn btn-block">Login</button>
          </div>
          <div class="form-group d-flex justify-content-between">
            <div class="form-check form-check-flat mt-0">


            </div>
            
          </div>
        </form>
      </div>
      <ul class="auth-footer">
        <li>
          <a href="#">Conditions</a>
        </li>
        <li>
          <a href="#">Help</a>
        </li>
        <li>
          <a href="#">Terms</a>
        </li>
      </ul>
      <p class="footer-text text-center">@lang('lang.copyright') © 2020.<a href="#" target="_blank">@lang('lang.company_name')</a>. @lang('lang.all_rights_reserved').</p>
    </div>
  </div>
</div>

<script type="text/javascript">


    $('#authform').on('submit', function(event){
    event.preventDefault();
      var formData = new FormData();
                jQuery.ajax({
        url: "{{route('submit_login')}}",
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        data:new FormData(this),
        cache : false,
        processData: false,

                beforeSend:function(){
                    $("#dologin").text('@lang("lang.please_wait")');
                    $('#dologin').attr('disabled', 'disabled');
                    $('#loginvalidation-errors').html('');
                },
                success:function(data) {
                    if (data.success == true)
                        {
                            var sdf = '@lang("auth.login_success_message")';
                            $('#loginvalidation-errors').append('<div class="alert alert-success isa_success">'+sdf+'</div');
                            url = data.url;
                            $("#dologin").text('@lang("auth.successfully_logged")');
                            $(location).attr("href", url);
                        }
                    else
                        {
                            $.each(data.message, function(key,value) {
                                 $('#loginvalidation-errors').append('<div class="alert alert-danger isa_error">'+value+'</div');
                             });
                            $("#dologin").text('@lang("lang.login")');
                            $('#dologin').removeAttr('disabled');
                        }

                },
                error: function (data, ajaxOptions, thrownError) {
                    $("#dologin").text('@lang("lang.login")');
                    $('#dologin').removeAttr('disabled');
                    var merrors = $.parseJSON(data.responseText);
                    var errors = merrors.errors;
                    $.each(errors, function (key, value) {
                        $('#loginvalidation-errors').append('<div class="alert alert-danger isa_error">'+value+'</div');
                    });
                }
              });
            } );
  </script>
@endsection
