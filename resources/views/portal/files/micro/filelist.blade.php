
<style>
    .widget-account-invoice-two .account-box p
    {
        font-size: 13px;
    }

    .widget-account-invoice-two .account-box .info
    {
        margin-bottom: 0% !important;
    }

    .widget.widget-account-invoice-two
    {
        background: none !important;
    }


    .widget-files {
        padding: 22px 19px;
        border: none;
        box-shadow: 0 0.1px 0px rgba(0, 0, 0, 0.002), 0 0.2px 0px rgba(0, 0, 0, 0.003), 0 0.4px 0px rgba(0, 0, 0, 0.004), 0 0.6px 0px rgba(0, 0, 0, 0.004), 0 0.9px 0px rgba(0, 0, 0, 0.005), 0 1.2px 0px rgba(0, 0, 0, 0.006), 0 1.8px 0px rgba(0, 0, 0, 0.006), 0 2.6px 0px rgba(0, 0, 0, 0.007), 0 3.9px 0px rgba(0, 0, 0, 0.008), 0 7px 0px rgba(0, 0, 0, 0.01);
        background: #3b3f5c;
        background-image: linear-gradient(to top, #09203f 0%, #537895 100%);
        background-blend-mode: multiply;
    }


    .widget-files .account-box .acc-action {
        margin-top: 3px;
        display: flex;
        justify-content: space-between;
    }



    .widget.widget-five
    {
        height: 70% !important;
    }



    </style>
{{--
<div class="col-xl-3 col-lg-6 col-md-4 col-sm-12 col-12 layout-spacing">
    <div class="widget widget-account-invoice-two widget-files">
        <div class="widget-content">
            <div class="account-box">
                <div class="info">
                    <div class="inv-title">
                        <a href="javascript:void(0)" class="task-info">

                            <div class="w-img">
                                <i class="fad fa-exchange text-warning fa-3x"></i>
                            </div>
                        </a>

                    </div>
                    <div class="inv-balance-info">

                        <p class="inv-balance">daf sdfasfdas fsaf saf asf asf saf daf sdfasfdas fsaf saf asf asf saf</p>

                        <h5 class="">Total Balance</h5>

                    </div>
                </div>

               {{--  <div class="note-action">


                    <a href="javascript:void(0);"><i class="fad fa-eye fa-2x"></i></a>
                    <a href="javascript:void(0);"><i class="fad fa-eye fa-2x"></i></a>
                        <a href="javascript:void(0);"><i class="fad fa-exchange fa-2x"></i></a>
                        <a href="javascript:void(0);"><i class="fad fa-pencil-alt fa-2x"></i></a>
                        <a href="javascript:void(0);"><i class="fad fa-link fa-2x"></i></a>
                        <a href="javascript:void(0);"><i class="fad fa-trash-alt fa-2x"></i></a>

                </div> --} }


                <div class="acc-action">
                    {{-- <div class="">
                        <a href="javascript:void(0);"><i class="fad fa-eye"></i></a>
                        <a href="javascript:void(0);"><i class="fad fa-exchange"></i></a>
                        <a href="javascript:void(0);"><i class="fad fa-pencil-alt"></i></a>
                        <a href="javascript:void(0);"><i class="fad fa-link"></i></a>
                        <a href="javascript:void(0);"><i class="fad fa-trash-alt"></i></a>
                    </div> --} }
                    <a href="javascript:void(0);"><i class="fad fa-eye"></i></a>
                    <a href="javascript:void(0);"><i class="fad fa-eye"></i></a>
                        <a href="javascript:void(0);"><i class="fad fa-exchange"></i></a>
                        <a href="javascript:void(0);"><i class="fad fa-pencil-alt"></i></a>
                        <a href="javascript:void(0);"><i class="fad fa-link"></i></a>
                        <a href="javascript:void(0);"><i class="fad fa-trash-alt"></i></a>
                </div>
            </div>
        </div>
    </div>
</div> --}}



@foreach($filelist as $list)

    @include('portal.files.micro.viewfile')

@endforeach





</div>










{{--





@foreach($filelist as $list)

<div class="nk-file-item nk-file">
	<div class="nk-file-info">
		<div class="nk-file-title">
			<div class="nk-file-icon">
				<span class="nk-file-icon-type">
					<svg
						xmlns="http://www.w3.org/2000/svg" viewBox="0 0 72 72">
						<path d="M50,61H22a6,6,0,0,1-6-6V22l9-11H50a6,6,0,0,1,6,6V55A6,6,0,0,1,50,61Z" style="fill:#36c684"></path>
						<path d="M25,20.556A1.444,1.444,0,0,1,23.556,22H16l9-11h0Z" style="fill:#95e5bd"></path>
						<path d="M42,31H30a3.0033,3.0033,0,0,0-3,3V45a3.0033,3.0033,0,0,0,3,3H42a3.0033,3.0033,0,0,0,3-3V34A3.0033,3.0033,0,0,0,42,31ZM29,38h6v3H29Zm8,0h6v3H37Zm6-4v2H37V33h5A1.001,1.001,0,0,1,43,34ZM30,33h5v3H29V34A1.001,1.001,0,0,1,30,33ZM29,45V43h6v3H30A1.001,1.001,0,0,1,29,45Zm13,1H37V43h6v2A1.001,1.001,0,0,1,42,46Z" style="fill:#fff"></path>
					</svg>
				</span>
			</div>
			<div class="nk-file-name">
				<div class="nk-file-name-text">
					<a href="#" class="title">Updatehh Data.xlsx</a>
					<div class="asterisk">
						<a href="#">
							<em class="asterisk-off icon ni ni-star"></em>
							<em class="asterisk-on icon ni ni-star-fill"></em>
						</a>
					</div>
				</div>
			</div>
		</div>
		<ul class="nk-file-desc">
			<li class="date">Yesterday</li>
			<li class="size">235 KB</li>
			<li class="members">3 Members</li>
		</ul>
	</div>
	@include('portal.files.micro.fileaction')
</div>




@endforeach
 --}}
