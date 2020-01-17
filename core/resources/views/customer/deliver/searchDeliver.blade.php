@extends('customer.layouts.master')
@section('content')
<div class="content p-4">
    <h2 class="mb-4" style="text-transform: uppercase;">{{__('Search Colis')}}
    </h2>
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('colis.deliver.search') }}" method="POST" id="form">
                @csrf
                <div class="row">                
                    <div class="col-md-10">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg search" name="search" placeholder="{{__('Barcode/Phone')}}" value="{{request()->search}}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block btn-lg search-btn"><i class='fa fa-search'></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @if(isset($colisList))
    <div class="card mb-4">
        <div class="card-body">
            <table id="table" class="table table-hover table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>{{__('Invoice Id')}}</th>
                        <th>{{__('Colis Code')}}</th>
                        <th>{{__('Sender Name')}}</th>
                        <th>{{__('Sender Phone')}}</th>
                        <th>{{__('Recipient Branch')}}</th>
                        <th>{{__('Recipient Name')}}</th>
                        <th>{{__('Recipient Phone')}}</th>
                        <th>{{__('Status')}}</th>
                        <th>{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($colisList as $colis)
                    <tr>
                        <td>{{ $colis->invoice_id }}</td>
                        <td>
                            {{ $colis->code }}
                        </td>
                        <td>{{ $colis->sender_name }}</td>
                        <td>{{ $colis->sender_phone }}</td>
                        <td>{{ $colis->receiver_branch->name }}</td>
                        <td>{{ $colis->receiver_name }}</td>
                        <td>{{ $colis->receiver_phone }}</td>
                        <td>{{ $colis->payment_status }}</td>
                        <td>
                            @if($colis->receiver_branch_id == Auth::user()->branch_id)
                            @if($colis->status  == 'Received' && $colis->payment_status=='Paid')
                            <button type="button" class="btn btn-primary btn-sm delete_button" data-toggle="modal" data-target="#receive{{ $colis->id }}">
                                <i class="fa fa-cart-arrow-down"></i>  Deliver Colis
                            </button>
                            <div class="modal fade" id="receive{{ $colis->id }}" role="dialog" aria-labelledby="#" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <form method="POST" action="{{ route('colis.receive') }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="receive{{ $colis->id }}"><i class="fa fa-download"></i>{{__('Deliver Colis')}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>{{__('Are you sure! You deliver this Colis ?')}}</strong></p>
                                                <input type="hidden" name="id" value="{{ $colis->id }}">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Close')}}</button>
                                                <button type="submit" class="btn btn-primary">{{__('Yes Deliver')}}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @elseif($colis->status=='Received' && $colis->payment_status=='Unpaid')
                            <button type="button" class="btn btn-primary btn-sm delete_button" data-toggle="modal" data-target="#receive{{ $colis->id }}">
                                <i class="fa fa-cart-arrow-down"></i>{{__('Deliver Colis')}}  
                            </button>
                            <div class="modal fade" id="receive{{ $colis->id }}" role="dialog" aria-labelledby="#" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <form method="POST" action="{{ route('colis.receive') }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="receive{{ $colis->id }}"><i class="fa fa-money-bill-alt"></i>{{__('Make Payment')}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="id" value="{{ $colis->id }}">
                                                <input type="hidden" name="payment_status" value="Paid">
                                                 <h5 class="text-danger text-center font-weight-bold">Please Collect {{ $colis->colis_product_infos->sum('colis_fee') }}&nbsp;{{ $gs->base_currency }}</h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Close')}}</button>
                                                <button type="submit" class="btn btn-primary">{{__('Paid & Delivered')}}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @else
                            <span class="btn btn-sm btn-success text-uppercase">{{ $colis->status }}</span>
                            @endif
                            @else
                            <span class="btn btn-sm btn-success text-uppercase">{{ $colis->status }}</span>
                            @endif
                            <a href="{{ route('colis.invoice',$colis->invoice_id) }}"><button class="btn btn-primary btn-sm"> <i class="fa fa-eye"></i>{{__('Colis Invoice')}} </button></a>                           
                        </td> 
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10">{{__('No Information')}}</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
<script type="text/javascript">
    $("#deliver").addClass("active");
</script>
@endsection