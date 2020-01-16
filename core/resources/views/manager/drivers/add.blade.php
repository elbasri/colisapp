@extends('manager.layouts.master')
@section('content')
<div class="content p-4">
    <h2 class="mb-4" style="text-transform: uppercase;">{{__('Create Driver')}} 
        <a href="{{ route('drivers.list') }}" class="btn btn-primary btn-md float-right">
            <i class="fa fa-list"></i>{{__('View Drivers')}}   
        </a>
    </h2>
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('drivers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6  container-fluid">
                        <div class="form-group">
                            <label for="name" style="text-transform: uppercase;"><strong>{{__('Name')}}&nbsp;<span class="mark">*</span></strong></label>
                            <input class="form-control form-control-lg mb-3" type="text" name="name"  value="{{ old('name') }}" placeholder="Driver Name">
                        </div>
                    </div>
                    <div class="col-md-6 container-fluid">
                        <div class="form-group">
                            <label for="email" style="text-transform: uppercase;"><strong>{{__('Email')}}&nbsp;<span class="mark">*</span></strong></label>
                            <input class="form-control form-control-lg mb-3" type="email" name="email"  value="{{ old('email') }}" placeholder="Driver Email">
                        </div>
                    </div>
                    <div class="col-md-6 container-fluid">
                        <div class="form-group">
                            <label for="phone" style="text-transform: uppercase;"><strong>{{__('Phone')}}</strong></label>
                            <input class="form-control form-control-lg mb-3" type="text" name="phone"  value="{{ old('phone') }}" placeholder="Driver Phone">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password" style="text-transform: uppercase;"><strong>{{__('Password')}}&nbsp;<span class="mark">*</span></strong></label>
                            <input type="password" class="form-control form-control-lg mb-3"  id="password" name="password" placeholder="Driver Password">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status" style="text-transform: uppercase;"><strong>{{__('Address')}}</strong></label>
                            <input class="form-control form-control-lg mb-3" type="text" name="address"  value="{{ old('address') }}" placeholder="Driver Phone">

                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status" style="text-transform: uppercase;"><strong>{{__('City')}}</strong></label>
                            <input class="form-control form-control-lg mb-3" type="text" name="city"  value="{{ old('city') }}" placeholder="Driver Phone">

                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status" style="text-transform: uppercase;"><strong>{{__('Matricule')}}</strong></label>
                            <input class="form-control form-control-lg mb-3" type="text" name="matricule"  value="{{ old('matricule') }}" placeholder="Driver Phone">

                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status" style="text-transform: uppercase;"><strong>{{__('Identity Number')}}</strong></label>
                            <input class="form-control form-control-lg mb-3" type="text" name="identity_number"  value="{{ old('identity_number') }}" placeholder="Driver Phone">

                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status" style="text-transform: uppercase;"><strong>{{__('RIB')}}</strong></label>
                            <input class="form-control form-control-lg mb-3" type="text" name="rib"  value="{{ old('rib') }}" placeholder="Driver Phone">

                        </div>
                    </div> 
                </div> 
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">{{__('Create New Driver')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#zz").addClass("show");
    $("#zz li:nth-child(2)").addClass("active");
</script>
@endsection