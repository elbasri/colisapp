@extends('manager.layouts.master')
@section('content')
<div class="content p-4">
    <h2 class="mb-4" style="text-transform: uppercase;">{{__('Colis Invoice')}}<hr></h2>
    <div class="card">
        <div  id="printDiv">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <strong>{{__('Invoice No')}} :
                            {{ $colisInfo->invoice_id }}</strong> 
                    </div>

                    <div class="col-md-6">
                        <span class="float-right"> <strong>{{__('Status')}}:&nbsp;&nbsp;</strong>
                            @if($colisInfo->status == 'Delivered')
                            <span class="btn btn-sm btn-danger text-uppercase">{{$colisInfo->status}}</span>
							@else
							<span class="btn btn-sm btn-success text-uppercase">{{$colisInfo->status}}</span>
                            @endif
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="col-md-12 text-center mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                {!! $code !!}
                            </div>
                            <div class="col-md-4">
                                <strong  style="font-size:18px;"> <img src="{{asset('assets/frontend/images/logo.png')}}" alt=""></strong>
                            </div>
                            <div class="col-md-4">
                                <strong>{{__('Receive Date')}} : </strong><p style="font-size:16px;">{{ $colisInfo->created_at->toDateString() }}</p>
                            </div>
                        </div>
                    </div><hr>
                </div>
                <div class="row mb-4">
                    <div class="col-md-4 offset-md-2">
                        <h6 class="mb-2">{{__('Sender Details')}}:</h6>
                        <div><strong>{{__('Branch')}}&nbsp;&nbsp;:</strong>&nbsp;{{ $colisInfo->branch->name }}</div>
                        <div><strong>{{__('Name')}}&nbsp;&nbsp;&nbsp;&nbsp;:</strong>&nbsp;{{ $colisInfo->sender_name }}</div>
                        @if($colisInfo->sender_email)
                        <div><strong>{{__('Email')}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong>&nbsp;{{ $colisInfo->sender_email }}</div>
                        @endif
                        <div><strong>{{__('Phone')}}&nbsp;&nbsp;&nbsp;&nbsp;:</strong>&nbsp;{{ $colisInfo->sender_phone }}</div>
                        @if($colisInfo->sender_address)
                        <div><strong>{{__('Address')}}&nbsp;:</strong>&nbsp;{!! $colisInfo->sender_address !!}</div>
                        @endif
                    </div>
                    <div class="col-md-4 offset-md-2">
                        <h6 class="mb-2">{{__('')}}Receiver Details:</h6>
                        <div><strong>{{__('Branch')}}&nbsp;&nbsp;:</strong>&nbsp;{{ $colisInfo->branch->name }}</div>
                        <div><strong>{{__('')}}Name&nbsp;&nbsp;&nbsp;&nbsp;:</strong>&nbsp;{{ $colisInfo->receiver_name }}</div>
                        @if($colisInfo->receiver_email)
                        <div><strong>{{__('Email')}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong>&nbsp;{{ $colisInfo->receiver_email }}</div>
                        @endif
                        <div><strong>{{__('Phone')}}&nbsp;&nbsp;&nbsp;&nbsp;:</strong>&nbsp;{{ $colisInfo->receiver_phone }}</div>
                        @if($colisInfo->receiver_address)
                        <div><strong>{{__('Address')}}&nbsp;:</strong>&nbsp;{{ $colisInfo->receiver_address }}</div>
                        @endif
                    </div>
                </div>
                <div class="container">
                    <div class="table-responsive-sm">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th>{{__('Colis Type')}}</th>
                                    <th>{{__('Sending Date')}}</th>
                                    <th>{{__('Colis Quantity')}}</th>
                                    <th>{{__('Colis Fee')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($colisProductInfoList as $key=>$colisProductInfo)
                                <tr>
                                    <td class="center">{{ $key+1 }}</td>
                                    <td class="left">{{ $colisProductInfo->colis_types->name }}</td>
                                    <td class="right">{{ $colisProductInfo->created_at->toDateTimeString() }}</td>
                                    <td class="right">{{ $colisProductInfo->colis_quantity }}&nbsp;{{ $colisProductInfo->colis_types->unit->name }} </td>
                                    <td class="center fee">{{ $colisProductInfo->colis_fee }} {{ $gs->base_currency_symbol }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-sm-5">
                        </div>
                        <div class="col-lg-4 col-sm-5 ml-auto">
                            <table class="table table-clear">
                                <tbody>
                                    <tr>
                                        <td class="left">
                                            <strong>{{__('Total')}}</strong>
                                        </td>
                                        <td class="right">
                                            <strong><span class="totalPrice">450</span> {{ $gs->base_currency_symbol }}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="left">
                                            <strong>{{__('Payment Status')}}</strong>
                                        </td>
                                        <td class="right">
                                            @if($colisInfo->payment_status=='Unpaid')
                                            <strong><span class="text-uppercase">{{ $colisInfo->payment_status }}</span></strong>
                                            @else
                                            <strong><span class="text-uppercase">{{ $colisInfo->payment_status }}</span></strong>
                                            @endif
                                        </td>
                                    </tr>
                                    @if($colisInfo->payment_status =='Paid')
                                    <tr>
                                        <td class="left">
                                            <strong>{{__('Payment Receiver Name')}}</strong>
                                        </td>
                                        <td class="right">
                                            <strong><span class="text-uppercase">{{ $colisInfo->payment_receiver->name }}</span></strong>&nbsp;<br>[{{$colisInfo->payment_receiver->type}}]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="left">
                                            <strong>{{__('Branch')}}</strong>
                                        </td>
                                        <td class="right">
                                            <strong><span class="text-uppercase">{{ $colisInfo->payment_receiver->branch->name }}</span></strong>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2 ml-2">
            <div class="container">
                <button type="button" onclick="printDiv();" value="print" class="btn btn-info razu"><i class="fa fa-print"></i>&nbsp;{{__('Print Colis')}}</button>
                <a href="{{ route('manager.colis.slip',$colisInfo->id) }}" target="_blank"><button class="btn btn-primary"><i class="fa fa-print"></i> {{__('Print Slip')}}</button></a> 
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#colisInfo").addClass("show");
    $("#colisInfo li:nth-child(1)").addClass("active");
    $(document).ready(function () {
        totalPrice = 0;
        $(".fee").each(function () {
            totalPrice += parseInt($(this).html());
        });
        $(".totalPrice").text(totalPrice);
    });

    function printDiv()
    {

        var divToPrint = document.getElementById('printDiv');
        var newWin = window.open('', 'Print-Window');
        newWin.document.open();
        newWin.document.write('<html><head><title>eColis Management System</title></head>');
        newWin.document.write('<body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');
        newWin.document.write('<link rel="stylesheet" href="{{asset('assets/user/css/bootstrap.min.css')}}">');
        newWin.document.close();
        setTimeout(function () {
            newWin.close();
        }, 1000);

    }
</script>
@endsection

