@extends('manager.layouts.master')
@section('content')
<div class="content p-4">
    <h2 class="mb-4" style="text-transform: uppercase;">{{__('All Branch')}} </h2>
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12  mb-2">
                    <form method="GET" action="{{ route('manager.branchlist') }}" class="form-inline float-right">
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
                        <th>{{__('Address')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($branchList as $key=>$branch)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $branch->name }}</td>                       
                        <td>{{ $branch->email }}</td>
                        <td>{{ $branch->phone }}</td>
                        <td>{{ $branch->address }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">{{__('No Information')}}</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $branchList->appends(['search'=>request()->search])->links() }}
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#allbranch").addClass("active");

</script>
@endsection