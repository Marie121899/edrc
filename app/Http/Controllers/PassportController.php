<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PPApp;
use App\Models\Citizen;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PassportController extends Controller
{
    public function index()
    {
           // Get the currently authenticated user
    $user = Auth::user();

    // Retrieve the passport applications for the user's citizens
    $passportApplications = $user->citizens->flatMap(function ($citizen) {
        return $citizen->passportApplications;
    });

        return view('citizen.passport.index', compact('passportApplications'));
    }

    public function create()
    {
        // Return the passport application form view
        return view('citizen.passport.create');
    }

    public function store(Request $request)
    {  
        // Validate the incoming request data
        $validatedData = $request->validate([
            'applicant_id_copy' => 'required|string',
            'passport_size_photos' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'applicant_birthcertificate' => 'required|string',
            'mother_birthcertificate' => 'required|string',
            'father_birthcertificate' => 'required|string',
            'date_to_submit_biometrics' => 'required|date',
        ]);

        // Upload the passport size image to the public/passport directory
        if ($request->hasFile('passport_size_photos')) {
            $imagePath = $request->file('passport_size_photos')->store('public/passport');
            $validatedData['passport_size_photos'] = str_replace('public/', '', $imagePath);
        }

        // Get the currently logged-in user
        $user = Auth::user();

        // Ensure the user is logged in and has a citizen record
        if ($user && $user->citizens->count() > 0) {
            $citizen = $user->citizens->first();

            // Associate the citizen with the passport application and create a new record
            $passportApplication = $citizen->passportApplications()->create($validatedData);

        }
        // Redirect back with a success message or any other action you prefer
        return redirect()->route('citizen.passport.index')->with('message', 'Passport application submitted successfully.');
    }
    
    public function list()
    {
        // Get all passport applications
        $passports = PPApp::all();
        
        return view('admin.passport.list', compact('passports'));
    }

    public function cancelled()
    {
        // Filter passport applications by status 'cancelled'
        $passports = PPApp::where('status', 'cancelled')->get();
    
        return view('admin.passport.canceled', compact('passports'));
    }
    
    public function inReview()
    {
        // Filter passport applications by status 'inreview'
        $passports = PPApp::where('status', 'inreview')->get();
    
        return view('admin.passport.inreview', compact('passports'));
    }
    
    public function completed()
    {
        // Filter passport applications by status 'completed'
        $passports = PPApp::where('status', 'completed')->get();
    
        return view('admin.passport.completed', compact('passports'));
    }
    
    public function processing()
    {
        // Filter passport applications by status 'processing'
        $passports = PPApp::where('status', 'processing')->get();
    
        return view('admin.passport.processing', compact('passports'));
    }

    public function edit(PPApp $passport)
    {
        return view('admin.passport.edit', compact('passport'));
    }

    public function update(Request $request, PPApp $passport)
    {
        // Update passport application status
        $request->validate([
            'status' => 'required|in:cancelled,inreview,completed,processing',
        ]);

        $passport->update(['status' => $request->input('status')]);

        return redirect()->route('admin.passports.list')->with('message', 'Passport status updated successfully.');
    }
    
}
