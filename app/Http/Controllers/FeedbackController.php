<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::where('user_id', auth()->id())->get();
        return view('citizen.feedback.index', compact('feedbacks'));
    }

    public function create()
    {
        return view('citizen.feedback.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'subject' => 'nullable|string',
            'satisfaction' => 'required|in:good,bad,excellent,worst',
            'type' => 'required|in:passport_application,tax_filing,visa_application,license_application',
        ]);
    
        Feedback::create([
            'message' => $request->input('message'),
            'subject' => $request->input('subject'),
            'satisfaction' => $request->input('satisfaction'),
            'type' => $request->input('type'),
            'user_id' => auth()->user()->id,
        ]);
    
        return redirect()->route('citizen.feedback.index')->with('message', 'Feedback submitted successfully.');
    }

    public function indexAdmin()
    {
        // Get all passport applications
        $feedbacks = Feedback::all();
        
        return view('admin.feedback.list', compact('feedbacks'));
    }

    public function tax()
    {
        // Filter feedbacks applications by type 'tax_filing'
        $feedbacks = Feedback::where('type', 'tax_filing')->get();
    
        return view('admin.feedback.tax', compact('feedbacks'));
    }
    
    public function visa()
    {
        // Filter feedbacks applications by type 'visa_application'
        $feedbacks = Feedback::where('type', 'visa_application')->get();
    
        return view('admin.feedback.visa', compact('feedbacks'));
    }
    
    public function pp()
    {
        // Filter feedbacks applications by type 'passport_application'
        $feedbacks = Feedback::where('type', 'passport_application')->get();
    
        return view('admin.feedback.pp', compact('feedbacks'));
    }
    
    public function license()
    {
        // Filter feedbacks applications by type 'license_application'
        $feedbacks = Feedback::where('type', 'license_application')->get();
    
        return view('admin.feedback.license', compact('feedbacks'));
    }

    public function indexNR()
    {
        $feedbacks = Feedback::where('user_id', auth()->id())->get();
        return view('nonresident.feedback.index', compact('feedbacks'));
    }

    public function createNR()
    {
        return view('nonresident.feedback.create');
    }

    public function storeNR(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'subject' => 'nullable|string',
            'satisfaction' => 'required|in:good,bad,excellent,worst',
            'type' => 'required|in:passport_application,tax_filing,visa_application,license_application',
        ]);
    
        Feedback::create([
            'message' => $request->input('message'),
            'subject' => $request->input('subject'),
            'satisfaction' => $request->input('satisfaction'),
            'type' => $request->input('type'),
            'user_id' => auth()->user()->id,
        ]);
    
        return redirect()->route('nonresident.feedback.index')->with('message', 'Feedback submitted successfully.');
    }

    public function indexB()
    {
        $feedbacks = Feedback::where('user_id', auth()->id())->get();
        return view('business.feedback.index', compact('feedbacks'));
    }

    public function createB()
    {
        return view('business.feedback.create');
    }

    public function storeB(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'subject' => 'nullable|string',
            'satisfaction' => 'required|in:good,bad,excellent,worst',
            'type' => 'required|in:passport_application,tax_filing,visa_application,license_application',
        ]);
    
        Feedback::create([
            'message' => $request->input('message'),
            'subject' => $request->input('subject'),
            'satisfaction' => $request->input('satisfaction'),
            'type' => $request->input('type'),
            'user_id' => auth()->user()->id,
        ]);
    
        return redirect()->route('business.feedback.index')->with('message', 'Feedback submitted successfully.');
    }

    public function indexO()
    {
        $feedbacks = Feedback::where('user_id', auth()->id())->get();
        return view('organization.feedback.index', compact('feedbacks'));
    }

    public function createO()
    {
        return view('organization.feedback.create');
    }

    public function storeO(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'subject' => 'nullable|string',
            'satisfaction' => 'required|in:good,bad,excellent,worst',
            'type' => 'required|in:passport_application,tax_filing,visa_application,license_application',
        ]);
    
        Feedback::create([
            'message' => $request->input('message'),
            'subject' => $request->input('subject'),
            'satisfaction' => $request->input('satisfaction'),
            'type' => $request->input('type'),
            'user_id' => auth()->user()->id,
        ]);
    
        return redirect()->route('organization.feedback.index')->with('message', 'Feedback submitted successfully.');
    }

}
