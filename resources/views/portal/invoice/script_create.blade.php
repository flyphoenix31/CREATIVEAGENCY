@section('bottom_js')
@parent

<script language="javascript">

function checkDiscount(type)
{
    var type = $('#discount_type').val();
    return type;
}

function checkTaxType(type)
{
    var type = $('#tax_type').val();
    return type;
}

$(".item-table").on("click", ".taxavial", function () {
    calculateGrandTotal();
});

$('#discount_rate, #discount_percentage, #tax_on_total, #tax_per_item').on('keyup', function(event){
    calculateGrandTotal();
});


/* $('input').on('input',function(i,v){
console.log("index of input is " + $(this).index())
console.log("name of input is " + $(this).attr('name'))


}) */


function calculateTax(type, subtotal)
{
    //var currency = '$$';
    var tax      = 0;
    var tax_amt  = 0;
    var stotal = 0;

    if (type == 'tax_per_item')
    {
        tax = parseFloat($('#tax_per_item').val());

        var items = $('input[name="unit_price[]"]');
        var count = items.length;

        for (i = 0; i < count; i++)
        {
            if($('#is_tax_avil_'+i).is(':checked'))
            {
               var unit_price = $('input[data-id=unit_price_'+i+']').val();
               var quantity = $('input[data-id=quantity_'+i+']').val();
               total = unit_price * quantity;
               stotal += total;
            }
        }

        tax_amt = (stotal / 100) * tax;
    }
    else if (type == 'tax_on_total')
    {
        tax = parseFloat($('#tax_on_total').val());

        tax_amt = (subtotal / 100) * tax;

    }

    subtotal = subtotal + tax_amt;

    $('#total_tax_amount').html( tax + '%');

    return tax_amt;
}

function calculateDiscount(type, subtotal)
{
    var currency = '$';
    var discount = 0;

    if (type == 'discount_rate')
    {
        //flat rate calculation
        var discount = parseFloat($('#discount_rate').val());
        var html = '<div class="total-amount"><span class="currency_symbol">'+currency+'</span><span id="total_discount">'+discount+'</span></div>';

    }
    else if (type == 'discount_percentage')
    {
        disval = $('#discount_percentage').val();
        var html = '<div class="total-amount"><span id="total_discount">'+disval+'</span><span class="currency">%</span></div>';

        discount = ( subtotal * (disval/100) ) ;
    }
    else
    {
        //without discount
    }

    $('.total_discount_div').html( html );

    return discount;
}


    function calculateGrandTotal()
    {
        var type = checkDiscount();

        var tax_type = checkTaxType();

        var subtotal = 0;

        var grandTotal = 0;

        $('.unit_price').each(function(i, obj)
        {
            var unit_price = $('input[data-id=unit_price_'+i+']').val();
            var quantity = $('input[data-id=quantity_'+i+']').val();
            total = unit_price * quantity;
            subtotal += total;
        });

        var taxamt = calculateTax(tax_type,subtotal);

        $('#sub_total').html(parseFloat(subtotal ).toFixed(2) );

        subtotal = taxamt + subtotal;
        discount = calculateDiscount(type,subtotal);

        grandTotal = (subtotal - discount);

        $('#grand_total').html(parseFloat(grandTotal ).toFixed(2) );

    }

function calculatesubtotal(target)
{
    var unit_price = $('input[data-id=unit_price_'+target+']').val();
    var quantity = $('input[data-id=quantity_'+target+']').val();

    $('.item_total_'+target).html(  (unit_price * quantity).toFixed(2));

    calculateGrandTotal();
}

jQuery(document).ready(function($) {

$('#formadd').on('submit', function(event){

    event.preventDefault();
    $('.inputTxtError').remove();
    show_wait('update');
    var formData = new FormData();
    $.ajax( {
        url: "{{route('store_invoice')}}",
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        data:new FormData(this),
        cache : false,
        processData: false,
        success: function ( response ) {

            swal.close();
            if (response.success ==true)
            {
                swal( '@lang("lang.done")', '@lang("lang.record_added_success_msg")', "success" );

                window.location.replace(response.url);
            }
            else
            {
                swal( '@lang("lang.error")', '@lang("lang.invoice_not_updated")', "error" );
            }

        },
        error: function ( xhr, ajaxOptions, thrownError ) {
          swal.close();
          displayFieldErrors(xhr.responseJSON.errors,xhr.status);
        }
      } );
  });

});


</script>
@endsection
