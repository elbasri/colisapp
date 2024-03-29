<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller {

    use AuthenticatesUsers;

    public function authenticate(Request $request) {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);
        //check authentication 
        if (Auth::attempt(['name' => $request->get('name'), 'password' => $request->get('password'), 'status' => 'Active'])) {
        return redirect('customer/dashboard')->withSuccess('You are successfully logged in');
        } else {
            return redirect()->back()->withInput()->withErrors('These credentials do not match our records..');
        }
    }

}
