@extends('manager.layouts.master')
@section('content')
<div class="content p-4">
    <h2 class="mb-4" style="text-transform: uppercase;">{{__('Departure Courier List')}}
    </h2>
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <form method="GET" action="{{ route('departure.manager') }}" class="form-inline">
                        @csrf
                        <div class="form-group mb-1">
                            <label for="date1">{{__('Start Date')}} :</label>
                            &nbsp;<input type="text" class="form-control" name="start_date" id="date1" placeholder="yyyy-mm-dd" value="{{request()->start_date}}">
                        </div>&nbsp;
                        <div class="form-group mb-1">
                            <label for="date2">{{__('End Date')}} :</label>
                            &nbsp;<input type="text" class="form-control" name="end_date" id="date2" placeholder="yyyy-mm-dd" value="{{request()->end_date}}">
                        </div>&nbsp;
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>{{__('View Courier')}}</button>
                    </form>
                </div>
                <div class="col-md-4  mb-2">
                    <form method="GET" action="{{ route('departure.manager') }}" class="form-inline float-right">
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
                        <th>{{__('SL')}}</th>
                        <th>{{__('Courier Invoice No')}}</th>
                        <th>{{__('Courier Date')}}</th>
                        <th>{{__('Sender Name')}}</th>
                        <th>{{__('Recipient Branch')}}</th>
                        <th>{{__('Recipient Name')}}</th>
                        <th>{{__('Status')}}</th>
                        <th>{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($currierList as $key=>$currier)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $currier->invoice_id }}</td>
                        <td>{{ $currier->created_at->toDateString() }}</td>
                        <td>{{ $currier->sender_name }}</td>
                        <td>{{ $currier->receiver_branch->name }}</td>
                        <td>{{ $currier->receiver_name }}</td>

                        <td>
                            @if($currier->status  == 'Delivered')
                            <span class="btn btn-sm btn-success text-uppercase">{{__('Delivered')}}</span>
                            @else
                            <span class="btn btn-sm btn-info text-uppercase">{{__('Received')}}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('manager.departure.invoice',$currier->invoice_id) }}"><button class="btn btn-primary btn-sm"> <i class="fa fa-eye"></i> {{__('Courier Invoice')}}</button></a>  
                        </td> 
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center">{{__('No Information')}}</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $currierList->appends(['search'=>request()->search,'start_date'=>request()->start_date,'end_date'=>request()->end_date])->links() }}
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#currierInfo").addClass("show");
    $("#currierInfo li:nth-child(1)").addClass("active");

</script>
@endsection