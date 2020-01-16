<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use App\User;
use Intervention\Image\Facades\Image;
use App\Model\Branch;
use App\Model\Price;
use App\Model\CurrierInfo;
use Carbon\Carbon;
use App\Model\GeneralSetting;
use App\Model\CourierType;


class StaffController extends Controller {

    public function dashboard() {
        
        $user = User::all();
        $totalBranch = Branch::count();
        $totalManager = User::where([['type', 'Manager'], ['status', 'Active']])->count();
        $totalCompanyIncome = CurrierInfo::where('payment_status','Paid')->sum('payment_balance'); 
        $total_chart = $this->chartData();
        
        return view('staff/dashboard',  compact('user', 'totalBranch', 'totalManager', 'totalCompanyIncome', 'total_chart'));
    }

    public function chartData() {

        $companyIncomeStatistics = CurrierInfo::whereYear('created_at', '=', date('Y'))->where('payment_status', 'Paid')->get()->groupBy(function($d) {
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
    
    public function add() {
        
        $gs = GeneralSetting::first();
        $branchList = Branch::where([['status', 'Active'], ['id', '=', Auth::user()->branch_id]])->get();
        $priceList = Price::all();
        $courierTypeList = CourierType::where('status','Active')->get();
        
        return view('staff/currierInfo/add', compact('priceList', 'branchList', 'courierTypeList', 'gs'));
    }

    public function profileView() {
        
        return view('staff/profile');
        
    }

    public function updateProfile(Request $request) {
        $request->validate([
            'name' => 'required|max:50',
            'email' => ['required',
                Rule::unique('users')->ignore(Auth::user()->id), 'email'
            ],
            'phone' => ['required',
                Rule::unique('users')->ignore(Auth::user()->id), 'numeric'
            ],
            'image' => 'image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $profile = Auth::user();

        if ($request->hasFile('image')) {
            if (Auth::user()->image) {
                unlink('assets/staff/img/profile/' . Auth::user()->image);
            }
            $image = $request->image;
            $imageObj = Image::make($image);
            $imageObj->save('assets/staff/img/profile/' . $image->hashname());
            $profile->image = $image->hashname();
        }

        $profile->name = $request->get('name');
        $profile->email = $request->get('email');
        $profile->phone = $request->get('phone');

        $profile->save();

        return back()->withSuccess('Profile updated successfully');
    }

    public function changePassword() {
        return view('staff/changePassword');
    }

    public function updatePassword(Request $request) {
        $niceName = [
            'oldword' => 'Current Password',
            'newword' => 'New Password',
            'newword_confirmation' => 'Re-type password',
        ];
        $rules = [
            'oldword' => 'required',
            'newword' => 'required|min:4|confirmed',
            'newword_confirmation' => 'required',
        ];
        $customMessages = [
            'required' => 'The :attribute field is required.',
            'min' => 'Password must be 4 char',
        ];
        
        $this->validate($request, $rules, $customMessages, $niceName);
        
        $errors = [];
        //checking current password incorrect or correct
        $profile = Auth::user();
        if (!Hash::check(Input::get('oldword'), $profile->password)) {
            $errors['oldword'] = "Currernt password incorrect";
        }
        //checking new password is same as old password
        if (Hash::check(Input::get('newword'), $profile->password)) {
            $errors['newword'] = "This password is already used before. Try with a different one";
        }
        //find erros & redirect back with error message
        if (count($errors) > 0) {
            return redirect()->back()->withInput()->withErrors($errors)->withError('errorArray', 'Array Error Occured');
        } else {
            //bcrypt passwrod 
            $profile->password = bcrypt(Input::get('newword'));
            $profile->save();
            return back()->withSuccess('Password updated successfully');
        }
    }

    public function branchList() {
        $branchList = Branch::all()->where('status', 'Active');
        return view('staff.allbranch', compact('branchList'));
    }

}
