<style>


@media(min-width:568px) {
    .end {
        margin-left: auto
    }
}

@media(max-width:768px) {
    #post {
        width: 100%
    }
}

#clicked {
    padding-top: 1px;
    padding-bottom: 1px;
    text-align: center;
    width: 100%;
    background-color: #ecb21f;
    border-color: #a88734 #9c7e31 #846a29;
    color: black;
    border-width: 1px;
    border-style: solid;
    border-radius: 13px
}

#profile {
    background-color: unset
}

#post {
    margin: 10px;
    padding: 6px;
    padding-top: 2px;
    padding-bottom: 2px;
    text-align: center;
    background-color: #ecb21f;
    border-color: #a88734 #9c7e31 #846a29;
    color: black;
    border-width: 1px;
    border-style: solid;
    border-radius: 13px;
    width: 50%
}


#nav-items li a,
#profile {
    text-decoration: none;
    color: rgb(224, 219, 219);
    background-color: black
}

.comments {
    margin-top: 5%;
    margin-left: 20px
}

.darker {
    border: 1px solid #ecb21f;
    background-color: black;
    float: right;
    border-radius: 5px;
    padding-left: 40px;
    padding-right: 30px;
    padding-top: 10px
}

.maincomment {
    width: 100%;float: right;
}

.comment {
    border: 1px solid rgba(16, 46, 46, 1);
    background-color: rgba(16, 46, 46, 0.973);
    float: left;
    border-radius: 5px;
    padding-left: 40px;
    padding-right: 30px;
    padding-top: 10px
}

.comment h4,
.comment span,
.darker h4,
.darker span {
    display: inline
}

.comment p,
.comment span,
.darker p,
.darker span {
    color: rgb(184, 183, 183)
}

h1,
h4 {
    color: white;
    font-weight: bold
}

label {
    color: rgb(212, 208, 208)
}

#align-form {
    margin-top: 20px
}

.form-group p a {
    color: white
}

#checkbx {
    background-color: black
}

#darker img {
    margin-right: 15px;
    position: static
}

.form-group input,
.form-group textarea {
    background-color: black;
    border: 1px solid rgba(16, 46, 46, 1);
    border-radius: 12px
}

form {
    border: 1px solid rgba(16, 46, 46, 1);
    background-color: rgba(16, 46, 46, 0.973);
    border-radius: 5px;
    padding: 20px
}
    </style>

<!-- new comment -->


        <div class="row">

            <!-- Main Body -->
            <section>
                <div class="container">


                    <div class="row">
                        <div class="col-12 mt-4 float-right">

                            <form id="formAddComment" class="formAddComment" name="formAddComment" method="POST" action="" autocomplete="off">
                                @csrf
                                <input type="hidden" name="share_id" value="{{ encryptId($shared->id) }}">
                                <div class="form-row mb-4">
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Your name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Your Email">
                                    </div>
                                </div>

                                <div class="form-row mb-4">
                                    <div class="form-group col-md-12">
                                        <label for="message">Message</label>
                                        <textarea name="message" id="message" cols="30" rows="5" class="form-control" placeholder="Type Your message here.." style="background-color: black;"></textarea>
                                    </div>
                                </div>
                                <div class="form-row mb-4">
                                    <div class="form-group col-md-12">
                                        <input type="checkbox" name="is_private" id="is_private" class="mr-1" value="1">
                                        <label for="is_private">Private Comment</label>
                                    </div>
                                </div>
                              <button type="submit" class="btn btn-primary ">Post Comment</button>
                            </form>
                        </div>
                    </div>






                    <div class="row">
                        <div class="col-12 mt-4 mb-5">
                            <h1 class="text-left">Comments</h1>

                            <div class="ParentDiv">

                            @forelse($comments as $comment)
                                <div class="maincomment" id="maincomment_{{$comment->id}}">
                                    @include('portal.share.singlecomment')
                                </div>
                                @empty
                                    <span class="col-12 floght-left text-danger">No Comments Yet</span>
                                @endforelse

                        </div>
                        </div>

                    </div>
                </div>
            </section>
        </div>


<!-- END -->


@include('portal.share.modal.modal')


@section('bottom_js')
@parent

<script language="javascript">



$(".ParentDiv").on('click', '#addreply', function(e) {

    $('#FormreplyComment')[0].reset();
    var id =$(this).data('id');
    $( '#comment_id' ).val(id);
    $( '#ModalreplyComment' ).modal( 'show' );

});

$('#FormreplyComment').on('submit', function(event){

event.preventDefault();
$('.inputTxtError').remove();

show_wait('update');
var formData = new FormData();
$.ajax( {
    url: "{{route('add_reply_comment')}}",
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
        $( '#ModalreplyComment' ).modal( 'hide' );
        $( "#maincomment_"+result.id ).html( result.render );

        swal({  icon: 'success',  title: '@lang("lang.done")!',text: '@lang("lang.comment_success_message")', button: '@lang("lang.okay")',});

    },
    error: function ( xhr, ajaxOptions, thrownError ) {
      swal.close();
      displayFieldErrors(xhr.responseJSON.errors,xhr.status);
    }
  } );

});

$('#formAddComment').on('submit', function(event){

    event.preventDefault();
    $('.inputTxtError').remove();

    show_wait('update');
    var formData = new FormData();
    $.ajax( {
        url: "{{route('add_commnent')}}",
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
            $("#formAddComment")[0].reset();

            $( ".ParentDiv" ).prepend( result.render );

            swal({  icon: 'success',  title: '@lang("lang.done")!',text: '@lang("lang.comment_success_message")', button: '@lang("lang.okay")',});


        },
        error: function ( xhr, ajaxOptions, thrownError ) {
          swal.close();
          displayFieldErrors(xhr.responseJSON.errors,xhr.status);
        }
      } );

    });

    </script>

@endsection
