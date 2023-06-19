<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Invoice\Invoice;
use App\Models\Invoice\Items;
use App\Models\Invoice\Bank;
use App\Traits\FileUploadTrait;

class InvoiceRepository
{
    use FileUploadTrait;

    public $invoice;

    public function PaginateRecordsWithFilter($request)
    {
    	$records = Invoice::with('status','user')->Filter($request);

    	$records = $records->latest()->paginate(\config('pm.cmspagination'));
    	return $records;
    }

    public function getLatestInvoices($item = 10)
    {
    	$records = Invoice::with('status','user');

    	$records = $records->latest()->limit($item)->get();
    	return $records;
    }

    public function findRecord($id)
    {
        $this->invoice = Invoice::with('status', 'items', 'bank', 'currency')->IsID($id)->first();
        return $this;
    }

    public function getRecord()
    {
        return $this->invoice;

        return Invoice::with('status', 'items', 'bank', 'user', 'currency')->IsID($id)->first();
    }

    public function changeToViewed()
    {
        //$record = $this->invoice;
        $this->invoice->status_id = 3;
        $this->invoice->save();

        return $this;
    }

    public function updateRecord($request)
    {
        $id = decryptId($request->id);
        $addtax    =  FALSE;
        $taxamount = 0;
        $hastax    = NULL;
        $taxcal    = 0;
        $taxvalue  = 0;

        $model = new Invoice();

        $insdata = $request->only($model->getFillable());

        $invoice = Invoice::find($id);

        if (!$invoice)
        {
            return FALSE;
        }

        $invoice->update($insdata);

        if($request->hasFile('invoice_logo') )
        {
            $this->saveFile($invoice, 'invoice_logo', 'invoice');
        }


        if ($request->discount_type == 'discount_rate')
        {
            $invoice->discount_type_id = 1;
            $invoice->discount_value   = $request->discount_rate;
        }
        else if($request->discount_type == 'discount_percentage')
        {
            $invoice->discount_type_id = 2;
            $invoice->discount_value   = $request->discount_percentage;
        }

        if ($request->tax_type == 'tax_per_item')
        {
            $addtax    = TRUE;
            $invoice->tax_type_id = 1;
            $taxvalue = $request->tax_per_item;
        }
        else if($request->tax_type == 'tax_on_total')
        {
            $addtax    = TRUE;
            $invoice->tax_type_id = 2;
            $taxvalue  = $request->tax_on_total;
        }

        $invoice->tax_value = $taxvalue;

        //update Invoice Items

        $count = count($request->unit_price);

        $grandtotal = 0;

        Items::where('invoice_id', $invoice->id)->delete();

        for($i=0;$i<$count;$i++)
        {
            $hastax    = NULL;
            $unitprice = $request->unit_price[$i];
            $quantity  = $request->quantity[$i];
            $sub_total = $unitprice * $quantity;

            if ($addtax)
            {
                if (!empty($request->is_tax_avil[$i]))
                {
                    $hastax = $request->is_tax_avil[$i];

                    $hastax = 1;

                    $txamt = ($sub_total / 100 ) * $taxvalue ;

                    $taxcal = $taxcal + $txamt;
                }
            }

            //Add tax calculation

            $insdata = [
                'invoice_id'  => $invoice->id,
                'description' => $request->description[$i],
                'item_notes'  => $request->item_notes[$i],
                'unit_price'  => $unitprice,
                'quantity'    => $quantity,
                'sub_total'   => $sub_total,
                'has_tax'     => $hastax,
            ];

            $grandtotal = $grandtotal + $sub_total;

            Items::create($insdata);

        }

        $finaltax = 0;
        //Grand total with tax
        if ($request->tax_type == 'tax_per_item')
        {
            $finaltax = $taxcal;
        }
        else if($request->tax_type == 'tax_on_total')
        {
            $finaltax = ($grandtotal / 100 ) * $taxvalue;
        }

        $invoice->total_tax = $finaltax;

        //Add discount
        $total_discount = $this->calculateDiscount($grandtotal, $request->discount_type, $invoice->discount_value);

        $invoice->total_discount = $total_discount;
        $invoice->sub_total      = $grandtotal;
        $grandtotal = $finaltax + $grandtotal;
        $invoice->grand_total    = ( $taxamount + $grandtotal ) - $total_discount;
        $invoice->save();

        //Update Bank Details

        //$insdata = $request->only('account_number','bank_name','bank_code','bank_country');

        $record = \DB::table('settings')->select('account_number','bank_name','bank_code','bank_country')->where('id', 1)->first();

        $insbank['account_number'] = $record->account_number;
        $insbank['bank_name']      = $record->bank_name;
        $insbank['bank_code']      = $record->bank_code;
        $insbank['bank_country']   = $record->bank_country;

        Bank::where('invoice_id', $id)->update($insbank);

        return TRUE;

    }

