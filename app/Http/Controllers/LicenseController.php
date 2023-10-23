<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\License;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LicenseController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Retrieve the logged-in user's businesses
        $businesses = $user->businesses;

        // Use the "with" method to eager load the "licenses" relationship
        $licenses = License::with('business')->whereIn('business_id', $businesses->pluck('id'))->get();

  
        return view('business.licenses.index', compact('licenses'));
    }

        // Method to display the apply view
        public function showApplyForm()
        {
            return view('business.licenses.apply');
        }
    
        // Method to handle license application
        public function apply(Request $request)
        {
            $validatedData = $request->validate([
                'license_number' => 'required|string',
                'issue_date' => 'required|date',
                'period' => 'required|in:1,3,6,12',
                'description' => 'nullable|string',
                // Add validation rules for other fields as needed
            ]);
    
            // Find the business by certificate number
            $business = Business::where('businessnumber', $validatedData['license_number'])->first();

            if (!$business) {
                return redirect()->back()->with('error', 'Business not found with the given certificate number.');
            }

            // Calculate issue and expiration dates based on the selected date and period
            $issueDate = Carbon::parse($validatedData['issue_date']);
            $period = $validatedData['period'];
            $expirationDate = $issueDate->copy()->addMonths($period);

            // Create a new license record
            $license = new License();
            $license->license_number = $validatedData['license_number'];
            $license->issue_date = $issueDate;
            $license->period = $period;
            $license->expiration_date = $expirationDate;
            $license->status = 'active'; // Set to active by default
            $license->description = $validatedData['description'];

                // Assign the business_id based on the relationship with the logged-in user
            $license->business_id = $business->id;

            // Save the license record
            $license->save();

            // Redirect to a success page or return a response
            return redirect()->route('licenses.index')->with('message', 'License application submitted successfully.');
        }


}
