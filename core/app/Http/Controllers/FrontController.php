<?php

namespace App\Http\Controllers;

use App\Model\Social;
use App\Model\GeneralSetting;
use App\Model\VisitorMessage;
use Illuminate\Http\Request;
use App\Model\GalleryImage;
use App\Model\ColisInfo;
use Illuminate\Support\Facades\Session;
use App\Model\Service;
use App\Model\Price;
use App\Model\Testimonial;
use App\Model\Faq;

class FrontController extends Controller {

    public function index() {
        $socialList = Social::get();
        $gs = GeneralSetting::first();
        $serviceList = Service::all();
        $priceList = Price::all();
        return view('frontend.index', compact('socialList', 'gs', 'serviceList', 'priceList'));
    }

    public function aboutus() {
        $socialList = Social::get();
        $gs = GeneralSetting::first();
        return view('frontend.aboutus', compact('socialList', 'gs'));
    }

    public function contactus() {
        $socialList = Social::get();
        $gs = GeneralSetting::first();
        return view('frontend.contact', compact('socialList', 'gs'));
    }

    public function faq() {
        $socialList = Social::get();
        $gs = GeneralSetting::first();
        $faqList = Faq::all();
        $serviceList = Service::all();
        return view('frontend.faq', compact('socialList', 'gs', 'faqList', 'serviceList'));
    }

    public function visitorMessage(Request $request, VisitorMessage $visitorMessage) {
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'max:100',
            'phone' => 'max:100',
        ]);
        $data = $request->all();
        $visitorMessage->create($data);

        return redirect()->route('front.contactus', ["#contactustest"])->withSuccess("Thanks for your message");
    }

    public function searchColis(Request $request) {

        $colis_invoice = $request->get('colis_invoice');
        $colisInfo = ColisInfo::where('invoice_id', $colis_invoice)->orWhere('code',$colis_invoice)->first();
        return redirect()->route('front.index', ["#colis-search"])->with('colisInfo', $colisInfo);
        
    }

}
