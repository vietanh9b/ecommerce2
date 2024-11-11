<div class="modal fade" id="formAttribute" tabindex="-1" role="dialog" aria-labelledby="attributeModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title form-attribute-title" id="exampleModalLongTitle">{{ __('Add a new attribute') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_attribute" method="post" action="{{route('attribute.store')}}" >
                  @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>{{ __('SKU') }}</label>
                        <input class="form-control attribute_sku" type="text" name="attribute_sku" required="required">
                    </div>
                    <div class="form-group">
                        <label>{{ __('Color') }}</label>
                        <input class="form-control" type="color" name="attribute_color" required="required">
                    </div>
                    <div class="form-group">
                        <label>{{ __('Price') }}</label>
                        <input class="form-control" type="text" name="attribute_price" required="required">
                    </div>
                    <div class="form-group">
                        <label>{{ __('Stock') }}</label>
                        <input class="form-control" type="text" name="attribute_stock" required="required">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="hidden" name="product_id" value="{{ $product->id }}">
                    </div>
                    <div class="form-group">
                        <label for="inputPhoto" class="col-form-label">{{__('Photo')}}<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="attr-photo" data-input="thumbnail-attribute" data-preview="holder"  class="btn btn-primary text-white">
                                    <i class="fa fa-picture-o"></i>{{__('Choose')}}
                                </a>                                
                            </span>
                            <input id="thumbnail-attribute" name="attribute-photo" class="form-control" type="text">
                        </div>
                        <small id="warningInputImg" class="form-text " style="font-size: 14px;color:red;margin-bottom: 20px;"> *Image size must be: 550 x 550</small>
                        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                        @error('photo')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-primary text-white">{{ __('Save changes') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>