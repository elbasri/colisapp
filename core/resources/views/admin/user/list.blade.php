@extends('admin.layouts.master')
@section('content')
<div class="content p-4">
    <h2 class="mb-4" style="text-transform: uppercase;">{{__('Customer List')}} 
    </h2>
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12  mb-2">
                    <form method="GET" action="{{ route('admin.branch.customer',$branch) }}" class="form-inline float-right">
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
                        <th>{{__('Username')}}</th>
                        <th>{{__('Email')}}</th>
                        <th>{{__('Joined')}}</th>
                        <th>{{__('Type')}}</th>
                        <th>{{__('Status')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($userList as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->type }}<br>[ {{ $user->branch->name }} ]</td>
                        <td>
                            @if($user->status  == 'Active')
                            <span class="badge badge-success">{{__('Active')}}</span>
                            @else
                            <span class="badge badge-danger">{{__('Inactive')}}</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">{{__('No Information')}}</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
             {{ $userList->appends(['search'=>request()->search])->links() }}
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#branchManager").addClass("show");
    $("#branchManager li:nth-child(2)").addClass("active");
</script>
@endsection