@extends('admin.layouts.master')
@section('content')
<div class="content p-4">
    <h2 class="mb-4" style="text-transform: uppercase;">{{__('All Branch')}}
        <a href="{{ route('branch.create') }}" class="btn btn-primary btn-md float-right">
            <i class="fa fa-list"></i>{{__('Add Branch')}}   
        </a>
    </h2>
    <div class="card mb-4">
        <div class="card-body">
            <table id="table" class="table table-hover table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Email')}}</th>
                        <th>{{__('Phone')}}</th>
                        <th>{{__('Address')}}</th>
                        <th>{{__('Status')}}</th>
                        <th>{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($branchList as $branch)
                    <tr>
                        <td>{{ $branch->name }}</td>
                        <td>{{ $branch->email }}</td>
                        <td>{{ $branch->phone }}</td>
                        <td>{{ $branch->address }}</td>
                        <td>
                            @if($branch->status  == 'Active')
                            <span class="badge badge-success">{{__('Active')}}</span>
                            @else
                            <span class="badge badge-danger">{{__('Inactive')}}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('branch.edit',$branch->id) }}"><button class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i>{{__('EDIT')}} </button></a>                           
                        </td> 
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#branch").addClass("show");
    $("#branch li:nth-child(2)").addClass("active");
    $(document).ready(function () {
        $('#table').DataTable();
    });
</script>
@endsection