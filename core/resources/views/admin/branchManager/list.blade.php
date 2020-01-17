@extends('admin.layouts.master')
@section('content')
<div class="content p-4">
    <h2 class="mb-4" style="text-transform: uppercase;">{{__('All Branch Manager')}}
        <a href="{{ route('branchmanager.create') }}" class="btn btn-primary btn-md float-right">
            <i class="fa fa-list"></i>{{__('Add Branch Manager')}}   
        </a>
    </h2>
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12  mb-2">
                    <form method="GET" action="{{ route('branchmanager.index') }}" class="form-inline float-right">
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
                    @forelse($branchManagerList as $key=>$branchManager)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $branchManager->name }}</td>                       
                        <td>{{ $branchManager->email }}</td>
                        <td>{{ $branchManager->phone }}</td>
                        <td>{{ $branchManager->branch->name }}</td>
                        <td>
                            @if($branchManager->status  == 'Active')
                            <span class="badge badge-success">{{__('Active')}}</span>
                            @else
                            <span class="badge badge-danger">{{__('Inactive')}}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('branchmanager.edit',$branchManager->id) }}"><button class="btn btn-info btn-sm"> <i class="fa fa-edit"></i>{{__('EDIT')}} </button></a>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#changePassword{{ $branchManager->id }}">
                                <i class="fa fa-edit"></i>{{__('Change Password')}}  
                            </button>
                            <div class="modal fade" id="changePassword{{ $branchManager->id }}" role="dialog" aria-labelledby="#changePassword" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <form method="POST" action="{{ route('branchmanager.changepassword') }}">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="changePassword{{ $branchManager->id }}"><i class="fa fa-edit"></i>&nbsp;{{__('Change Manager Password')}} !</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-md-12  container-fluid">
                                                    <div class="form-group">
                                                        <label for="newword" class="text-uppercase"><strong>{{__('New Password')}}</strong></label>
                                                        <input type="password" class="form-control form-control-lg mb-3" id="newword" name="newword" placeholder="{{__('New Password')}}">
                                                        <input type="hidden" name="id" value="{{ $branchManager->id }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-12  container-fluid">
                                                    <div class="form-group">
                                                        <label for="newword_confirmation" class="text-uppercase"><strong>{{__('Re-type Password')}}</strong></label>
                                                        <input type="password" class="form-control form-control-lg mb-3"  id="newword_confirmation" name="newword_confirmation" placeholder="{{__('Enter Password Again')}}">
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
                            <a href="{{ route('admin.branch.customer',$branchManager->branch_id) }}"><button class="btn btn-primary btn-sm"> <i class="fa fa-eye"></i>{{__('Customer')}} </button></a>
                        </td> 
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center">{{__('No Information')}}</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $branchManagerList->appends(['search'=>request()->search])->links() }}
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#branchManager").addClass("show");
    $("#branchManager li:nth-child(2)").addClass("active");
</script>
@endsection