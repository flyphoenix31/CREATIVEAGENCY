<div class="page-header">
    <nav class="breadcrumb-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Apps</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Invoice</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="javascript:void(0);">New</a></li>
        </ol>
    </nav>
</div>

<form class="form-sample  text-capitalize" name="formadd" id="formadd" action="" method="post" autocomplete="off" >

    @csrf

<div class="row invoice layout-spacing  layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="doc-container">

    <div class="row">
        <div class="col-xl-9">

            <div class="invoice-content">



                <div class="invoice-detail-body">

                    <div class="invoice-detail-title">

                        <div class="invoice-logo">
                            <div class="upload">
                                <input type="file" id="input-file-max-fs" name="invoice_logo" class="dropify" data-default-file="{{$setting->image}}" data-max-file-size="2M" />
                            </div>
                        </div>

                        <div class="invoice-title">
                            <input type="text" class="form-control" name="name" placeholder="Invoice Label" value="3 Studio Inc.">
                        </div>

                    </div>

                    <div class="invoice-detail-header">

                        <div class="row justify-content-between">
                            <div class="col-xl-5 invoice-address-company">

                                <h4>From:-</h4>

                                <div class="invoice-address-company-fields">

                                    <div class="form-group row">
                                        <label for="company_name" class="col-sm-3 col-form-label col-form-label-sm">Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control form-control-sm" id="company_name" name="company_name" placeholder="Business Name" value="">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="company_email" class="col-sm-3 col-form-label col-form-label-sm">Email</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control form-control-sm" id="company_email" name="company_email" placeholder="name@company.com" value="">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="company_address" class="col-sm-3 col-form-label col-form-label-sm">Address</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control form-control-sm" id="company_address" name="company_address" placeholder="XYZ Street" value="">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="company_phone" class="col-sm-3 col-form-label col-form-label-sm">Phone</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control form-control-sm" id="company_phone" name="company_phone" placeholder="(123) 456 789" value="">
                                        </div>
                                    </div>

                                </div>

                            </div>


                            <div class="col-xl-5 invoice-address-client">

                                <h4>Bill To:-</h4>

                                <div class="invoice-address-client-fields">

                                    <div class="form-group row">
                                        <label for="client_name" class="col-sm-3 col-form-label col-form-label-sm">Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control form-control-sm" id="client_name" name="client_name" placeholder="Client Name" value="">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="client_email" class="col-sm-3 col-form-label col-form-label-sm">Email</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control form-control-sm" id="client_email" name="client_email" placeholder="name@company.com" value="">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="client_address" class="col-sm-3 col-form-label col-form-label-sm">Address</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control form-control-sm" id="client_address" name="client_address" placeholder="XYZ Street" value="">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="client_phone" class="col-sm-3 col-form-label col-form-label-sm">Phone</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control form-control-sm" id="client_phone" name="client_phone" placeholder="(123) 456 789" value="">
                                        </div>
                                    </div>

                                </div>

                            </div>


                        </div>

                    </div>

                    <div class="invoice-detail-terms">

                        <div class="row justify-content-between">

                            <div class="col-md-3">

                                <div class="form-group mb-4">
                                    <label for="invoice_number">Invoice Number</label>
                                    <input type="text" class="form-control form-control-sm" id="invoice_number" name="invoice_number" placeholder="#0001" value="">
                                </div>

                            </div>

                            <div class="col-md-3">

                                <div class="form-group mb-4">
                                    <label for="invoice_date">Invoice Date</label>
                                    <input type="text" class="form-control form-control-sm" id="invoice_date" name="invoice_date" placeholder="Add date picker">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group mb-4">
                                    <label for="due_date">Due Date</label>
                                    <input type="text" class="form-control form-control-sm" id="due_date" name="due_date" placeholder="None">
                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="invoice-detail-items">

                        <div class="table-responsive">
                            <table class="table table-bordered item-table">
                                <thead>
                                    <tr>
                                        <th class=""></th>
                                        <th>Description</th>
                                        <th class="">Rate</th>
                                        <th class="">Qty</th>
                                        <th class="text-right">Amount</th>
                                        <th class="text-center">Tax</th>
                                    </tr>
                                </thead>
                                <tbody id="childtypetr">
                                </tbody>
                            </table>
                        </div>

                        <button type="button" class="btn btn-secondary additem btn-sm">Add Item</button>

                    </div>


                    <div class="invoice-detail-total">

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group row invoice-created-by">
                                    <label for="account_number" class="col-sm-3 col-form-label col-form-label-sm">Account #:</label>
                                    <div class="col-sm-9">
                                        {{$setting->account_number}}
                                    </div>
                                </div>

                                <div class="form-group row invoice-created-by">
                                    <label for="bank_name" class="col-sm-3 col-form-label col-form-label-sm">Bank Name:</label>
                                    <div class="col-sm-9">
                                        {{$setting->bank_name}}
                                    </div>
                                </div>

                                <div class="form-group row invoice-created-by">
                                    <label for="bank_code" class="col-sm-3 col-form-label col-form-label-sm">SWIFT code:</label>
                                    <div class="col-sm-9">
                                        {{$setting->bank_code}}
                                    </div>
                                </div>

                                <div class="form-group row invoice-created-by">
                                    <label for="bank_country" class="col-sm-3 col-form-label col-form-label-sm">Country:</label>
                                    <div class="col-sm-9">
                                        {{$setting->bank_country}}
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="totals-row">
                                    <div class="invoice-totals-row invoice-summary-subtotal">

                                        <div class="invoice-summary-label">Subtotal</div>

                                        <div class="invoice-summary-value">
                                            <div class="subtotal-amount">
                                                <span class="currency_symbol">$</span><span class="sub_total" id="sub_total">0.00</span>
                                            </div>
                                        </div>

                                    </div>



                                    <div class="invoice-totals-row invoice-summary-total">

                                        <div class="invoice-summary-label">Discount</div>

                                        <div class="invoice-summary-value total_discount_div">

                                        </div>

                                    </div>

                                    <div class="invoice-totals-row invoice-summary-tax">

                                        <div class="invoice-summary-label">Tax</div>

                                        <div class="invoice-summary-value">
                                            <div class="tax-amount">
                                                <span id="total_tax_amount">0%</span>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="invoice-totals-row invoice-summary-balance-due">

                                        <div class="invoice-summary-label">Total</div>

                                        <div class="invoice-summary-value">
                                            <div class="balance-due-amount">
                                                <span class="currency_symbol">$</span>
                                                <span id="grand_total">0.00</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="invoice-detail-note">

                        <div class="row">

                            <div class="col-md-12 align-self-center">

                                <div class="form-group row invoice-note">
                                    <label for="notes" class="col-sm-12 col-form-label col-form-label-sm">Notes:</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" id="notes" name="notes" placeholder='Notes - For example, "Thank you for doing business with us"' style="height: 88px;">Thank you for doing business with us.</textarea>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>


                </div>

            </div>

        </div>

        @include('portal.invoice.partial.createaction');

    </div>

    </div>
    </div>
</div>
</form>


@include('portal.invoice.script_create')
