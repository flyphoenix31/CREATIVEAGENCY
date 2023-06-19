
<!doctype html>
<html class="no-js" lang="en">
    @include('layout/head')

<body>
    <div class="main-page">
        @include('layout/switcher')
        <!-- Start Header -->
        @include('layout/nav')
        <!-- End Breadcrump Area  -->

        <!-- Start Breadcrump Area  -->
        <div class="rn-page-title-area pt--120 pb--190 bg_image bg_image--17" data-black-overlay="5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="rn-page-title text-center pt--100">
                            <h2 class="title theme-gradient">Contact With Us</h2>
                            <p>Contrary to popular belief, Lorem Ipsum is not simply random text. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcrump Area  -->

        <!-- Start Page Wrapper  -->
        <main class="page-wrapper">

            <!-- Start Contact Address Area  -->
            <div class="rn-contact-address-area rn-section-gap bg_color--5">
                <div class="container">
                    <div class="row mt_dec--40">
                        <!-- Start Single Address  -->
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12 mt--40">
                            <div class="rn-address">
                                <div class="icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="inner">
                                    <h4 class="title">Contact With Phone Number</h4>
                                    <p><a href="tel:+057254365456">+057 254 365 456</a></p>
                                    <p><a href="tel:+856325652984">+856 325 652 984</a></p>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Address  -->

                        <!-- Start Single Address  -->
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12 mt--40">
                            <div class="rn-address">
                                <div class="icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="inner">
                                    <h4 class="title">Email Address</h4>
                                    <p><a href="mailto:admin@gmail.com">admin@gmail.com</a></p>
                                    <p><a href="mailto:example@gmail.com">example@gmail.com</a></p>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Address  -->

                        <!-- Start Single Address  -->
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12 mt--40">
                            <div class="rn-address">
                                <div class="icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="inner">
                                    <h4 class="title">Location</h4>
                                    <p>5678 Bangla Main Road, cities 580 <br /> GBnagla, example 54786</p>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Address  -->

                    </div>
                </div>
            </div>
            <!-- End Contact Address Area  -->

            <!-- Start Contact Area  -->
            <div class="rn-contact-area rn-section-gap bg_color--1">
                <div class="contact-form--1">
                    <div class="container">
                        <div class="row row--35 align-items-start">
                            <div class="col-lg-6 order-2 order-lg-1">
                                <div class="section-title text-left mb--50 mb_sm--30 mb_md--30">
                                    <h2 class="title">Contact Us.</h2>
                                    <p class="description">I am available for freelance work. Connect with me via phone:
                                        <a href="tel:+8801911111111">01911111111</a> or email:
                                        <a href="mailto:admin@example.com"> admin@example.com</a> </p>
                                </div>
                                <div class="form-wrapper">
                                    <form id="formadd" action="{{route('storeNewrequest')}}" method="post">
                                        @csrf


                                        <input name="name" type="text" placeholder="Your Name *" />

                                        <input name="email" type="email" placeholder="Your email *">

                                        <input name="subject" type="text" placeholder="Write a Subject">

                                        <textarea name="message" id="message" placeholder="Your Message"></textarea>


                                        <button type="submit"  class="rn-button-style--2 btn_solid">
                                            <span id="BtnSave">Send message</span>
                                        </button>
                                    </form>
                                    <div class="form-output">
                                        <p class="form-messege-active form-messege"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 order-1 order-lg-2">
                                <div class="thumbnail mb_md--40 mb_sm--40">
                                    <img src="{{ asset('site/images/about-6.jpg') }}" alt="contact-us" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Contact Area  -->

            <!-- Start Brand Area -->
            @include('layout/brand')
            <!-- End Brand Area -->
        </main>
        <!-- End Page Wrapper  -->
        @include('layout/footer')
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" ></script>

    <script type="text/javascript">

$('#formadd').on('submit', function(event){

    event.preventDefault();
    $('.inputTxtError').remove();

    $("#BtnSave").html("Please Wait..");
    $("#BtnSave").prop("disabled",true);
    var formData = new FormData();
    $.ajax( {
        url: "{{route('storeNewrequest')}}",
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        data:new FormData(this),
        cache : false,
        processData: false,
        success: function ( result ) {
            $("#BtnSave").prop("disabled",false);
            $("#BtnSave").html("Send Message");

          if(result.success == true)
          {
              $(".form-messege").removeClass('error').addClass("success");
              $(".form-messege").text(result.message);
          }

          $('#formadd')[0].reset();
        },
        error: function ( xhr, ajaxOptions, thrownError ) {

            if (xhr.status == 422)
            {
                $.each(xhr.responseJSON.errors, function (key, item) {
                    var msg = '<label class="error text-danger inputTxtError" for="'+key+'">'+item+'</label>';
                    $('input[name="' + key + '"],input[id="' + key + '"], select[id="' + key + '"], textarea[id="' + key + '"]').addClass('form-control-danger').before(msg);
                });
            }

            $("#BtnSave").prop("disabled",false);
            $("#BtnSave").html("Send Message");
            $(".form-messege").removeClass('success').addClass("error");
            $(".form-messege").text('Please complete the form and try again.');
        }
      } );

  });
    </script>

    @include('layout/script')


</body>

</html>