    public function storeRecord($request)
    {
        $addtax    =  FALSE;
        $taxamount = 0;
        $hastax    = NULL;
        $taxcal    = 0;
        $taxvalue  = 0;

        $model = new Invoice();

        $insdata = $request->only($model->getFillable());

        $invoice = Invoice::create($insdata);

        $invoice->user_id = \Auth::id();

        if($request->hasFile('invoice_logo') )
        {
            $this->saveFile($invoice, 'invoice_logo', 'invoice');
        }


        if ($request->discount_type == 'discount_rate')
        {
            $invoice->discount_type_id = 1;
            $invoice->discount_value   = $request->discount_rate;
        }
        else if($request->discount_type == 'discount_percentage')
        {
            $invoice->discount_type_id = 2;
            $invoice->discount_value   = $request->discount_percentage;
        }

        if ($request->tax_type == 'tax_per_item')
        {
            $addtax    = TRUE;
            $invoice->tax_type_id = 1;

            $taxvalue = $request->tax_per_item;
        }
        else if($request->tax_type == 'tax_on_total')
        {
            $addtax    = TRUE;
            $invoice->tax_type_id = 2;

            $taxvalue  = $request->tax_on_total;
        }

        $invoice->tax_value = $taxvalue;

        //update Invoice Items

        $count = count($request->unit_price);

        $grandtotal = 0;

        for($i=0;$i<$count;$i++)
        {
            $hastax    = NULL;
            $unitprice = $request->unit_price[$i];
            $quantity  = $request->quantity[$i];
            $sub_total = $unitprice * $quantity;

            if ($addtax)
            {
                if (!empty($request->is_tax_avil[$i]))
                {
                    $hastax = $request->is_tax_avil[$i];

                    $hastax = 1;

                    $txamt = ($sub_total / 100 ) * $taxvalue ;

                    $taxcal = $taxcal + $txamt;
                }
            }

            //Add tax calculation

            $insdata = [
                'invoice_id'  => $invoice->id,
                'description' => $request->description[$i],
                'item_notes'  => $request->item_notes[$i],
                'unit_price'  => $unitprice,
                'quantity'    => $quantity,
                'sub_total'   => $sub_total,
                'has_tax'     => $hastax,
            ];

            $grandtotal = $grandtotal + $sub_total;

            Items::create($insdata);

        }

        $finaltax = 0;
        //Grand total with tax
        if ($request->tax_type == 'tax_per_item')
        {
            $finaltax = $taxcal;
        }
        else if($request->tax_type == 'tax_on_total')
        {
            $finaltax = ($grandtotal / 100 ) * $taxvalue;
        }

        $invoice->total_tax = $finaltax;

        //Add discount
        $total_discount = $this->calculateDiscount($grandtotal, $request->discount_type, $invoice->discount_value);

        $invoice->total_discount = $total_discount;
        $invoice->sub_total      = $grandtotal;
        $grandtotal = $finaltax + $grandtotal;
        $invoice->grand_total    = ( $taxamount + $grandtotal ) - $total_discount;
        $invoice->status_id      = 1;
        $invoice->save();

        //Update Bank Details

        //$insdata = $request->only('account_number','bank_name','bank_code','bank_country');

        $record = \DB::table('settings')->select('account_number','bank_name','bank_code','bank_country')->where('id', 1)->first();

        $insdata['invoice_id']     = $invoice->id;
        $insdata['account_number'] = $record->account_number;
        $insdata['bank_name']      = $record->bank_name;
        $insdata['bank_code']      = $record->bank_code;
        $insdata['bank_country']   = $record->bank_country;

        Bank::create($insdata);


        addUserActivity('Invoice',  'Created a New Invoice');

        return $invoice->id;

    }

    public function deleteRecord($id)
    {
        Invoice::destroy($id);

        addUserActivity('Invoice',  'Deleted a Invoice');
    }



    private function calculateDiscount($grandtotal, $type, $value)
    {
        $discount = 0;

        if ($type == 'discount_rate')
        {
            $discount = $value;
        }
        else if($type == 'discount_percentage')
        {
            $discount = ( $grandtotal * ( $value /100 ) );
        }

        return $discount;
    }






}
