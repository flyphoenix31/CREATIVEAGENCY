
@section('bottom_js')
@parent


<script src="http://localhost/js/htmlpdf.js"></script>


<script language="javascript">

function generatePDF() {
        // Choose the element that our invoice is rendered in.
        const element = document.getElementById("cd");
        // Choose the element and save the PDF for our user.
        html2pdf()
          .set({ html2canvas: { scale: 4 } })
          .from(element)
          .save();
      }


      $( ".action-printj" ).click(function() {
        generatePDF();
    });

</script>


@endsection
