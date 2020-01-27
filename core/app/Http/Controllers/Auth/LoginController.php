<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    
     public function showLoginForm()
    {
         
        return view('manager.login');
    }
    
    public function username()
    {
        return 'name';
    }

    public function loginApi()
    {
        $credentials = request(['email', 'password']);


        if ($token = auth('api')->attempt($credentials)) {
            
              

            $user = \App\User::where([ ["email", "=" , $credentials["email"] ] , ['type', "=" , 'Driver'] ])->first();

          //  dd($user);

            if($user != null){
                return $this->respondWithToken($token);
            }

            return response()->json(['error' => 'Unauthorized Profile'], 401);


        }

        return response()->json(['error' => 'Unauthorized'], 401);

    }



    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60

            ]);
    }
    
   
    
    
   
}
