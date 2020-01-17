<?php

namespace App\Http\Controllers\Manager;

use App\Model\ColisInfo;
use App\Model\ColisType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Branch;
use Illuminate\Support\Facades\Auth;
use App\Model\GeneralSetting;
use App\Model\ColisProductInfo;
use Illuminate\Support\Str;
use App\User;
use DB;

class CompanyPaymentController extends Controller {

    public function branchWiseIncome(Request $request) {

        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $customer = $request->customer_id;

        if (!empty($start_date) && !empty($end_date) && !empty($customer)) {
            $branchIncomeList = ColisInfo::where('payment_branch_id', Auth::user()->branch_id)
                            ->where(function($q) use($start_date, $end_date, $customer) {
                                $q->whereBetween('payment_date', [$start_date, $end_date])
                                ->where('payment_receiver_id', $customer);
                            })
                            ->select(DB::raw("*,SUM(payment_balance) as total_balance"))
                            ->groupBy('payment_date')->paginate(10);
        } elseif (!empty($start_date) && !empty($end_date)) {
            $branchIncomeList = ColisInfo::where('payment_branch_id', Auth::user()->branch_id)
                            ->where(function($q) use($start_date, $end_date) {
                                $q->whereBetween('payment_date', [$start_date, $end_date]);
                            })
                            ->select(DB::raw("*,SUM(payment_balance) as total_balance"))
                            ->groupBy('payment_date')->paginate(10);
        } elseif (!empty($customer)) {
            $branchIncomeList = ColisInfo::where('payment_branch_id', Auth::user()->branch_id)
                            ->where(function($q) use($customer) {
                                $q->where('payment_receiver_id', $customer);
                            })
                            ->select(DB::raw("*,SUM(payment_balance) as total_balance"))
                            ->groupBy('payment_date')->paginate(10);
        } else {

            $branchIncomeList = ColisInfo::where('payment_branch_id', Auth::user()->branch_id)
                            ->select(DB::raw("*,SUM(payment_balance) as total_balance"))
                            ->groupBy('payment_date')->paginate(10);
        }
        $branchCustomer = User::where([['branch_id', Auth::user()->branch_id], ['type', 'Customer']])->get();
        return view('manager.branchIncome.list', compact('branchIncomeList','branchCustomer'));
    }

    public function dateWiseBranchIncome(Request $request, $date) {

        $customer = $request->search;

        if (!empty($customer)) {
            $branchIncomeList = ColisInfo::where('payment_branch_id', Auth::user()->branch_id)
                            ->whereDate('payment_date', $date)
                            ->select(DB::raw("*,SUM(payment_balance) as total_balance"))
                            ->groupBy('payment_receiver_id')->paginate(10);
        } else {
            $branchIncomeList = ColisInfo::where('payment_branch_id', Auth::user()->branch_id)
                            ->whereDate('payment_date', $date)
                            ->select(DB::raw("*,SUM(payment_balance) as total_balance"))
                            ->groupBy('payment_receiver_id')->paginate(10);
        }

        return view('manager.branchIncome.dateIncome', compact('branchIncomeList', 'date'));
    }

    public function customerWiseBranchIncome($customer) {

        $branchIncomeList = ColisInfo::where([['payment_branch_id', Auth::user()->branch_id], ['payment_receiver_id', $customer]])
                ->paginate(10);
        return view('manager.branchIncome.customerIncome', compact('branchIncomeList'));
    }

}
