@extends('backend.layouts.master')
<?php
// $helper = new \App\Helpers\Backend\CategoryHelper();
// $productHelper = new \App\Helpers\Backend\ProductHelper();
?>
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
    
    <div class="card">
        <div class="card-header card-tabs d-flex">
            <div id="product" class="tab-header" style="border: 1px solid #ccc">{{ __('Edit Product') }}</div>
            <div id="attribute" class="tab-header" style="border: 1px solid #ccc">{{ __('Attribute Product') }}</div>
        </div>
        <div class="card-body" id="tab-product">
            <form method="post" action="{{route('product.update',$product->id)}}">
                @csrf
                @method('PATCH')
                <input type="hidden" name="store_id" id="currentStoreView" value="0"/>
                <div class="form-group">
                    <label for="status" class="col-form-label">{{__('Status')}}<span
                            class="text-danger">*</span></label>
                    <select name="status" class="form-control">
                        <option
                            value="active" {{(($product->status=='active')? 'selected' : '')}}>{{__('Active')}}</option>
                        <option
                            value="inactive" {{(($product->status=='inactive')? 'selected' : '')}}>{{__('Inactive')}}</option>
                    </select>
                    @error('status')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">{{__('Title')}}<span
                            class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="title" placeholder="{{__('Enter title')}}"
                           value="{{$product->title}}" class="form-control">
                    @error('title')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="summary" class="col-form-label">{{__('Short Description')}}<span
                            class="text-danger">*</span></label>
                    <textarea class="form-control" id="summary" name="summary">{{$product->summary}}</textarea>
                    @error('summary')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description" class="col-form-label">{{__('Description')}}</label>
                    <textarea class="form-control" id="description"
                              name="description">{{$product->description}}</textarea>
                    @error('description')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category_id">{{__('Category')}}<span class="text-danger">*</span></label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="">{{__('--Select any category--')}}</option>
                        @foreach($categories as $key=>$catData)
                            <option
                                value='{{$catData->id}}' {{(($product->category_id==$catData->id)? 'selected' : '')}}>{{$catData->title}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="inputPhoto" class="col-form-label">{{__('Photo')}}<span
                            class="text-danger">*</span></label>
                    <div class="input-group">
                    <span class="input-group-btn">
                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                        <i class="fa fa-picture-o"></i>{{__('Choose')}}
                        </a>
                    </span>
                        <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$product->photo}}">
                    </div>
                    <small id="warningInputImg" class="form-text " style="font-size: 14px;color:red;margin-bottom: 26px;"> *Image size must be: 550 x 550</small>
                    <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                    @error('photo')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <button class="btn btn-success" type="submit">{{__('Update')}}</button>
                </div>
            </form>
        </div>
        
        <div class="card-body" id="tab-attribute">
            <button type="button" id="add_attribute" class="btn btn-primary mb-4" data-toggle="modal" data-target="#formAttribute">
                {{ __('Add Attribute') }}
            </button>

            <!-- Modal add new address  -->
            @include('backend.product.attribute.product-attribute-form')
            <!-- End Modal -->

            <!-- Customer address list -->
            @include('backend.product.attribute.product-attribute-list')
        </div>
        
    </div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css"/>

@endpush
@push('after_scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    {{-- <script src="{{asset('backend/summernote/summernote.min.js')}}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    
    <script>
        $('#lfm').filemanager('image');
    </script>
    <script>
        $('#attr-photo').filemanager('image');
    </script>
    <script>
        $('#attr-photo').filemanager('image', { input: "#thumbnail-attribute" });
    </script>

    

    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.js"></script>
    {{-- <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script> --}}
    <script>
        $(document).ready(function(){
      
          // Define function to open filemanager window
          var lfm = function(options, cb) {
            var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
            window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
            window.SetUrl = cb;
          };
      
          // Define LFM summernote button
          var LFMButton = function(context) {
            var ui = $.summernote.ui;
            var button = ui.button({
              contents: '<i class="note-icon-picture"></i> ',
              tooltip: 'Insert image with filemanager',
              click: function() {
      
                lfm({type: 'image', prefix: '/laravel-filemanager'}, function(lfmItems, path) {
                  lfmItems.forEach(function (lfmItem) {
                    context.invoke('insertImage', lfmItem.url);
                  });
                });
      
              }
            });
            return button.render();
          };
      
          // Initialize summernote with LFM button in the popover button group
          // Please note that you can add this button to any other button group you'd like
          $('#summary').summernote()
          $('#description').summernote()
        });
       

    </script>

    <script>
       $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.edit_attribute', function(e){
                e.preventDefault();
                var id = $(this).attr('data-id');
                $('.form-attribute-title').text('Edit Attribute');
                $('#form_attribute').attr('action', location.origin + '/admin/attribute/update/' + id);
                $('.attribute_sku').prop('readonly', true);
                $.ajax({
                    type: 'GET',
                    url: '/admin/attribute-edit/'+id,
                    data: {},
                    processData: false,
                    contentType: false,
                    success: function(response){
                        console.log(response);
                         $('form input[name=attribute_sku]').val(response.attribute.sku);
                         $('form input[name=attribute_color]').val(response.attribute.color);
                         $('form input[name=attribute_price]').val(response.attribute.price);
                         $('form input[name=attribute_stock]').val(response.attribute.stock);
                         $('form input[name=attribute-photo]').val(response.attribute.photo);
                    },
                    error: function (response){
                        console.log(response);
                    }
            })
    
       });  
            $(document).on('click', '.remove-table-row', function(){
                $(this).parents('tr').remove();
            });

            $('#tab-attribute').hide();
            $('.tab-header').on('click', function () {
                var t = $(this).attr('id');
                $(this).addClass('active');
                $('.tab-header').not($(this)).removeClass('active');

                if ($(this).hasClass('active')) {
                $('.card-body').hide();
                $('#tab-' + t).show();
            }
            });
            $('#add_attribute').on('click', function () {
                $("form :input:not([type=hidden])").val('');
                $('#form_attribute').attr('action', location.origin + '/admin/attribute');
                $('.form-attribute-title').text('Add a new attribute');
            });
    </script> 

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.dltBtn').click(function (e) {
                var form = $(this).closest('form');
                e.preventDefault();
                swal({
                    title: "{{__('Are you sure?')}}",
                    text: "{{__('Once deleted, you will not be able to recover this data!')}}",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            form.submit();
                        } else {
                            swal("{{__('Your data is safe!')}}");
                        }
                    });
            })
        })
    </script>
       <script>
        function hexToRgb(hex) {
            var bigint = parseInt(hex.substring(1), 16);
            var r = (bigint >> 16) & 255;
            var g = (bigint >> 8) & 255;
            var b = bigint & 255;
            return "rgb(" + r + ", " + g + ", " + b + ")";
        }

        var boxes = document.getElementsByClassName("color-box"); // Lấy tất cả các phần tử có class "color-box"
        for (var i = 0; i < boxes.length; i++) {
            var hexColor = boxes[i].textContent; // Lấy giá trị mã màu hex từ nội dung của phần tử
            var color = hexToRgb(hexColor); // Chuyển đổi mã hex thành màu sắc
            boxes[i].style.backgroundColor = color; // Áp dụng màu sắc vào phần tử HTML
            boxes[i].style.display = "block"; // Hiển thị phần tử
        }
    </script>
@endpush
