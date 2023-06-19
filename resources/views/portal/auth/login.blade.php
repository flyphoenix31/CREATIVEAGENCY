@extends('portal.layouts.auth')

@section('content')

    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">
                        <h1 class="">@lang('auth.sign_in')</h1>
                        <p class="">@lang('auth.title_login').</p>

                        <form class="text-left" name="authform" id="authform" action="{{route('submit_login')}}" method="post" autocomplete="off">
                            {!! csrf_field() !!}
                            <div class="" id="loginvalidation-errors"></div>
                            <div class="form">

                                <div id="username-field" class="field-wrapper input">
                                    <label for="username" class="text-uppercase">@lang('auth.username') / @lang('auth.email')</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>


                                    <input class="form-control" type="text" id="authusername" name="username" placeholder="@lang('auth.ph_username_or_email')" required maxlength="50" autofocus>


                                </div>

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <div class="d-flex justify-content-between">
                                        <label for="password" class="text-uppercase">@lang('auth.password')</label>
                                        <a href="/reset-password" class="forgot-pass-link text-capitalize">@lang('auth.forget_password')?</a>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>

                                    <input type="password" class="form-control" id="password" name="password" placeholder="@lang('auth.ph_password')" required maxlength="30" value="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button id="dologin" type="submit" class="btn btn-primary" value="">@lang('auth.login')</button>
                                    </div>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
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
