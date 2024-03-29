<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\User;
use App\Model\ColisInfo;
use Carbon\Carbon;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
            if (Auth::user()->type != "Manager") {
                Auth::logout();
                return redirect()->intended('manager')->with('error', 'You are not allowed to visit this page...');
            }
            
        $totalCustomer = User::where([['type', 'Customer'], ['branch_id', Auth::user()->branch_id]])->count();
        $totalDepartureColisInfo = ColisInfo::where('sender_branch_id', Auth::user()->branch_id)->count();
        $totalUpcomingColisInfo = ColisInfo::where('receiver_branch_id', Auth::user()->branch_id)->count();
        $total_chart = $this->chartData();
        return view('manager/dashboard', compact('totalCustomer', 'totalDepartureColisInfo', 'totalUpcomingColisInfo', 'total_chart'));
    }

    public function chartData() {

        $companyIncomeStatistics = ColisInfo::whereYear('created_at', '=', date('Y'))->where([['status', 'Delivered'], ['payment_branch_id', Auth::user()->branch_id]])->get()->groupBy(function($d) {
            return $d->created_at->format('F');
        });

        $monthly_chart = collect([]);

        foreach (month_arr() as $key => $value) {

            $monthly_chart->push([
                'month' => Carbon::parse(date('Y') . '-' . $key)->format('Y-m'),
                'income' => $companyIncomeStatistics->has($value) ? $companyIncomeStatistics[$value]->sum('payment_balance') : 0,
            ]);
        }

        return response()->json($monthly_chart->toArray())->content();
    }

}
