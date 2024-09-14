@extends('admin.layout.master')
@section('title')
    This page is list catelogues
@endsection
@section('content')
<div class="container">
    <h1>Add New Coupon</h1>
    <form action="{{ route('admin.coupons.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="code">Code</label>
            <input type="text" class="form-control" id="code" name="code" required>
        </div>
        
        <div class="form-group">
            <label for="discount_value">Discount Value</label>
            <input type="number" class="form-control" id="amount" name="amount" step="0.01" required>
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