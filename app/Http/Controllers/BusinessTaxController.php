<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessTaxController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $business = $user->businesses->first();
        $taxes = $business->taxes ?? collect();
        $businesses = $user->businesses;

        return view('business.taxes.index', compact('taxes'));
    }

    public function create()
    {
        return view('business.taxes.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tax_type' => 'required|in:income,property,business,sales,excise,value_added,estate,gift,import,fuel,other',
            'amount' => 'required|numeric',
            'due_date' => 'required|date',
            'tax_year' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $user = Auth::user();
        $business = $user->businesses->first();

        $tax = new Tax([
            'tax_type' => $validatedData['tax_type'],
            'amount' => $validatedData['amount'],
            'due_date' => $validatedData['due_date'],
            'tax_year' => $validatedData['tax_year'],
            'description' => $validatedData['description'],
            'payment_status' => 'unpaid',
        ]);

        $business->taxes()->save($tax);

        return redirect()->route('business.taxes.index')->with('message', 'Tax created successfully.');
    }

    public function show(Tax $tax)
    {
        return view('business.taxes.show', compact('tax'));
    }
}
