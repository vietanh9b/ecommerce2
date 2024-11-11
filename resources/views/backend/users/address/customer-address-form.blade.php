<div class="modal fade" id="formAddress" tabindex="-1" role="dialog" aria-labelledby="addressModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title form-address-title" id="exampleModalLongTitle">{{ __('Add a new address') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_address" method="post" action="{{route('customer-address.store')}}" >
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>{{ __('Name') }}</label>
                        <input class="form-control" type="text" name="address_name" required="required">
                    </div>
                    
                    <div class="form-group">
                        <label>{{ __('Email') }}</label>
                        <input class="form-control" type="text" name="address_email" required="required">
                    </div>
                    <div class="form-group">
                        <label>{{ __('Gender') }}</label>
                        <select class="form-control" type="text" name="gender" >
                            <option id="male" selected value="{{ \App\Models\CustomerAddress::GENDER_MALE }}">{{ __('Male') }}</option>
                            <option id="female" value="{{ \App\Models\CustomerAddress::GENDER_FEMALE }}">{{ __('Female') }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>{{ __('Phone') }}</label>
                        <input class="form-control" required="required" type="text" name="address_phone_number">
                    </div>
                    <div class="form-group">
                        <label>{{ __('Detail Address') }}</label>
                        <input class="form-control" type="text" name="address_detail" required="required">
                    </div>
                   
                    <div class="form-group is_default" style="display: flex; align-items: center;">
                        <span>{{ __('Is Default : ') }}</span>
                        <input class="form-control" type="checkbox" name="is_default" style="width: 60px">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="hidden" name="user_id" value="{{ $user->id }}">
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
