@extends('admin.layout.master')
@section('title')
    This page is add product
@endsection
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h4>Add product</h4>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <button class="btn btn-success">Trash</button>
                <button class="ms-2 btn btn-warning"><a href="{{route('admin.products.index')}}">Back</a></button>
            </div>
        </div>
        {{-- @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
                @php
                    Session::forget('success');
                @endphp
            </div>
            @endif --}}
    </div>


    @if ($errors->any())
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <div class="alert alert-danger" style="width: 100%;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
    <div class="card-body">
        <form id="productForm" action="{{route('admin.products.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{old('name')}}">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Sku</label>
                        <input type="text" name="sku" class="form-control" value="{{old('sku')}}">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Catelogue</label>
                        <select class="form-select mb-3" aria-label="Default select example" name="catelogue">
                            <option value="">Chọn danh mục</option>
                            @foreach ($catelogues as $catelogue)
                                <option value="{{$catelogue->id}}">{{$catelogue->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- price --}}
                    <div class="form-group">
                        <label for="" class="form-label">Price regular</label>
                        <input type="text" name="price_regular" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Price sale</label>
                        <input type="text" name="price_sale" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Image thumbnail</label>
                        <input type="file" name="img_thumbnail" class="form-control">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-check form-switch form-switch-custom form-switch-primary">
                                <input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck9" name="is_active" checked>
                                <label class="form-check-label" for="SwitchCheck9">Is active</label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-check form-switch form-switch-custom form-switch-secondary">
                                <input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck10"  name="is_hot_deal"  checked>
                                <label class="form-check-label" for="SwitchCheck10">Is hot deal</label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-check form-switch form-switch-custom form-switch-success">
                                <input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck11" name="is_good_deal"  checked>
                                <label class="form-check-label" for="SwitchCheck11">Is good deal</label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-check form-switch form-switch-custom form-switch-warning">
                                <input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck12"  name="is_show_home" checked>
                                <label class="form-check-label" for="SwitchCheck12">Is show home</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mt-2">
                        <textarea name="description" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 200px"></textarea>
                        <label for="floatingTextarea2">Description</label>
                    </div>

                    <div class="card mt-3">
                        <textarea name="content" class="ckeditor-classic"></textarea>
                    </div>
                </div>
                <div id="variants">
                    <h3>Variants:</h3>
                    <button type="button" id="addVariant" class="w-25">Add Variant</button>
                    <div class="variant">
                        <label for="color">Color:</label>
                        <select name="colors[]">
                            @foreach($colors as $color)
                                <option value="{{ $color->id }}" style="color: {{ $color->name }}">{{ $color->name }}</option>
                            @endforeach
                        </select>

                        <label for="size">Size:</label>
                        <select name="sizes[]">
                            @foreach($sizes as $size)
                                <option value="{{ $size->id }}">{{ $size->name }}</option>
                            @endforeach
                        </select>
                        <label>
                            Image variant
                        </label>
                        <input type="file" name="image_variant[]" id="">
                    </div>
                </div>
            <button type="submit" class="mt-4 btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
@section('script-libs')
    <script src="{{asset('themes/admin/lib/ckeditor5-build-classic/build/ckeditor.js')}}"></script>
    <script src="{{asset('themes/admin/js/form-editor.init.js')}}"></script>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#addVariant').click(function() {
            var variantHtml = `
                <div class="variant">
                    <label for="color">Color:</label>
                    <select name="colors[]">
                        @foreach($colors as $color)
                            <option value="{{ $color->id }}" style="color: {{ $color->name }}">{{ $color->name }}</option>
                        @endforeach
                    </select>

                    <label for="size">Size:</label>
                    <select name="sizes[]">
                        @foreach($sizes as $size)
                            <option value="{{ $size->id }}">{{ $size->name }}</option>
                        @endforeach
                    </select>
                    <label>
                    Image variant
                    </label>
                    <input type="file" name="image_variant" id="">
                </div>`;
            $('#variants').append(variantHtml);
        });
    });

</script>
@endsection
{{-- $('#productForm').submit(function(e) {
    e.preventDefault();

    var formData = $(this).serialize();

    $.ajax({
        url: '{{ route("admin.products.store") }}',
        method: 'POST',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            alert('Product saved successfully!');
            location.reload();
        },
        error: function(response) {
            alert('An error occurred. Please try again.');
        }
    });
}); --}}
