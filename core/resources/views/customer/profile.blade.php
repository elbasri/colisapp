@extends('customer.layouts.master')
@section('content')
<div class="content p-4">
    <h2 class="mb-4" style="text-transform: uppercase;">{{__('Profile')}}</h2>
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('customer.profile') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row container-fluid">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="type" style="text-transform: uppercase;"><strong>{{__('Branch')}}</strong></label>
                            <input class="form-control form-control-lg mb-3" type="text" readonly="" value="{{ Auth::user()->branch->name }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="type" style="text-transform: uppercase;"><strong>{{__('Type')}}</strong></label>
                            <input class="form-control form-control-lg mb-3" type="text" readonly="" value="{{ Auth::user()->type }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" style="text-transform: uppercase;"><strong>{{__('Name')}}</strong></label>
                            <input class="form-control form-control-lg mb-3" type="text" name="name" placeholder="{{__('Enter Name')}}" value="{{ Auth::user()->name }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email" style="text-transform: uppercase;"><strong>{{__('Email')}}</strong></label>
                            <input class="form-control form-control-lg mb-3" type="text" name="email" placeholder="{{__('Enter Email')}}" value="{{ Auth::user()->email }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone" style="text-transform: uppercase;"><strong>{{__('Phone')}}</strong></label>
                            <input class="form-control form-control-lg mb-3" type="text" name="phone" placeholder="{{__('Enter Phone')}}" value="{{ Auth::user()->phone }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image" style="text-transform: uppercase;"><strong>{{__('Image')}}</strong></label>
                            <input class="form-control form-control-lg mb-3" type="file" name="image" >
                        </div>
                    </div>
                </div>
                <div class="col-md-12 offset-md-6 container-fluid">
                    <div class="form-group">
                        @if(Auth::user()->image)
                        <img style="width: 100px;height: 100px;" class="thumbnail img-responsive" src="{{asset('assets/customer/img/profile/'.Auth::user()->image)}}"/>
                        @else
                        <div class="col-md-3 bg-danger p-2">
                            <span class="text-white">
                                {{__('No Image Provided')}}
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">{{__('UPDATE')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection