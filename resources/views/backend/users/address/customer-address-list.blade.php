<div class="table-responsive">
    <table class="table table-bordered" id="address-dataTable" width="100%" cellspacing="0">
        <thead>
        <tr>
            <th>{{ __('ID') }}</th>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Detail Address') }}</th>
            <th>{{ __('Gender') }}</th>
            <th>{{ __('Phone') }}</th>
            <th>{{ __('Status') }}</th>
            <th>{{ __('Action') }}</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>{{ __('ID') }}</th>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Detail Address') }}</th>
            <th>{{ __('Gender') }}</th>
            <th>{{ __('Phone') }}</th>
            <th>{{ __('Status') }}</th>
            <th>{{ __('Action') }}</th>
        </tr>
        </tfoot>
        <tbody>
        @foreach($address as $addr)
            <tr>
                <td>{{ $addr->id }}</td>
                <td>{{ $addr->name }}</td>
                <td>{{ $addr->detail_address }}</td>
                <td>{{ $addr->gender == \App\Models\CustomerAddress::GENDER_MALE ? 'Male' : 'Female' }}</td>
                <td>{{ $addr->phone_number }}</td>
                <td>
                    @if(isset($addr->is_default) && $addr->is_default == 1)
                        <span class="badge badge-success">{{ __('default') }}</span>
                    @endif
                </td>
                <td>
                    <a href="#"
                       class="btn btn-primary btn-sm float-left mr-1 edit_address"
                       style="height:30px; width:30px;border-radius:50%"
                       data-id="{{$addr->id}}"
                       data-toggle="modal"
                       data-target="#formAddress"
                       title="edit"
                       data-placement="bottom">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form method="POST" action="{{route('customer-address.destroy',[$addr->id])}}">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="user" value="{{$user->id}}">
                        <button class="btn btn-danger btn-sm dltBtn" data-id={{$addr->id}} style="height:30px;width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
