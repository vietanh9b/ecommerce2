@extends('admin.layout.master')
@section('title')
    This page is list catelogues
@endsection
@section('content')
<div class="container">
    <h1>Add New Coupon</h1>
    <form action="{{ route('admin.coupons.update',$coupon) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required value="{{$coupon->name}}">
        </div>

        <div class="form-group">
            <label for="code">Code</label>
            <input type="text" class="form-control" id="code" name="code" required value="{{$coupon->code}}">
        </div>
        
        <div class="form-group">
            <label for="discount_value">Discount Value</label>
            <input type="number" class="form-control" id="amount" name="amount" step="0.01" required value="{{$coupon->amount}}">
        </div>
        <div class="form-group">
            <label for="discount_type">Discount Type</label>
            <select class="form-control" id="discount_type" name="type" required>
                <option value="percent">Percent</option>
                <option value="fixed">Fixed</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection