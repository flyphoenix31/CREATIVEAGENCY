<div class="col-xl-3">

    <div class="invoice-actions">

        <div class="invoice-action-currency">

            <div class="form-group mb-0">
                <label for="currency">Currency</label>
                <div class="dropdown selectable-dropdown invoice-select">


                    <input type="hidden" id="currency_sign" value="{{$record->currency->symbol}}">
                    <input type="hidden" data-sign="" id="currency_id" name="currency_id" value="{{$record->currency->id}}">


                    <a id="currencyDropdown" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{asset('cork/img/'.$record->currency->img)}}" class="flag-width" alt="flag" data-sign="{{$record->currency->symbol}}"> <span class="selectable-text">{{$record->currency->code}} - {{$record->currency->name}}</span>

                    <span class="selectable-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></span></a>




                    {{-- <a id="currencyDropdown" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{asset('cork/img/flag-us.svg')}}" class="flag-width" alt="flag"> <span class="selectable-text">USD - US Dollar</span> <span class="selectable-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></span></a> --}}


                    <div class="dropdown-menu" aria-labelledby="currencyDropdown">
                        {{-- <a class="dropdown-item" data-img-value="{{asset('cork/img/flag-us.svg')}}" data-value="USD - US Dollar" href="javascript:void(0);"><img src="{{asset('cork/img/flag-us.svg')}}" class="flag-width" alt="flag"> USD - US Dollar</a>
                        <a class="dropdown-item" data-img-value="{{asset('cork/img/flag-gbp.svg')}}" data-value="GBP - British Pound" href="javascript:void(0);"><img src="{{asset('cork/img/flag-gbp.svg')}}" class="flag-width" alt="flag"> GBP - British Pound</a>
                        <a class="dropdown-item" data-img-value="{{asset('cork/img/flag-inr.svg')}}" data-value="INR - Indian Rupee" href="javascript:void(0);"><img src="{{asset('cork/img/flag-inr.svg')}}" class="flag-width" alt="flag"> INR - Indian Rupee</a>
                        <a class="dropdown-item" data-img-value="{{asset('cork/img/flag-de.svg')}}" data-value="EUR - Germany (Euro)" href="javascript:void(0);"><img src="{{asset('cork/img/flag-de.svg')}}" class="flag-width" alt="flag"> EUR - Germany (Euro)</a> --}}

                        @foreach($countries as $country)
                        <a class="dropdown-item" data-sign="{{$country->symbol}}" data-id="{{$country->id}}" data-img-value="{{asset('cork/img/'.$country->img)}}" data-value="{{$country->code}}- {{$country->name}}" href="javascript:void(0);"><img src="{{asset('cork/img/'.$country->img)}}" class="flag-width" alt="flag">{{$country->code}} {{$country->name}}</a>
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

                        @if($record->tax_type_id == 1)
                            @php
                                $tax_type        = 'Per Item';
                                $tax_ontotal     = 'none';
                                $tax_flat        = 'block';
                                $tax_hidden_type = 'tax_per_item';
                            @endphp
                        @elseif($record->tax_type_id == 2)
                            @php
                                $tax_type        = 'On Total';
                                $tax_ontotal     = 'block';
                                $tax_flat        = 'none';
                                $tax_hidden_type = 'tax_on_total';
                            @endphp
                        @else
                            @php
                                $tax_type        = 'None';
                                $tax_ontotal     = 'none';
                                $tax_flat        = 'none';
                                $tax_hidden_type = '';
                            @endphp
                        @endif

                        <div class="form-group mb-0">
                            <label for="type">Type</label>
                            <input type="hidden" name="tax_type" id="tax_type" value="{{$tax_hidden_type}}">
                            <div class="dropdown selectable-dropdown invoice-tax-select">
                                <a id="currencyDropdown" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="selectable-text">{{$tax_type}}</span> <span class="selectable-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></span></a>
                                <div class="dropdown-menu" aria-labelledby="currencyDropdown">
                                    <a class="dropdown-item" data-value="Per Item" href="javascript:void(0);">Per Item</a>
                                    <a class="dropdown-item" data-value="On Total" href="javascript:void(0);">On Total</a>
                                    <a class="dropdown-item" data-value="None" href="javascript:void(0);">None</a>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-6">

                        <div class="form-group mb-0 tax-rate-per-item" style="display: {{$tax_flat}};">
                            <label for="tax_per_item">Rate (%)</label>
                            <input type="number" class="form-control input-rate" id="tax_per_item" name="tax_per_item" placeholder="Tax %" value="{{$record->tax_value}}">
                        </div>

                        <div class="form-group mb-0 tax-rate-on-total" style="display: {{$tax_ontotal}};">
                            <label for="tax_on_total">Rate (%)</label>
                            <input type="number" class="form-control input-rate" id="tax_on_total" name="tax_on_total" placeholder="Tax %" value="{{$record->tax_value}}">
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

                            @if($record->discount_type_id == 1)
                                @php
                                    $discount_type       = 'Percent';
                                    $discount_percentage = 'block';
                                    $discount_flat       = 'none';
                                    $discout_hidden_type = 'discount_percentage';
                                @endphp
                            @elseif($record->discount_type_id == 2)
                                @php
                                    $discount_type       = 'Flat Amount';
                                    $discount_percentage = 'none';
                                    $discount_flat       = 'block';
                                    $discout_hidden_type = 'discount_rate';
                                @endphp
                            @else
                                @php
                                    $discount_type = 'None';
                                    $discount_percentage = 'none';
                                    $discount_flat       = 'none';
                                    $discout_hidden_type = '';
                                @endphp
                            @endif

                            <div class="dropdown selectable-dropdown invoice-discount-select">
                                <a id="currencyDropdown" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="selectable-text">{{$discount_type}}</span> <span class="selectable-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></span></a>
                                 <div class="dropdown-menu" aria-labelledby="currencyDropdown">
                                    <a class="dropdown-item" data-value="Percent" href="javascript:void(0);">Percent</a>
                                    <a class="dropdown-item" data-value="Flat Amount" href="javascript:void(0);">Flat Amount</a>
                                    <a class="dropdown-item" data-value="None" href="javascript:void(0);">None</a>
                                </div>
                            </div>
                            <input type="hidden" name="discount_type" id="discount_type" value="{{$discout_hidden_type}}">
                        </div>

                    </div>

                    <div class="col-6">
                        <div class="form-group mb-0 discount-amount" style="display: {{$discount_flat}};">
                            <label for="discount_rate">Amount</label>
                            <input type="number" class="form-control input-rate" id="discount_rate" name="discount_rate" placeholder="Rate" value="25">
                        </div>

                        <div class="form-group mb-0 discount-percent" style="display: {{$discount_percentage}};">
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
                    <button type="submit" class="btn btn-success btn-block btn-download">@lang('lang.save')</button>
                </div>
            </div>
        </div>

    </div>

</div>
