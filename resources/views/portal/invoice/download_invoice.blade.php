
  <table width="100%" >
    <tr>
        <td valign="top">


        </td>
        <td align="right">
            <h3 class="in-heading align-self-center">{{$record->name ?? '3 Studio Inc.'}}</h3>
            <pre>
                {{ $record->company_address }}
                {{ $record->company_email }}
                {{ $record->company_phone }}
            </pre>
        </td>
    </tr>

  </table>
  <hr>
  <table width="100%">
    <tr>
        <td>
            <h6 class=" inv-title">Invoice : <span class="inv-number">#{{ $record->invoice_number }}</span></h6>
            <p class="inv-created-date">
                <span class="inv-title" style="text-align: right">Invoice Date : </span>
                <span class="inv-date">{{ Carbon\Carbon::parse($record->invoice_date)->format('d M Y') }}</span></p>
            <p class="inv-due-date"><span class="inv-title" style="text-align: right">Due Date : &nbsp;&nbsp;&nbsp; </span> <span class="inv-date">{{ Carbon\Carbon::parse($record->due_date)->format('d M Y') }}</span></p>
        </td>

    </tr>

  </table>
  <hr>

  <table width="100%">
    <tr>
        <td>
            <h6 class=" inv-title">Invoice To:</h6>
            {{ $record->client_name }}<br>
            {{ $record->client_address }}<br>
            {{ $record->client_email }}<br>
            {{ $record->client_phone }}
        </td>
        <td style="float: right" ><h6 class=" inv-title">Payment Info:</h6>
            <span class=" inv-subtitle">Bank Name:</span> <span>{{ $record->bank->bank_name ?? '' }}</span> <br>
            <span class=" inv-subtitle">Account Number: </span> <span>{{ $record->bank->account_number ?? '' }}</span><br>
            <span class=" inv-subtitle">SWIFT code:</span> <span>{{ $record->bank->bank_code ?? '' }}</span><br>
            <span class=" inv-subtitle">Country: </span> <span>{{ $record->bank->bank_country ?? '' }}</span>
        </td>
    </tr>

  </table>

  <br/>

  <br><br>

  <div class="inv--product-table-section">
    <div class="table-responsive">
        <table class="table">
            <thead class="">
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Items</th>
                    <th class="text-right" scope="col">Qty</th>
                    <th class="text-right" scope="col">Price</th>
                    <th class="text-right" scope="col">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($record->items as $item)

                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $item->description }}</td>
                        <td class="text-right">{{ $item->quantity }}</td>
                        <td class="text-right">{{ $record->currency->symbol }}{{ number_format($record->unit_price, 2) }}</td>
                        <td class="text-right">{{ $record->currency->symbol }}{{ number_format($record->sub_total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"></td>
                    <td align="right">Sub Total: {{ $record->currency->symbol }}</td>
                    <td align="right">{{ number_format($record->sub_total, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td align="right">Tax Amount: {{ $record->currency->symbol }}</td>
                    <td align="right">{{ number_format($record->total_tax, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td align="right">Discount: {{ $record->currency->symbol }}</td>
                    <td align="right">{{ number_format($record->total_discount, 2) }}</td>
                </tr>

                <tr>
                    <td colspan="3"></td>
                    <td align="right">Grand Total {{ $record->currency->symbol }}</td>
                    <td align="right" >{{ number_format($record->grand_total, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<div class="inv--note">

    <div class="row mt-4">
        <div class="col-sm-12 col-12 order-sm-0 order-1">
            <p>Note: {{ $record->notes }}</p>
        </div>
    </div>

</div>
