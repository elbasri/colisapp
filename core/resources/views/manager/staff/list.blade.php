@extends('manager.layouts.master')
@section('content')
<div class="content p-4">
    <h2 class="mb-4" style="text-transform: uppercase;">{{__('All Branch Staff')}}
        <a href="{{ route('branchstaff.create') }}" class="btn btn-primary btn-md float-right">
            <i class="fa fa-list"></i>{{__('Add Branch Staff')}}  
        </a>
    </h2>
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12  mb-2">
                    <form method="GET" action="{{ route('branchstaff.index') }}" class="form-inline float-right">
                        @csrf
                        <div class="form-group">
                            &nbsp;<input type="text" class="form-control" name="search" placeholder="search" value="{{request()->search}}">
                        </div>&nbsp;
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>{{__('Search')}}</button>
                    </form>
                </div>
            </div>
            <table id="table" class="table table-hover table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>{{__('Id')}}</th>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Email')}}</th>
                        <th>{{__('Phone')}}</th>
                        <th>{{__('Branch')}}</th>
                        <th>{{__('Status')}}</th>
                        <th>{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($branchStaffList as $key=>$branchStaff)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $branchStaff->name }}</td>                       
                        <td>{{ $branchStaff->email }}</td>
                        <td>{{ $branchStaff->phone }}</td>
                        <td>{{ $branchStaff->branch->name }}</td>
                        <td>
                            @if($branchStaff->status  == 'Active')
                            <span class="badge badge-success">{{__('Active')}}</span>
                            @else
                            <span class="badge badge-danger">{{__('Inactive')}}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('branchstaff.edit',$branchStaff->id) }}"><button class="btn btn-info btn-sm"> <i class="fa fa-edit"></i>{{__('EDIT')}} </button></a>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#changePassword{{ $branchStaff->id }}">
                                <i class="fa fa-edit"></i>{{__('Change Password')}}  
                            </button>
                            <div class="modal fade" id="changePassword{{ $branchStaff->id }}" role="dialog" aria-labelledby="#changePassword" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <form method="POST" action="{{ route('branchstaff.changepassword') }}">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="changePassword{{ $branchStaff->id }}"><i class="fa fa-edit"></i>&nbsp;{{__('Change Manager Password')}} !</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-md-12  container-fluid">
                                                    <div class="form-group">
                                                        <label for="newword" class="text-uppercase"><strong>{{__('New Password')}}</strong></label>
                                                        <input type="password" class="form-control form-control-lg mb-3" id="newword" name="newword" placeholder="New Password">
                                                        <input type="hidden" name="id" value="{{ $branchStaff->id }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-12  container-fluid">
                                                    <div class="form-group">
                                                        <label for="newword_confirmation" class="text-uppercase"><strong>{{__('Re-type Password')}}</strong></label>
                                                        <input type="password" class="form-control form-control-lg mb-3"  id="newword_confirmation" name="newword_confirmation" placeholder="Enter Password Again">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-info">{{__('Change Password')}}</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('No')}}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td> 
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center">{{__('No Information')}}</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $branchStaffList->appends(['search'=>request()->search])->links() }}
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#branchStaff").addClass("show");
    $("#branchStaff li:nth-child(2)").addClass("active");
</script>
@endsection