@extends('backend.layouts.master')
<?php
//  $helper = new \App\Helpers\Backend\CategoryHelper();
?>
@section('main-content')
    <div class="card">
        <h5 class="card-header">{{ __('Add Category') }}</h5>
        <div class="card-body">
            <form method="post" action="{{ route('category.store') }}">
                {{ csrf_field() }}
                <input type="hidden" name="store_id" id="currentStoreView" value="0" />
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">{{ __('Title') }}<span
                            class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="title" placeholder="{{ __('Enter title') }}"
                        class="form-control">
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="slug" class="col-form-label">{{ __('Slug') }}<span
                            class="text-danger">*</span></label>
                    <input id="slug" type="text" name="slug" placeholder="{{ __('Enter Slug') }}"
                        class="form-control">
                    @error('slug')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="summary" class="col-form-label">{{ __('Summary') }}</label>
                    <textarea class="form-control" id="summary" name="summary"></textarea>
                    @error('summary')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                @php
                    $CategoryType = \App\Models\Category::CATEGORY_TYPE;
                @endphp
             
                <div class="form-group category-type">
                    <label for="summary" class="col-form-label">{{ __('Category Type') }}<span class="text-danger">*</span></label>
                    <select name="category_type" id="category-type" class="form-control">
                            <option value="">---Main Category---</option>
                            @foreach($CategoryType as $key => $value)
                            <option
                                value="{{$key}}" @selected(old($value) == $value)>{{$value}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group sub-category" style="display:none">
                    <label for="summary" class="col-form-label">{{ __('Category Parent') }}</label>
                    <select name="parent_id" class="form-control">
                    <option value="0">---Main Category---</option>
                    @foreach($categories as $key => $value)
                        @if($value->parent_id == 0)
                            <option value="{{$value->id}}">{{$value->title}}</option>
                            @endif
                    @endforeach
                </select>
                </div>

                <div class="form-group">
                    <label for="status" class="col-form-label">{{ __('Status') }}<span class="text-danger">*</span></label>
                    <select name="status" class="form-control">
                        <option value="active">{{ __('Active') }}</option>
                        <option value="inactive">{{ __('Inactive') }}</option>
                    </select>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
        </div>
        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
    </div>

    
    <div class="form-group mb-3">
        <button type="reset" class="btn btn-warning">{{ __('Reset') }}</button>
        <button class="btn btn-success" type="submit">{{ __('Submit') }}</button>
    </div>
    </form>
    </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/summernote/summernote.min.css') }}">
@endpush
@push('after_scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="{{ asset('backend/summernote/summernote.min.js') }}"></script>
    {{-- <script>
        $('#lfm').filemanager('image');
        $(document).ready(function() {
            $('#summary').summernote({
                placeholder: "{{ __('Write short description.....') }}",
                tabsize: 2,
                height: 120
            });
        });
    </script> --}}
    <script>
    $(document).ready(function () {
        $('#category-type').change(function () {
            if ($(this).val() && $(this).val() === 'child') {
                $('.sub-category').show();
        } else {
                $('.sub-category').hide();
    }
  });
    });
    </script>
    
@endpush
