<div class="table-responsive">
    <table class="table table-bordered" id="attribute-dataTable" width="100%" cellspacing="0">
        <thead>
        <tr>
            <th>{{ __('SKU') }}</th>
            <th>{{ __('Color') }}</th>
            <th>{{ __('Price') }}</th>
            <th>{{ __('Stock') }}</th>
            <th>{{ __('Photo') }}</th>
            <th>{{ __('Action') }}</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>{{ __('SKU') }}</th>
            <th>{{ __('Color') }}</th>
            <th>{{ __('Price') }}</th>
            <th>{{ __('Stock') }}</th>
            <th>{{ __('Photo') }}</th>
            <th>{{ __('Action') }}</th>
        </tr>
        </tfoot>
        <tbody>
        @foreach($attributes as $attribute)
            @php
                $productHelper = new \App\Helpers\Backend\ProductHelper();
                $productPrice =  $productHelper->formatPrice($attribute->price);
            @endphp
            <tr>
                <td>{{ $attribute->sku }}</td>
                <td class="color-box">{{ $attribute->color }}</td>
                <td>{{ $productPrice }}</td>
                <td>{{ $attribute->stock }}</td>
                <td>
                    @php
                        $photo=explode(',',$attribute->photo);
                    @endphp
                    <img src="{{$photo[0]}}" class="img-fluid zoom" style="max-width:80px"
                    alt="{{$attribute->photo}}">
                </td>
                <td>
                    <a href="#"
                       class="btn btn-primary btn-sm float-left mr-1 edit_attribute"
                       style="height:30px; width:30px;border-radius:50%"
                       data-id = "{{$attribute->id}}"
                       data-toggle="modal"
                       data-target="#formAttribute"
                       title="edit"
                       data-placement="bottom">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form method="POST" action="{{route('attribute.destroy',[$attribute->id])}}">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="product" value="{{$product->id}}">
                        <button class="btn btn-danger btn-sm dltBtn" data-id={{$attribute->id}} style="height:30px;width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

