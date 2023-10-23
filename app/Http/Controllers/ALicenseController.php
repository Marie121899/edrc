<?php

namespace App\Http\Controllers;

use App\Models\License;
use Illuminate\Http\Request;

class ALicenseController extends Controller
{
    public function index()
    {
        // Use the "with" method to eager load the "licenses" relationship
        $licenses = License::all();

  
        return view('admin.licenses.index', compact('licenses'));
    }
}
