@extends('manager.layouts.master')
@section('content')
<div class="content p-4">
    <h2 class="mb-4" style="text-transform: uppercase;">{{__('Change Password')}}</h2>
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('manager.changepassword') }}" method="post">
                @csrf
                @method('PUT')
                <div class="col-md-12  container-fluid">
                    <div class="form-group">
                        <label for="oldword" style="text-transform: uppercase;"><strong>{{__('Current Password')}}</strong></label>
                        <input type="password" class="form-control form-control-lg mb-3"  id="oldword" name="oldword" placeholder="{{__('Enter Current Password')}}">
                    </div>
                </div>
                <div class="col-md-12  container-fluid">
                    <div class="form-group">
                        <label for="newword" class="text-uppercase"><strong>{{__('New Password')}}</strong></label>
                        <input type="password" class="form-control form-control-lg mb-3" id="newword" name="newword" placeholder="{{__('New Password')}}">
                    </div>
                </div>
                <div class="col-md-12  container-fluid">
                    <div class="form-group">
                        <label for="newword_confirmation" class="text-uppercase"><strong>{{__('Re-type Password')}}</strong></label>
                        <input type="password" class="form-control form-control-lg mb-3"  id="newword_confirmation" name="newword_confirmation" placeholder="{{__('Enter Password Again')}}">
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-block btn-lg text-uppercase">{{__('Update')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>		
@endsection
