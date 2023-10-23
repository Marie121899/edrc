<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitizenTaxController extends Controller
{
    
    public function index()
    {
        $user = Auth::user();
        $citizen = $user->citizens->first();
        $taxes = $citizen->taxes ?? collect();;

        return view('citizen.taxes.index', compact('taxes'));
    }

    public function create()
    {
        return view('citizen.taxes.create');
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
        $citizen = $user->citizens->first();

        $tax = new Tax([
            'tax_type' => $validatedData['tax_type'],
            'amount' => $validatedData['amount'],
            'due_date' => $validatedData['due_date'],
            'tax_year' => $validatedData['tax_year'],
            'description' => $validatedData['description'],
            'payment_status' => 'unpaid',
        ]);

        $citizen->taxes()->save($tax);

        return redirect()->route('citizen.taxes.index')->with('message', 'Tax created successfully.');
    }

    public function show(Tax $tax)
    {
        return view('citizen.taxes.show', compact('tax'));
    }
}
