<?php

namespace App\Http\Controllers;

use App\Models\Visa;
use Illuminate\Http\Request;
use App\Models\NonresidentVisa;
use Illuminate\Support\Facades\Auth;

class VisaController extends Controller
{
    public function index()
    {
        $visas = Visa::whereHas('ppApp', function ($query) {
            $query->where('citizen_id', Auth::user()->citizens->first()->id);
        })->get();

        return view('citizen.visa.index', compact('visas'));
    }

    public function create()
    {
        return view('citizen.visa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_of_visa' => 'required|in:tourist,work,student,other',
            'visa_category' => 'required|in:short-term,long-term,other',
            'visa_start_date' => 'required|date',
            'visa_end_date' => 'required|date',
            'purpose_of_travel' => 'required|string',
            'travel_itinerary' => 'nullable|string',
            'sponsor_information' => 'nullable|string',
            'target_country' => 'nullable|string',
        ]);

        Visa::create([
            'ppapp_id' => Auth::user()->citizens->first()->passportApplications->first()->id,
            'type_of_visa' => $request->input('type_of_visa'),
            'visa_category' => $request->input('visa_category'),
            'visa_start_date' => $request->input('visa_start_date'),
            'visa_end_date' => $request->input('visa_end_date'),
            'purpose_of_travel' => $request->input('purpose_of_travel'),
            'travel_itinerary' => $request->input('travel_itinerary'),
            'sponsor_information' => $request->input('sponsor_information'),
            'target_country' => $request->input('target_country'),
            'status' => 'processing', // Default status
        ]);

        return redirect()->route('citizen.visa.index')->with('message', 'Visa application submitted successfully.');
    }

    public function indexNR()
    {
          // Retrieve all visa applications for the currently logged-in user's non-residents
          $visas = auth()->user()->nonresidents->flatMap->visas;

        return view('nonresident.visa.index', compact('visas'));
    }

    public function createNR()
    {
        
              // Retrieve the logged-in user's non-resident details
            $nonresident = auth()->user()->nonresidents->first();

            // Redirect if non-resident details are not found
            if (!$nonresident) {
                return redirect()->route('nonresident.create')->with('error', 'Non-resident details not found. Please complete your non-resident profile first.');
            }
        return view('nonresident.visa.create', compact('nonresident'));
    }

    public function storeNR(Request $request)
    {
            // Validate the form data
            $validatedData = $request->validate([
                'type_of_visa' => 'required',
                'visa_category' => 'required',
                'visa_start_date' => 'required|date',
                'visa_end_date' => 'required|date|after:visa_start_date',
                'purpose_of_travel' => 'required',
                'travel_itinerary' => 'required',
                'sponsor_information' => 'required',
            ]);

            // Create a new visa application for the logged-in non-resident
            $user = auth()->user();
            $nonresident = $user->nonresidents->first(); // Assuming you want to use the first non-resident associated with the user

            if (!$nonresident) {
                return redirect()->route('nonresident.visa.create')->with('error', 'Non-resident details not found. Please complete your non-resident profile first.');
            }

            $visa = new NonresidentVisa($validatedData);
            $nonresident->visas()->save($visa);
    
            return redirect()->route('nonresident.visa.index')->with('message', 'Visa application submitted successfully.');
    }
    
    public function list()
    {
        // Get all visa applications
        $visas = NonresidentVisa::all();
        
        return view('admin.visa.list', compact('visas'));
    }

    public function canceled()
    {
        // Filter visa applications by status 'cancelled'
        $visas = NonresidentVisa::where('status', 'canceled')->get();
    
        return view('admin.visa.canceled', compact('visas'));
    }
    
    
    public function approved()
    {
        // Filter visa applications by status 'completed'
        $visas = NonresidentVisa::where('status', 'approved')->get();
    
        return view('admin.visa.approved', compact('visas'));
    }
    
    public function processing()
    {
        // Filter visa applications by status 'processing'
        $visas = NonresidentVisa::where('status', 'processing')->get();
    
        return view('admin.visa.processing', compact('visas'));
    }

    public function edit(NonresidentVisa $visa)
    {
        return view('admin.visa.edit', compact('visa'));
    }

    public function update(Request $request, NonresidentVisa $visa)
    {
        // Update visa application status
        $request->validate([
            'status' => 'required|in:canceled,approved,processing',
        ]);

        $visa->update(['status' => $request->input('status')]);

        return redirect()->route('admin.visas.list')->with('message', 'Visa status updated successfully.');
    }
}
