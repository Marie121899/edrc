<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;

class AdminTaxController extends Controller
{
    public function index()
    {
        $taxes = Tax::all();
        return view('admin.taxes.index', compact('taxes'));
    }

    public function edit(Tax $tax)
    {
        return view('admin.taxes.edit', compact('tax'));
    }

    public function update(Request $request, Tax $tax)
    {
        // Validate the request data
        $request->validate([
            'tax_type' => 'in:income,property,business,sales,excise,value_added,estate,gift,import,fuel,other',
            'amount' => 'numeric',
            'due_date' => 'date',
            'payment_status' => 'in:unpaid,paid',
            'tax_year' => 'numeric',
        ]);

        // Update the tax record
        $tax->update($request->only(['tax_type', 'amount', 'due_date', 'payment_status', 'tax_year']));

        return redirect()->route('admin.taxes.index')->with('message', 'Tax updated successfully.');
    }

    public function destroy(Tax $tax)
    {
        $tax->delete();

        return redirect()->route('admin.taxes.index')->with('message', 'Tax deleted successfully.');
    }

    public function income()
{
    $taxes = Tax::where('tax_type', 'income')->get();
    return view('admin.taxes.income', compact('taxes'));
}

public function property()
{
    $taxes = Tax::where('tax_type', 'property')->get();
    return view('admin.taxes.property', compact('taxes'));
}

public function business()
{
    $taxes = Tax::where('tax_type', 'business')->get();
    return view('admin.taxes.business', compact('taxes'));
}

public function sales()
{
    $taxes = Tax::where('tax_type', 'sales')->get();
    return view('admin.taxes.sales', compact('taxes'));
}

public function excise()
{
    $taxes = Tax::where('tax_type', 'excise')->get();
    return view('admin.taxes.excise', compact('taxes'));
}

public function vat()
{
    $taxes = Tax::where('tax_type', 'vat')->get();
    return view('admin.taxes.vat', compact('taxes'));
}

public function estate()
{
    $taxes = Tax::where('tax_type', 'estate')->get();
    return view('admin.taxes.estate', compact('taxes'));
}

public function gift()
{
    $taxes = Tax::where('tax_type', 'gift')->get();
    return view('admin.taxes.gift', compact('taxes'));
}

public function import()
{
    $taxes = Tax::where('tax_type', 'import')->get();
    return view('admin.taxes.import', compact('taxes'));
}

public function fuel()
{
    $taxes = Tax::where('tax_type', 'fuel')->get();
    return view('admin.taxes.fuel', compact('taxes'));
}

public function other()
{
    $taxes = Tax::where('tax_type', 'other')->get();
    return view('admin.taxes.other', compact('taxes'));
}
}
