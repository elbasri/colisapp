@extends('admin.layouts.master')
@section('content')
<div class="content p-4">
    <h2 class="mb-4" style="text-transform: uppercase;">{{ $branchName->name }} {{__('Branch Income List')}}
        <a href="{{ route('admin.company.income') }}" class="btn btn-primary btn-md float-right">
            <i class="fa fa-arrow-circle-left"></i>  {{__('Go Back')}}
        </a>
    </h2>
    <div class="card mb-4">
        <div class="card-body">
            <table id="table" class="table table-hover table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>{{__('SL')}}</th>
                        <th>{{__('Date')}}</th>
                        <th>{{__('Branch Income')}}</th>
                        <th>{{__('Cash Receiver Name')}}</th>
                    </tr>
                </thead>
                <tbody class="branch_income">
                    @forelse($branchIncomeList as $key=>$branchIncome)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $branchIncome->payment_date }}</td>
                        <td>{{ $branchIncome->total_balance }}&nbsp;{{ $gs->base_currency }}</td>
                        <td><a href="{{ route("admin.branch.income.customer",[$branch,$branchIncome->payment_receiver_id]) }}">{{ $branchIncome->payment_receiver->name }} [{{ $branchIncome->payment_receiver->type }}]</a></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">{{__('No Information')}}</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $branchIncomeList->links() }}
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#companyIncomeList").addClass("active");
</script>
@endsection