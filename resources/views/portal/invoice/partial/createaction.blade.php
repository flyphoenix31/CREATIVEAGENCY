<div class="col-xl-3">

    <div class="invoice-actions">

        <div class="invoice-action-currency">

            <div class="form-group mb-0">
                <label for="currency">Currency</label>
                <div class="dropdown selectable-dropdown invoice-select">

                    <input type="hidden" id="currency_sign" value="$">
                    <input type="hidden" data-sign="" id="currency_id" name="currency_id" value="2">
                    <a id="currencyDropdown" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{asset('cork/img/flag-us.svg')}}" class="flag-width" alt="flag"> <span class="selectable-text">USD - US Dollar</span> <span class="selectable-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="currencyDropdown">

                        @foreach($countries as $country)
                            <a class="dropdown-item" data-id="{{$country->id}}" data-sign="{{$country->symbol}}" data-img-value="{{asset('cork/img/'.$country->img)}}" data-value="{{$country->code}}- {{$country->name}}" href="javascript:void(0);"><img src="{{asset('cork/img/'.$country->img)}}" class="flag-width" alt="flag">{{$country->code}} - {{$country->name}}</a>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>

        <div class="invoice-action-tax">

            <h5>Tax</h5>

            <div class="invoice-action-tax-fields">

                <div class="row">

                    <div class="col-6">

                        <div class="form-group mb-0">
                            <label for="type">Type</label>
                            <input type="hidden" name="tax_type" id="tax_type" value="">
                            <div class="dropdown selectable-dropdown invoice-tax-select">
                                <a id="currencyDropdown" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="selectable-text">None</span> <span class="selectable-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></span></a>
                                <div class="dropdown-menu" aria-labelledby="currencyDropdown">
                                    <a class="dropdown-item" data-value="Per Item" href="javascript:void(0);">Per Item</a>
                                    <a class="dropdown-item" data-value="On Total" href="javascript:void(0);">On Total</a>
                                    <a class="dropdown-item" data-value="None" href="javascript:void(0);">None</a>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-6">

                        <div class="form-group mb-0 tax-rate-per-item" style="display: none;">
                            <label for="tax_per_item">Rate (%)</label>
                            <input type="number" class="form-control input-rate" id="tax_per_item" name="tax_per_item" placeholder="Tax %" value="5">
                        </div>

                        <div class="form-group mb-0 tax-rate-on-total" style="display: none;">
                            <label for="tax_on_total">Rate (%)</label>
                            <input type="number" class="form-control input-rate" id="tax_on_total" name="tax_on_total" placeholder="Tax %" value="10">
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <div class="invoice-action-discount">

            <h5>Discount</h5>

            <div class="invoice-action-discount-fields">

                <div class="row">

                    <div class="col-6">
                        <div class="form-group mb-0">
                            <label for="type">Type</label>

                            <div class="dropdown selectable-dropdown invoice-discount-select">
                                <a id="currencyDropdown" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="selectable-text">None</span> <span class="selectable-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></span></a>
                                 <div class="dropdown-menu" aria-labelledby="currencyDropdown">
                                    <a class="dropdown-item" data-value="Percent" href="javascript:void(0);">Percent</a>
                                    <a class="dropdown-item" data-value="Flat Amount" href="javascript:void(0);">Flat Amount</a>
                                    <a class="dropdown-item" data-value="None" href="javascript:void(0);">None</a>
                                </div>
                            </div>
                            <input type="hidden" name="discount_type" id="discount_type" value="">
                        </div>

                    </div>

                    <div class="col-6">
                        <div class="form-group mb-0 discount-amount" style="display: none;">
                            <label for="discount_rate">Amount</label>
                            <input type="number" class="form-control input-rate" id="discount_rate" name="discount_rate" placeholder="Rate" value="25">
                        </div>

                        <div class="form-group mb-0 discount-percent" style="display: none;">
                            <label for="discount_percentage">Percent</label>
                            <input type="number" class="form-control input-rate" id="discount_percentage" name="discount_percentage" placeholder="Percentage" value="10">
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="invoice-actions-btn">

        <div class="invoice-action-btn">

            <div class="row">
                <div class="col-xl-12 col-md-4">
                    <button type="submit" class="btn btn-success btn-block btn-download">@lang('lang.save') As Draft</button>
                </div>
            </div>
        </div>

    </div>

</div>
