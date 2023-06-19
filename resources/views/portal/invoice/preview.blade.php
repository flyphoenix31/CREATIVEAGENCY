
<div class="row invoice  layout-spacing layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

        <div class="doc-container">

            <div class="row">

                @include('portal.invoice.partial.invoicepreview')


                <div class="col-xl-3">

                    <div class="invoice-actions-btn">

                        <div class="invoice-action-btn">

                            <div class="row">
                                @can('email_invoice')
                                    <div class="col-xl-12 col-md-3 col-sm-6">
                                        <a href="javascript:void(0);" data-id="{{$record->id}}" data-email="{{$record->client_email}}" class="sendmail btn btn-primary btn-send">Send Invoice</a>
                                    </div>
                                @endcan
                                <div class="col-xl-12 col-md-3 col-sm-6">
                                    <a href="javascript:void(0);" class="btn btn-secondary btn-print  action-print">Print</a>
                                </div>

                                <div class="col-xl-12 col-md-3 col-sm-6">
                                    <a href="{{ route('download_invoice', $record->id) }}" class="btn btn-info btn-print  action-download">Download</a>
                                </div>

                                @can('edit_invoice')
                                    <div class="col-xl-12 col-md-3 col-sm-6">
                                        <a href="{{route('edit_invoice', encryptId($record->id))}}" class="btn btn-dark btn-edit">Edit</a>
                                    </div>
                                @endcan
                            </div>
                        </div>

                    </div>

                </div>


            </div>


        </div>

    </div>
</div>


<section class="pm_modal">
    @include('portal.invoice.modal.modal')
</section>

@include('portal.invoice.script_preview')
