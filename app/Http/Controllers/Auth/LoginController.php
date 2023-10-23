<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {   
        $input = $request->all();
     
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
     
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            $user = Auth::user();

            if ($user->status === 'no') {
                // Registration is incomplete, redirect to the respective complete registration page
                if ($user->type === 'citizen') {
                    return redirect()->route('citizen.dashboard');
                } else if ($user->type === 'nonresident') {
                    return redirect()->route('nonresident.dashboard');
                }
                else if ($user->type === 'nonresident') {
                    return redirect()->route('nonresident.dashboard');
                }
                else if ($user->type === 'business') {
                    return redirect()->route('business.dashboard');
                }
                else if ($user->type === 'organization') {
                    return redirect()->route('organization.dashboard');
                }
                else if ($user->type === 'admin') {
                    return redirect()->route('admin.dashboard');
                }
            } else {

            if (auth()->user()->type == 'admin') {
                return redirect()->route('admin.home');
            }else if (auth()->user()->type == 'nonresident') {
                return redirect()->route('nonresident.home');
            }else if (auth()->user()->type == 'business') {
                return redirect()->route('business.home');
            }else if (auth()->user()->type == 'organization') {
                return redirect()->route('organization.home');
            }else{
                return redirect()->route('home');
            }
        }
        }else{
            return redirect()->route('login')
                ->with('error','Email-Address And Password Are Wrong.');
        }
    
    }

}
