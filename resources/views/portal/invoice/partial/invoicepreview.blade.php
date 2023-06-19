

<div class="col-xl-9">

                    <div class="invoice-container">
                        <div class="invoice-inbox">

                            <div id="ct" class="">

                                <div class="invoice-00001">
                                    <div class="content-section">

                                        <div class="inv--head-section inv--detail-section">

                                            <div class="row">

                                                <div class="col-sm-6 col-12 mr-auto">
                                                    <div class="d-flex">

                                                         <img class="company-logo" src="{{$record->thumb}}">

                                                        <h3 class="in-heading align-self-center">{{$record->name ?? '3 Studio Inc.'}} </h3>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6 text-sm-right">
                                                    <p class="inv-list-number"><span class="inv-title">Invoice : </span> <span class="inv-number">#{{ $record->invoice_number }}</span></p>
                                                </div>

                                                <div class="col-sm-6 align-self-center mt-3">
                                                    <p class="inv-street-addr">{{ $record->company_address }}</p>
                                                    <p class="inv-email-address">{{ $record->company_email }}</p>
                                                    <p class="inv-email-address">{{ $record->company_phone }}</p>
                                                </div>
                                                <div class="col-sm-6 align-self-center mt-3 text-sm-right">
                                                    <p class="inv-created-date"><span class="inv-title">Invoice Date : </span> <span class="inv-date">{{ Carbon\Carbon::parse($record->invoice_date)->format('d M Y') }}</span></p>
                                                    <p class="inv-due-date"><span class="inv-title">Due Date : </span> <span class="inv-date">{{ Carbon\Carbon::parse($record->due_date)->format('d M Y') }}</span></p>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="inv--detail-section inv--customer-detail-section">

                                            <div class="row">

                                                <div class="col-xl-8 col-lg-7 col-md-6 col-sm-4 align-self-center">
                                                    <p class="inv-to">Invoice To</p>
                                                </div>

                                                <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8 align-self-center order-sm-0 order-1 inv--payment-info">
                                                    <h6 class=" inv-title">Payment Info:</h6>
                                                </div>

                                                <div class="col-xl-8 col-lg-7 col-md-6 col-sm-4">
                                                    <p class="inv-customer-name">{{ $record->client_name }}</p>
                                                    <p class="inv-street-addr">{{ $record->client_address }}</p>
                                                    <p class="inv-email-address">{{ $record->client_email }}</p>
                                                    <p class="inv-email-address">{{ $record->client_phone }}</p>
                                                </div>

                                                <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8 col-12 order-sm-0 order-1">
                                                    <div class="inv--payment-info">
                                                        <p><span class=" inv-subtitle">Bank Name:</span> <span>{{ $record->bank->bank_name ?? '' }}</span></p>
                                                        <p><span class=" inv-subtitle">Account Number: </span> <span>{{ $record->bank->account_number ?? '' }}</span></p>
                                                        <p><span class=" inv-subtitle">SWIFT code:</span> <span>{{ $record->bank->bank_code ?? '' }}</span></p>
                                                        <p><span class=" inv-subtitle">Country: </span> <span>{{ $record->bank->bank_country ?? '' }}</span></p>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>

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
                                                                <td class="text-right">{{ $record->currency->symbol }}{{ $item->unit_price }}</td>
                                                                <td class="text-right">{{ $record->currency->symbol }}{{ $item->sub_total }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="inv--total-amounts">

                                            <div class="row mt-4">
                                                <div class="col-sm-5 col-12 order-sm-0 order-1">
                                                </div>
                                                <div class="col-sm-7 col-12 order-sm-1 order-0">
                                                    <div class="text-sm-right">
                                                        <div class="row">
                                                            <div class="col-sm-8 col-7">
                                                                <p class="">Sub Total: </p>
                                                            </div>
                                                            <div class="col-sm-4 col-5">
                                                                <p class="">{{ $record->currency->symbol }}{{ $record->sub_total }}</p>
                                                            </div>
                                                            <div class="col-sm-8 col-7">
                                                                <p class="">Tax Amount: </p>
                                                            </div>
                                                            <div class="col-sm-4 col-5">
                                                                <p class="">{{ $record->currency->symbol }}{{ $record->total_tax }}</p>
                                                            </div>
                                                            <div class="col-sm-8 col-7">
                                                                <p class=" discount-rate">Discount :
                                                                    @if($record->discount_type_id == 2)
                                                                        <span class="discount-percentage">{{ $record->discount_value }}%</span>
                                                                    @endif
                                                                </p>
                                                            </div>
                                                            <div class="col-sm-4 col-5">
                                                                <p class="">{{ $record->currency->symbol }}{{ $record->total_discount }}</p>
                                                            </div>
                                                            <div class="col-sm-8 col-7 grand-total-title">
                                                                <h4 class="">Grand Total : </h4>
                                                            </div>
                                                            <div class="col-sm-4 col-5 grand-total-amount">
                                                                <h4 class="">{{ $record->currency->symbol }}{{ $record->grand_total }}</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="inv--note">

                                            <div class="row mt-4">
                                                <div class="col-sm-12 col-12 order-sm-0 order-1">
                                                    <p>Note: {{ $record->notes }}</p>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </div>


                        </div>

                    </div>

                </div>
                <div id="editor"></div>
