@extends('manager.layouts.master')
@section('content')
<div class="content p-4">
    <h2 class="mb-4" style="text-transform: uppercase;">{{__('Edit Branch Customer')}}
        <a href="{{ route('branchcustomer.index') }}" class="btn btn-primary btn-md float-right">
            <i class="fa fa-list"></i>{{__('View Branch Customer')}}   
        </a>
    </h2>
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('branchcustomer.update',$branchcustomer->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12  container-fluid">
                        <div class="form-group">
                            <label for="name" style="text-transform: uppercase;"><strong>{{__('Name')}}&nbsp;<span class="mark">*</span></strong></label>
                            <input class="form-control form-control-lg mb-3" type="text" name="name"  value="{{ $branchcustomer->name ?? old('name') }}" placeholder="{{__('Branch Customer Name')}}">
                        </div>
                    </div>
                    <div class="col-md-12 container-fluid">
                        <div class="form-group">
                            <label for="email" style="text-transform: uppercase;"><strong>{{__('Email')}}&nbsp;<span class="mark">*</span></strong></label>
                            <input class="form-control form-control-lg mb-3" type="email" name="email"  value="{{ $branchcustomer->email ?? old('email') }}" placeholder="{{__('Branch Customer Email')}}">
                        </div>
                    </div>
                    <div class="col-md-12 container-fluid">
                        <div class="form-group">
                            <label for="phone" style="text-transform: uppercase;"><strong>{{__('Phone')}}</strong></label>
                            <input class="form-control form-control-lg mb-3" type="text" name="phone"  value="{{ $branchcustomer->phone ?? old('phone') }}" placeholder="{{__('Branch Customer Phone')}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status" style="text-transform: uppercase;"><strong>{{__('Status')}}</strong></label>
                            <input type="checkbox" data-onstyle="success" data-offstyle="danger" data-width="100%" data-on="Active" data-off="Inactive" data-toggle="toggle" name="status" {{ $branchcustomer->status=='Active' ? 'checked' : '' }}>
                        </div>
                    </div> 
                </div> 
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">{{__('Create New Branch')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#branchCustomer").addClass("show");
    $("#branchCustomer li:nth-child(2)").addClass("active");
</script>
@endsection