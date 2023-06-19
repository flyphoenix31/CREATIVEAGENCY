
            <div class="layout-px-spacing mt-15">


                <div class="row layout-top-spacing ">

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 layout-spacing">
                        <div class="widget widget-card-four">
                            <div class="widget-content">
                                <div class="w-content">
                                    <div class="w-info">
                                        <h6 class="value">{{$portfolio}}</h6>
                                        <p class="">Portfolio</p>
                                    </div>
                                    <div class="">
                                        <div class="w-icon">
                                            <i data-feather="command"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 layout-spacing">
                        <div class="widget widget-card-four">
                            <div class="widget-content">
                                <div class="w-content">
                                    <div class="w-info">
                                        <h6 class="value">{{$new_request}}</h6>
                                        <p class="">New Enquiry</p>
                                    </div>
                                    <div class="">
                                        <div class="w-icon">
                                            <i data-feather="arrow-down-left"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 layout-spacing">
                        <div class="widget widget-card-four ">
                            <div class="widget-content">
                                <div class="w-content">
                                    <div class="w-info">
                                        <h6 class="value">{{$new_contacts}}</h6>
                                        <p class="">Contacts</p>
                                    </div>
                                    <div class="">
                                        <div class="w-icon">
                                            <i data-feather="users"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>



                <div class="row sales">








                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-two">

                            <div class="widget-heading">
                                <h5 class="">Recent Invoices</h5>
                            </div>

                            <div class="widget-content">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><div class="th-content">@lang('lang.invoice_number')</div></th>
                                                <th><div class="th-content">@lang('lang.date')</div></th>
                                                <th><div class="th-content">@lang('lang.due_date')</div></th>
                                                <th><div class="th-content th-heading">@lang('lang.amount')</div></th>
                                                <th><div class="th-content">@lang('lang.status')</div></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($latest_invoices as $invoice)
                                                <tr>
                                                    <td>
                                                        <div class="td-content customer-name"><a href="{{route('edit_invoice', encryptId($invoice->id))}}"><span  class="text-success inv-number">#{{ $invoice->invoice_number }}</span></a></div>
                                                    </td>
                                                    <td>
                                                        <div class="td-content product-brand">{{ Carbon\Carbon::parse($invoice->invoice_date)->format('d M Y') }}</div>
                                                    </td>
                                                    <td>
                                                        <div class="td-content">{{ Carbon\Carbon::parse($invoice->due_date)->format('d M Y') }}</div>
                                                    </td>
                                                    <td>
                                                        <div class="td-content pricing"><span class="">${{ number_format($invoice->grand_total, 2) }}</span></div>
                                                    </td>
                                                    <td>
                                                        <div class="td-content">
                                                        <span class="badge badge-{{ $invoice->status->color  ?? 'dark'}} inv-status">{{ $invoice->status->display_name  ?? 'unknown'}}</span>
                                                    </div></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>





                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-two">

                            <div class="widget-heading">
                                <h5 class="">Recent Quotaions</h5>
                            </div>

                            <div class="widget-content">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><div class="th-content">@lang('lang.created')</div></th>
                                                <th><div class="th-content">@lang('lang.invoice')</div></th>
                                                <th><div class="th-content">@lang('lang.email')</div></th>
                                                <th><div class="th-content th-heading">@lang('lang.viewed')</div></th>
                                                <th><div class="th-content">@lang('lang.status')</div></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($latest_quotations as $quotation)
                                                <tr>
                                                    <td>
                                                        <div class="td-content">{{ $quotation->updated_at->format('M d Y') }}</div>
                                                    </td>
                                                    <td>
                                                        <div class="td-content customer-name"><a href="{{route('edit_invoice', encryptId($invoice->id))}}"><span  class="text-success inv-number">#{{ $invoice->invoice_number }}</span></a></div>
                                                    </td>
                                                    <td>
                                                        <div class="td-content pricing"><span class="">{{$quotation->to_email}}</span></div>
                                                    </td>
                                                    <td>
                                                        <div class="td-content pricing"><span class="">{{ $quotation->view_count }}</span></div>
                                                    </td>
                                                    <td>
                                                        <div class="td-content">
                                                            @if($quotation->status_id == 1 )
                                                                <label class='badge badge-success'>Active</label>
                                                            @else
                                                                <label class='badge badge-dark'>Inactive</label>
                                                            @endif
                                                    </div></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>








                </div>



            </div>

