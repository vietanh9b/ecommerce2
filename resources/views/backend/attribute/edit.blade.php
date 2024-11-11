@extends('backend.layouts.master')
<?php
?>
@section('main-content')

    <div class="card">
        <div class="card-header card-tabs d-flex">
            <div id="attribute" class="tab-header">{{ __('Attribute') }}</div>
        </div>
        <div class="card-body">
            <form method="post" action="{{route('attribute.update',$attribute->id)}}">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">{{__('Title')}}<span class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="name" placeholder="{{__('Enter name')}}"
                           value="{{$attribute->name}}" class="form-control">
                    @error('title')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                
                <div class="form-group mb-3">
                    <button class="btn btn-success" type="submit">{{__('Update')}}</button>

                </div>
            </form>
        </div>
    </div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
@endpush
@push('after_scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="{{asset('backend/summernote/summernote.min.js')}}"></script>

    <script src="{{ mix('/js/backend/storeView.js') }}"></script>

    <script>
        $('#lfm').filemanager('image');
        $(document).ready(function () {
            $('#summary').summernote({
                placeholder: "Write short description.....",
                tabsize: 2,
                height: 150
            });
        });
    </script>
    <script>
        $('#is_parent').change(function () {
            var isChecked = $('#is_parent').prop('checked');
            if (isChecked) {
                $('#parent_cat_div').addClass('d-none');
                $('#parent_cat_div').val('');
            } else {
                $('#parent_cat_div').removeClass('d-none');
            }
        })

        $('.tab-header').on('click', function () {
            var t = $(this).attr('id');
            $(this).addClass('active');
            $('.tab-header').not($(this)).removeClass('active');

        if ($(this).hasClass('active')) {
             $('.card-body').hide();
            $('#tab-' + t).show();
        }
  });
    </script>
@endpush
