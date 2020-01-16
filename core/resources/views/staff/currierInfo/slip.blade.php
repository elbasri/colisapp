@extends('staff.layouts.master')
@section('content')
<div class="content p-4">
    <h2 class="mb-4" style="text-transform: uppercase;">{{__('Courier Slip')}}<hr></h2>
    <div class="card">
        <div  id="printDiv">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <strong>{{__('Invoice No')}} :
                            {{ $currierInfo->invoice_id }}
                        </strong> 
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
                               <img src="{{asset('assets/frontend/images/logo.png')}}" alt=""  style="width:100%;">
                            </div>
                            <div class="col-md-4">
                                <strong>{{__('Receive Date')}} : </strong><p style="font-size:16px;">{{ $currierInfo->created_at->toDateString() }}</p>
                            </div>
                        </div>
                    </div><hr>
                </div>
                <div class="row mb-4">
                    <div class="col-md-4 offset-md-2">
                        <h6 class="mb-2">{{__('Sender Details')}}:</h6>
                        <div><strong>{{__('Branch')}}&nbsp;&nbsp;:</strong>&nbsp;{{ $currierInfo->branch->name }}</div>
                        <div><strong>{{__('Name')}}&nbsp;&nbsp;&nbsp;&nbsp;:</strong>&nbsp;{{ $currierInfo->sender_name }}</div>
                        @if($currierInfo->sender_email)
                        <div><strong>{{__('Email')}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong>&nbsp;{{ $currierInfo->sender_email }}</div>
                        @endif
                        <div><strong>{{__('Phone')}}&nbsp;&nbsp;&nbsp;&nbsp;:</strong>&nbsp;{{ $currierInfo->sender_phone }}</div>
                        @if($currierInfo->sender_address)
                        <div><strong>{{__('Address')}}&nbsp;:</strong>&nbsp;{!! $currierInfo->sender_address !!}</div>
                        @endif
                    </div>
                    <div class="col-md-4 offset-md-2">
                        <h6 class="mb-2">{{__('Receiver Details')}}:</h6>
                        <div><strong>{{__('Branch')}}&nbsp;&nbsp;:</strong>&nbsp;{{ $currierInfo->branch->name }}</div>
                        <div><strong>{{__('Name')}}&nbsp;&nbsp;&nbsp;&nbsp;:</strong>&nbsp;{{ $currierInfo->receiver_name }}</div>
                        @if($currierInfo->receiver_email)
                        <div><strong>{{__('Email')}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong>&nbsp;{{ $currierInfo->receiver_email }}</div>
                        @endif
                        <div><strong>{{__('Phone')}}&nbsp;&nbsp;&nbsp;&nbsp;:</strong>&nbsp;{{ $currierInfo->receiver_phone }}</div>
                        @if($currierInfo->receiver_address)
                        <div><strong>{{__('Address')}}&nbsp;:</strong>&nbsp;{{ $currierInfo->receiver_address }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="container mb-2">               
            <button type="button" onclick="printDiv();" value="print" class="btn btn-primary razu"><i class="fa fa-print"></i>&nbsp;{{__('Print Slip')}}</button>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#home").addClass("active");
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
        newWin.document.write('<html><head><title>eCourier Management System</title></head>');
        newWin.document.write('<body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');
        newWin.document.write('<link rel="stylesheet" href="{{asset('assets/user/css/bootstrap.min.css')}}">');
        newWin.document.close();
        setTimeout(function () {
            newWin.close();
        }, 1000);

    }
</script>
@endsection

