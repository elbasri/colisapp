@extends('customer.layouts.master')
@section('content')
<div class="content p-4">
    <h2 class="mb-4" style="text-transform: uppercase;">{{__('All Colis List')}}
        <a href="{{ route('colis.create') }}" class="btn btn-primary btn-md float-right">
            <i class="fa fa-list"></i>{{__('Add Colis')}}   
        </a>
    </h2>
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <form method="GET" action="{{ route('colis.index') }}" class="form-inline">
                        @csrf
                        <div class="form-group mb-1">
                            <label for="date1">{{__('Start Date')}} :</label>
                            &nbsp;<input type="text" class="form-control" name="start_date" id="date1" placeholder="yyyy-mm-dd" value="{{request()->start_date}}">
                        </div>&nbsp;
                        <div class="form-group mb-1">
                            <label for="date2">{{__('End Date')}} :</label>
                            &nbsp;<input type="text" class="form-control" name="end_date" id="date2" placeholder="yyyy-mm-dd" value="{{request()->end_date}}">
                        </div>&nbsp;
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>{{__('View Colis')}}</button>
                    </form>
                </div>
                <div class="col-md-4  mb-2">
                    <form method="GET" action="{{ route('colis.index') }}" class="form-inline float-right">
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
                        <th>{{__('Invoice Id')}}</th>
                        <th>{{__('Colis Code')}}</th>
                        <th>{{__('Sender Name')}}</th>
                        <th>{{__('Sender Phone')}}</th>
                        <th>{{__('Recipient Branch')}}</th>
                        <th>{{__('Recipient Name')}}</th>
                        <th>{{__('Recipient Phone')}}</th>
                        <th>{{__('Receive')}}</th>
                        <th>{{__('Status')}}</th>
                        <th>{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($colisList as $key=>$colis)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $colis->invoice_id }}</td>
                        <td>
                            {{ App\Model\ColisProductInfo::where('colis_info_id',$colis->id)->first()->colis_code }}
                        </td>
                        <td>{{ $colis->sender_name }}</td>
                        <td>{{ $colis->sender_phone }}</td>
                        <td>{{ $colis->branch->name }}</td>
                        <td>{{ $colis->receiver_name }}</td>
                        <td>{{ $colis->receiver_phone }}</td>
                        @if($colis->receiver_branch_id == Auth::user()->branch_id && $colis->status== 'Delivered')
                        <td>
                            <button type="button" class="btn btn-danger btn-sm delete_button" data-toggle="modal" data-target="#receive{{ $colis->id }}">
                                <i class="fa fa-check"></i>{{__('Receive Colis')}}  
                            </button>
                            <div class="modal fade" id="receive{{ $colis->id }}" role="dialog" aria-labelledby="#" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <form method="POST" action="{{ route('colis.receive') }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="receive{{ $colis->id }}"><i class="fa fa-download"></i>&nbsp;{{__('Receive Colis')}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>{{__('Are you sure! You receive this Colis')}} ?</strong></p>
                                                <input type="hidden" name="id" value="{{ $colis->id }}">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Close')}}</button>
                                                <button type="submit" class="btn btn-danger">{{__('Yes Receive')}}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                        @else
                        <td class="text-center">
                            @if($colis->status== 'Delivered')
                            <i class="fa fa-times fa-2x" style="color:grey;"></i>
                            @else
                            <p>{{__('Received at')}} <br>[ {{ $colis->created_at->toDateString() }} ]</p>
                            @endif
                        </td>
                        @endif
                        <td>
                            @if($colis->status  == 'Delivered')
                            <span class="btn btn-sm btn-danger text-uppercase">{{ $colis->status }}</span>
                            @else
                            <span class="btn btn-sm btn-success text-uppercase">{{ $colis->status }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('colis.invoice',$colis->invoice_id) }}"><button class="btn btn-primary btn-sm"> <i class="fa fa-eye"></i>{{__('Colis Invoice')}} </button></a>                           
                        </td> 
                    </tr>
                    @empty
                    <tr>
                        <td colspan="15" class="text-center">{{__('No Information')}}</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $colisList->appends(['search'=>request()->search,'start_date'=>request()->start_date,'end_date'=>request()->end_date])->links() }}
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#colisInfo").addClass("show");
    $("#colisInfo li:nth-child(2)").addClass("active");

</script>
@endsection