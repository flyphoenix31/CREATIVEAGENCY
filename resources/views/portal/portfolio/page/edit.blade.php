
    <div class="statbox widget box box-shadow text-capitalize">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>Edit Portfolio Details</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            <form class="needs-validation" novalidate  action="" name="formedit" id="formedit" enctype="application/x-www-form-urlencoded">
                @csrf

                <input type="hidden" name="id" value="{{encryptId($record->id)}}">

                <div class="form-group mb-4">
                    <label for="slug_url">@lang('lang.slug')</label>
                    <input type="text" class="form-control" id="slug_url" placeholder="@lang('lang.slug')" name="slug_url" required value="{{$record->slug_url}}">
                </div>

                <div class="form-group mb-4">
                    <label for="title">@lang('lang.title')</label>
                    <input type="text" class="form-control" placeholder="@lang('lang.title')" name="title" id="title" required value="{{$record->title}}">
                    <div class="invalid-feedback">
                        Please add the portfolio title.
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="sub_title">@lang('lang.sub_title')</label>
                    <input type="text" class="form-control" id="sub_title" placeholder="@lang('lang.sub_title')" name="sub_title" required value="{{$record->sub_title}}">
                </div>

                <div class="form-row mb-4">
                    <div class="col">
                        <label for="tag">@lang('lang.tag')</label>
                        <input type="text" class="form-control" id="tag" placeholder="@lang('lang.tag')" name="tag" value="{{$record->tag}}">
                    </div>
                </div>

                <div class="form-row mb-4">
                    <div class="col">
                        <div class="custom-file-container" data-upload-id="portfolio_image">
                            <label>Portfolio Image (Single File) <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                            <label class="custom-file-container__custom-file" >
                                <input type="file" name="portfolio_image" id="portfolio_image" class="custom-file-container__custom-file__custom-file-input" accept="image/*">
                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                            </label>
                            <div class="custom-file-container__image-preview"></div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="custom-file-container" data-upload-id="portfolio_banner">
                            <label>Portfolio Banner (Single File) <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                            <label class="custom-file-container__custom-file" >
                                <input type="file" name="portfolio_banner" id="portfolio_banner" class="custom-file-container__custom-file__custom-file-input" accept="image/*">
                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                            </label>
                            <div class="custom-file-container__image-preview"></div>
                        </div>
                    </div>
                </div>


                <div class="form-group mb-4">
                    <label for="content">@lang('lang.content')</label>
                    <textarea class="form-control editor" placeholder="@lang('lang.content')" name="content" id="content" required>
                        {{$record->content}}
                    </textarea>
                </div>

                <div class="form-group mb-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="is_featured" @if($record->is_featured == 1) checked @endif name="is_featured" value="1">
                        <label class="custom-control-label" for="is_featured">@lang('lang.is_featured')</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3">@lang('lang.update')</button>

                <a href="{{ url()->previous() }}" class="btn btn-dark mt-3">@lang('lang.cancel')</a>



            </form>

        </div>
    </div>

    @include('portal.portfolio.script_edit')
