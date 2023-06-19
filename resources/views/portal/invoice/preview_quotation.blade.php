
<div class="row invoice  layout-spacing layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

        <div class="doc-container">

            <div class="row">

                @include('portal.invoice.partial.invoicepreview')


                <div class="col-xl-3">

                    <div class="invoice-actions-btn">

                        <div class="invoice-action-btn">

                            <div class="row">
                                <div class="col-xl-12 col-md-3 col-sm-6">
                                    <a href="javascript:void(0);" class="btn btn-primary btn-print  action-print">Print</a>
                                    <a href="{{ route('download_invoice', $record->id) }}" class="btn btn-info btn-print  action-download">Download</a>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>


            </div>


        </div>

    </div>
</div>

@include('portal.invoice.script_preview')
