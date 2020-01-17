@extends('admin.layouts.master')
@section('content')
<div class="content p-4">
    <h2 class="mb-4" style="text-transform: uppercase;">{{__('All Type List')}}
        <a href="{{ route('type.create') }}" class="btn btn-primary btn-md float-right">
            <i class="fa fa-list"></i>   {{__('Add Type')}}
        </a>
    </h2>
    <div class="card mb-4">
        <div class="card-body">
            <table id="table" class="table table-hover table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Unit')}}</th>
                        <th>{{__('Price')}}</th>
                        <th>{{__('Status')}}</th>
                        <th>{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($colisTypeList as $colisType)
                    <tr>
                        <td>{{ $colisType->name }}</td>
                        <td>{{ $colisType->unit->name }}</td>
                        <td>{{ $colisType->price }}</td>
                        <td>
                            @if($colisType->status  == 'Active')
                            <span class="badge badge-success">{{__('Active')}}</span>
                            @else
                            <span class="badge badge-danger">{{__('Inactive')}}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('type.edit',$colisType->id) }}"><button class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i> {{__('EDIT')}}</button></a>                           
                        </td> 
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#colisSetting").addClass("show");
    $("#colisSetting li:nth-child(2)").addClass("active");
    $(document).ready(function () {
        $('#table').DataTable();
    });
</script>
@endsection