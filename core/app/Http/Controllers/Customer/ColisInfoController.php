<?php

namespace App\Http\Controllers\Customer;

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
use DNS1D;
use Carbon\Carbon;
use DB;

class ColisInfoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {

        $searchtext = $request->search;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        if (!empty($start_date) && !empty($end_date)) {
            $colisList = ColisInfo::where('sender_branch_id', Auth::user()->branch_id)
                    ->where(function($q) use($start_date, $end_date) {
                        $q->whereBetween('created_at', [$start_date, $end_date]);
                    })
                    ->orWhere('receiver_branch_id', Auth::user()->branch_id)
                    ->paginate(10);
        } else {
            $colisList = ColisInfo::where('sender_branch_id', Auth::user()->branch_id)
                    ->where(function($q) use($searchtext) {
                        $q->orWhere('invoice_id', 'LIKE', "%$searchtext%")
                        ->orWhere('payment_date', 'LIKE', "%$searchtext%")
                        ->orWhere('sender_name', 'LIKE', "%$searchtext%")
                        ->orWhere('receiver_name', 'LIKE', "%$searchtext%")
                        ->orWhere('status', 'LIKE', "%$searchtext%");
                    })
                    ->orWhere('receiver_branch_id', Auth::user()->branch_id)
                    ->paginate(10);
        }
        return view('customer.colisInfo.list', compact('colisList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        $gs = GeneralSetting::first();
        $branchList = Branch::where([['status', 'Active'], ['id', '!=', Auth::user()->branch_id]])->get();
        $colisTypeList = ColisType::where('status', 'Active')->get();
        return view('customer/colisInfo/add', compact('branchList', 'colisTypeList', 'gs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $request->validate([
            'sender_name' => 'required|max:50',
            'sender_phone' => 'required|max:50',
            'receiver_name' => 'required|max:50',
            'receiver_phone' => 'required|max:50',
            'colis_type' => 'required',
            'colis_quantity.*' => 'required|numeric',
            'colis_fee.*' => 'required|numeric'
        ]);


        $data = $request->except('_token','colis_type','colis_quantity','colis_fee');

        if (ColisInfo::first()) {

            $lastInvoice = ColisInfo::latest()->first()->id;
        } else {

            $lastInvoice = 0;
        }

        $data['invoice_id'] = $lastInvoice + 1;

        //$data['status'] = 'Received';

        $data['payment_balance'] = array_sum($request->colis_fee);

        $colis_code = strtoupper(Str::random(12));

        $data['code'] = $colis_code;

        $colisInfo = ColisInfo::create($data);

        $colis_type = $request->colis_type;

        for ($i = 0; $i < count($colis_type); $i++) {
            $colisProductInfo = new ColisProductInfo();
            $colisProductInfo->colis_code = $colis_code;
            $colisProductInfo->colis_info_id = $colisInfo->id;
            $colisProductInfo->colis_type = $request->colis_type[$i];
            $colisProductInfo->colis_quantity = $request->colis_quantity[$i];
            $colisProductInfo->colis_fee = $request->colis_fee[$i];
            $colisProductInfo->save();
        }

        return redirect()->route('colis.invoice', $colisInfo->id)->withSuccess("Colis created successfully");
    }

    public function colisInvoice(ColisInfo $colisInfo) {

        $colis_code = ColisProductInfo::where('colis_info_id', $colisInfo->id)->first()->colis_code;

        $code = '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($colis_code, 'C128') . '" alt="barcode"   />' . "<br>" . $colis_code;

        $gs = GeneralSetting::first();
        $colisProductInfoList = ColisProductInfo::where('colis_info_id', $colisInfo->id)->get();

        return view('customer.colisInfo.invoice', compact('colisInfo', 'colisProductInfoList', 'gs', 'code'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\ColisInfo  $colisInfo
     * @return \Illuminate\Http\Response
     */
    public function show(ColisInfo $colisInfo) {
//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\ColisInfo  $colisInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(ColisInfo $colisInfo) {
//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\ColisInfo  $colisInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ColisInfo $colisInfo) {
//
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\ColisInfo  $colisInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ColisInfo $colisInfo) {
//
    }

    public function receiveColis(Request $request) {

        $id = $request->get('id');
        $colisInfo = ColisInfo::find($id);
        if ($request->payment_status == "Paid") {
            $colisInfo->payment_date = Carbon::now()->toDateString();
            $colisInfo->payment_branch_id = Auth::user()->branch_id;
            $colisInfo->payment_receiver_id = Auth::user()->id;
            $colisInfo->payment_status = "Paid";
        }
        $colisInfo->receiver_branch_customer_id = Auth::user()->id;
        $colisInfo->status = 'Delivered';
        $colisInfo->save();
        return back()->withSuccess("Colis received successfully");
    }

    public function searchDeliverColis() {

        $colisList = ColisInfo::all();
        return view('customer.deliver.searchDeliver', compact('colisList'));
    }

    public function showDeliverColis(Request $request) {
		if($request and $request->search != "")
			$colisList = ColisInfo::where('code', $request->search)->orWhere('receiver_phone', $request->search)->orWhere('sender_phone', $request->search)->get();
		else
			$colisList = ColisInfo::all();
        return view('customer.deliver.searchDeliver', compact('colisList'));
    }

    public function notifyView() {
        return view('customer.deliver.notifyView');
    }

    public function findColis(Request $request) {

        $code = $request->code;

        $colis = ColisInfo::where('code', $code)->orWhere('receiver_phone', $code)->orWhere('sender_phone', $code)->with('branch')->get();

        if ($colis) {
            $response = array('output' => 'success', 'msg' => 'data found', 'colis' => $colis);
        } else {
            $response = array('output' => 'error', 'msg' => 'data not found');
        }
        return response()->json($response);
    }

    public function sendNotification(Request $request) {

        $codeList = $request->all();
        $gs = GeneralSetting::first();

        if (empty($codeList["code"])) {
            return back()->withErrors("Please add colis first");
        }

        foreach ($codeList["code"] as $invoice) {
            $sendNotify = ColisInfo::where('code', $invoice)->first();

            if ($sendNotify->receiver_email != null && $gs->email_verification == 1) {
                $to = $sendNotify->receiver_email;
                $name = $sendNotify->receiver_name;

                $subject = 'Your Colis Arrived';

                $message = "Hello Your Colis Arrived";

                send_email($to, $name, $subject, $message);
            }

            if ($sendNotify->receiver_phone != null && $gs->sms_verification == 1) {
                $to = $sendNotify->receiver_phone;
                $message = 'Hello Your Colis Arrived';
                send_sms($to, $message);
            }
        }
        return back()->withSuccess("Notification send successfully");
    }

    public function customerCasheCollection(Request $request) {

        $start_date = $request->start_date;
        $end_date = $request->end_date;

        if (!empty($start_date) && !empty($end_date)) {
            $branchIncomeList = ColisInfo::where('payment_receiver_id', Auth::user()->id)
                    ->where(function($q) use($start_date, $end_date) {
                        $q->whereBetween('payment_date', [$start_date, $end_date]);
                    })
                    ->select(DB::raw("*,SUM(payment_balance) as total_balance"))
                    ->groupBy('payment_date')
                    ->paginate(10);
        } else {
            $branchIncomeList = ColisInfo::where('payment_receiver_id', Auth::user()->id)
                            ->select(DB::raw("*,SUM(payment_balance) as total_balance"))
                            ->groupBy('payment_date')->paginate(10);
        }

        $gs = GeneralSetting::first();

        return view('customer.branchIncome.list', compact('branchIncomeList', 'gs'));
    }

    public function printSlipView($id) {

        $colisInfo = ColisInfo::find($id);
        $colis_code = ColisProductInfo::where('colis_info_id', $colisInfo->id)->first()->colis_code;
        $code = '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($colis_code, 'C128') . '" alt="barcode"   />' . "<br>" . $colis_code;
        $gs = GeneralSetting::first();

        return view('customer.colisInfo.slip', compact('colis_code', 'code', 'gs', 'colisInfo'));
    }

    public function paidColis(Request $request) {

        $id = $request->get('id');
        $colisInfo = ColisInfo::find($id);
        $colisInfo->payment_date = Carbon::now()->toDateString();
        $colisInfo->payment_branch_id = Auth::user()->branch_id;
        $colisInfo->payment_receiver_id = Auth::user()->id;
        $colisInfo->payment_status = "Paid";
        $colisInfo->save();
        return back()->withSuccess("Colis payment successfully");
    }

}
