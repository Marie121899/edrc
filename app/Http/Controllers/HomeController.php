<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    } 
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        // Count users
        $countCitizen = User::where('type', 0)->count();
        $countBusiness = User::where('type', 3)->count();
        $countNonresident = User::where('type', 2)->count();
        $countOrganization = User::where('type', 4)->count();
        return view('adminHome', compact('countCitizen', 'countNonresident', 'countBusiness', 'countOrganization'));
    }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function nonresidentHome()
    {
        return view('nonresidentHome');
    }

    public function businessHome()
    {
        return view('businessHome');
    }

    public function organizationHome()
    {
        return view('organizationHome');
    }
}
