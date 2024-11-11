@extends('backend.layouts.master')

@section('title','Admin Profile')

@section('main-content')

<div class="card shadow mb-4">
    <div class="row">
        <div class="col-md-12">
           @include('backend.layouts.notification')
        </div>
    </div>
   <div class="card-header py-3">
     <h4 class=" font-weight-bold">Profile</h4>
     <ul class="breadcrumbs">
         <li><a href="{{route('admin')}}" style="color:#999">Dashboard</a></li>
         <li><a href="" class="active text-primary">Profile Page</a></li>
     </ul>
   </div>
   <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <form class="border px-4 pt-2 pb-3" method="POST" action="">
                    @csrf
                    <div class="form-group">
                        {{-- <div>
                            <label for="inputTitle" class="col-form-label"> First name</label>
                            <input id="inputTitle" type="text" name="first_name" placeholder="Enter first name"
                                   value="{{ $profile->first_name }}" class="form-control">
                            @error('first_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div> --}}
                        {{-- <div>
                            <label for="inputTitle" class="col-form-label"> Last name</label>
                            <input id="inputTitle" type="text" name="last_name" placeholder="Enter last name"
                                   value="{{ $profile->last_name }}" class="form-control">
                            @error('last_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div> --}}
                    </div>
                      <div class="form-group">
                          <label for="inputEmail" class="col-form-label">Email</label>
                        <input id="inputEmail" disabled type="email" name="email" placeholder="Enter email"  value="{{$profile->email}}" class="form-control">
                        @error('email')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                        <button type="submit" class="btn btn-success btn-sm">Update</button>
                </form>
            </div>
        </div>
   </div>
</div>

@endsection

<style>
    .breadcrumbs{
        list-style: none;
    }
    .breadcrumbs li{
        float:left;
        margin-right:10px;
    }
    .breadcrumbs li a:hover{
        text-decoration: none;
    }
    .breadcrumbs li .active{
        color:red;
    }
    .breadcrumbs li+li:before{
      content:"/\00a0";
    }
    .image{
        background:url('{{asset('backend/img/background.jpg')}}');
        height:150px;
        background-position:center;
        background-attachment:cover;
        position: relative;
    }
    .image img{
        position: absolute;
        top:55%;
        left:35%;
        margin-top:30%;
    }
    i{
        font-size: 14px;
        padding-right:8px;
    }
  </style>

