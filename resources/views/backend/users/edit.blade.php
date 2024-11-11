@extends('backend.layouts.master')

@section('main-content')
    @if(session('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! session('success') !!}</li>
            </ul>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            <ul>
                <li>{!! session('error') !!}</li>
            </ul>
        </div>
    @endif
    @php
        $roleCustomer = $user->role ?? '';
    @endphp
    @if($roleCustomer == \App\Models\User::ROLE_TYPE_ADMIN)
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                {!! $error !!}
            </div>
        @endforeach
    @endif

    <div class="card">
        <div class="card-header card-tabs d-flex">
            <div id="user" class="tab-header" style="border: 1px solid #ccc">{{ __('User Info') }}</div>
            @if(isset($user->role) && $user->role != \App\Models\User::ROLE_TYPE_ADMIN)
                <div id="address" class="tab-header" style="border: 1px solid #ccc" >{{ __('Address Info') }}</div>
            @endif
        </div>
        <div class="card-body" id="tab-user">
            <form method="post" action="{{route('users.update',$user->id)}}">
                @csrf
                @method('PATCH')
                @php
                    $styleResult = 'display:block';
                    $customerStyle = 'display:block';
                        $roleCustomer = $user->role ?? '';
                        $customerType = $user->user_type ?? '';
                        if ($roleCustomer != 'user') {
                            $styleResult = 'display:none';
                            $customerStyle = 'display:none';
                        } else {
                            $styleResult = 'display:block';
                        }
                @endphp
                <div class="form-group user-id" style="{{ $styleResult }}">
                    <label for="inputTitle" class="col-form-label">{{ __('User ID') }}</label>
                    <input id="inputTitle" type="text" name="user_id" value="{{ $user->user_id ?? '' }}" readonly class="form-control">
                    @error('user_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="inputName" class="col-form-label">Name</label>
                    <input id="inputName" type="text" name="name" placeholder="Enter name" value="{{$user->name}}"
                           class="form-control">
                    @error('name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-form-label">Email</label>
                    <input id="inputEmail" type="email" name="email" placeholder="Enter email" value="{{$user->email}}"
                           class="form-control">
                    @error('email')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                @php
                $roles = \App\Models\User::ROLE;
                @endphp
                <div class="form-group">
                    <label for="role" class="col-form-label">{{ __('Role') }}</label>
                        <select name="role" class="form-control" id="wgt-role">
                        @if(isset($roles))
                            @foreach($roles as $key => $role)
                                <option value="{{$key}}" {{(($user->role == $key) ? 'selected' : '')}}>{{$role}}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('role')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status" class="col-form-label">{{ __('Status') }}</label>
                    <select name="status" class="form-control">
                        <option value="active" {{(($user->status=='active') ? 'selected' : '')}}>{{ __('Active')}}</option>
                        <option value="inactive" {{(($user->status=='inactive') ? 'selected' : '')}}>{{ __('Inactive') }}</option>
                    </select>
                        @error('status')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                </div>
                <div class="form-group mb-3">
                       <button class="btn btn-success" type="submit">{{ __('Update') }}</button>
                </div>
            </form>
        </div>
        @if($user->role == 'user')
            <div class="card-body" id="tab-address">
                <button type="button" id="add_address" class="btn btn-primary mb-4" data-toggle="modal" data-target="#formAddress">
                    {{ __('Add Address') }}
                </button>

                <!-- Modal add new address  -->
                 @include('backend.users.address.customer-address-form') 
                <!-- End Modal -->

                <!-- Customer address list -->
                @include('backend.users.address.customer-address-list') 
            </div>
        @endif
</div>

@endsection

@push('after_scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>
        $(document).ready(function () {
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#tab-address').hide();
        $('.tab-header').on('click', function () {
            var t = $(this).attr('id');

            $(this).addClass('active');
            $('.tab-header').not($(this)).removeClass('active')

            if ($(this).hasClass('active')) {
                $('.card-body').hide();
                $('#tab-' + t).show();
            }
        });

    $('#add_address').on('click', function() {
        $("form :input:not([type=hidden])").val('');
        $('#form_address').attr('action', location.origin + '/admin/customer-address');
        $('.form-address-title').text('Add a new address');
        $('#is_default').val(0);
    })



    $('.dltBtn').click(function(e){
        var form = $(this).closest('form');

        e.preventDefault();
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                form.submit();
            } else {
                swal("Your data is safe!");
            }
        });
    })

    $(document).on('click', '.edit_address', function(e){
                e.preventDefault();
                var id = $(this).attr('data-id');
                $('.form-address-title').text('Edit Attribute');
                $('#form_address').attr('action', location.origin + '/admin/customer-address/update/' + id);
                $.ajax({
                    type: 'GET',
                    url: '/admin/customer-address/show/'+id,
                    data: {},
                    processData: false,
                    contentType: false,
                    success: function(response){
                        console.log(response);
                        $('form input[name=address_name]').val(response.addressInfo.name);
                        $('form input[name=address_email]').val(response.addressInfo.email);
                        $('form input[name=address_phone_number]').val(response.addressInfo.phone_number);
                        $('form input[name=address_detail]').val(response.addressInfo.detail_address);
                        $('form input[name=gender]').val(response.addressInfo.gender);
                        $('form input[name=is_default]').val(response.addressInfo.is_default);

                        if (response.addressInfo.gender == 2) {
                            $("#female").prop("selected", true);
                        }

                        if (response.addressInfo.is_default == 1) {
                            $('form input[name=is_default]').attr('checked', true);
                        } else {
                            $('form input[name=is_default]').attr('checked', false);
                        }
                    },
                    error: function (response){
                        console.log(response);
                    }
            })
    })

    $('.is_default input').on('change', function () {
        if($(this).is(':checked')) {
            $(this).val(1);
        } else {
            $(this).val(0);
        }
    })
})

    </script>
@endpush


