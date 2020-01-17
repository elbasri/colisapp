<?php

namespace App\Http\Controllers\Manager;

use App\Model\ColisType;
use App\Model\ColisInfo;
use App\Model\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Branch;
use App\Model\GeneralSetting;
use App\Model\ColisProductInfo;
use Auth;
use DNS1D;

class ColisInfoController extends Controller {

    public function departureBranchColisList(Request $request) {
        $searchtext = $request->search;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        if (!empty($start_date) && !empty($end_date)) {
            $colisList = ColisInfo::where([['sender_branch_id', Auth::user()->branch_id], ['status', 'Received']])
                    ->where(function($q) use($start_date, $end_date) {
                        $q->whereBetween('created_at', [$start_date, $end_date]);
                    })
                    ->paginate(10);
        } else {
            $colisList = ColisInfo::where([['sender_branch_id', Auth::user()->branch_id], ['status', 'Received']])
                    ->where(function($q) use($searchtext) {
                        $q->orWhere('invoice_id', 'LIKE', "%$searchtext%")
                        ->orWhere('payment_date', 'LIKE', "%$searchtext%")
                        ->orWhere('sender_name', 'LIKE', "%$searchtext%")
                        ->orWhere('receiver_name', 'LIKE', "%$searchtext%")
                        ->orWhere('code', 'LIKE', "%$searchtext%");
                    })
                    ->paginate(10);
        }
        return view('manager.colisInfo.departureColisList', compact('colisList'));
    }

    public function upcomingBranchColisList(Request $request) {
        $searchtext = $request->search;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        if (!empty($start_date) && !empty($end_date)) {
            $colisList = ColisInfo::where([['receiver_branch_id', Auth::user()->branch_id], ['status', 'Received']])
                    ->where(function($q) use($start_date, $end_date) {
                        $q->whereBetween('created_at', [$start_date, $end_date]);
                    })
                    ->paginate(10);
        } else {
            $colisList = ColisInfo::where([['receiver_branch_id', Auth::user()->branch_id], ['status', 'Received']])
                    ->where(function($q) use($searchtext) {
                        $q->orWhere('invoice_id', 'LIKE', "%$searchtext%")
                        ->orWhere('payment_date', 'LIKE', "%$searchtext%")
                        ->orWhere('sender_name', 'LIKE', "%$searchtext%")
                        ->orWhere('receiver_name', 'LIKE', "%$searchtext%")
                        ->orWhere('code', 'LIKE', "%$searchtext%");
                    })
                    ->paginate(10);
        }

        return view('manager.colisInfo.upcomingColisList', compact('colisList'));
    }

    public function colisInvoice(ColisInfo $colisInfo) {

        $colis_code = ColisProductInfo::where('colis_info_id', $colisInfo->id)->first()->colis_code;
        $code = '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($colis_code, 'C128') . '" alt="barcode"   />' . "<br>" . $colis_code;

        $gs = GeneralSetting::first();

        $colisProductInfoList = ColisProductInfo::where('colis_info_id', $colisInfo->id)->get();

        return view('manager.colisInfo.invoice', compact('colisInfo', 'colisProductInfoList', 'gs', 'code'));
    }

    public function upcomingColisInvoice(ColisInfo $colisInfo) {
        $gs = GeneralSetting::first();
        $colisProductInfoList = ColisProductInfo::where('colis_info_id', $colisInfo->id)->get();
        return view('manager.colisInfo.upcomingColisInvoice', compact('colisInfo', 'colisProductInfoList', 'gs'));
    }

    public function printSlipView($id) {
        $colisInfo = ColisInfo::find($id);
        $colis_code = ColisProductInfo::where('colis_info_id', $colisInfo->id)->first()->colis_code;
        $code = '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($colis_code, 'C128') . '" alt="barcode"   />' . "<br>" . $colis_code;
        $gs = GeneralSetting::first();
        return view('manager.colisInfo.slip', compact('colis_code', 'code', 'gs', 'colisInfo'));
    }

}
