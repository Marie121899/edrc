<?php

namespace App\Http\Controllers;

use App\Models\License;
use Illuminate\Http\Request;

class AdminLicenseController extends Controller
{
    public function index()
    {
        // Retrieve all licenses for display
        $licenses = License::all();
        return view('admin.licenses.index', compact('licenses'));
    }

    public function edit(License $license)
    {
        return view('admin.licenses.edit', compact('license'));
    }

    public function update(Request $request, License $license)
    {
        // Validate and update the status
        $request->validate([
            'status' => 'required|in:active,expired,pending_renewal,cancel',
        ]);

        $license->status = $request->status;
        $license->save();

        return redirect()->route('admin.licenses.index')->with('message', 'License status updated.');
    }
}
