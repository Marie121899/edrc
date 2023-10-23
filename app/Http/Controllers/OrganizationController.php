<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrganizationController extends Controller
{
    public function index()
    {
        return view('organization.dashboard');
    }
    public function store(Request $request)
    {
               // Validate the submitted data
               $request->validate([
                'orgname' => 'required|string',
                'dateofregistration' => 'required|date',
                'orgnumber' => 'required|string',
                'phone' => 'required|string',
                'profile' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'address' => 'required|string',
            ]);
                        // Get the authenticated user
                        $user = auth()->user();

                        if ($request->hasFile('profile')) {
                            $profileImage = $request->file('profile');
                            $profileImageName = time() . '.' . $profileImage->getClientOriginalExtension();
                            $profileImage->storeAs('public/profiles', $profileImageName);
                    
                            if (!$user->organization) {
                                $organization = new Organization($request->except('profile'));
                                $organization->profile = $profileImageName;
                                $user->organizations()->save($organization);
            
                                // Update the 'status' field in the 'users' table to 'yes'
                                $user->status = 'yes';
                                $user->save();
                            } else {
                                $user->organization->update($request->except('profile') + ['profile' => $profileImageName]);
                            }
                        }
            // Redirect to the user's dashboard or another appropriate page
            return redirect()->route('organization.home');
    }

    public function editProfile(Request $request)
    {
        // Determine the currently active tab or set a default tab
        $redirectToTab = 'timeline'; // Assuming 'timeline' is the default tab
        $user = Auth::user();
        $organization = Organization::where('user_id', $user->id)->first();


        return view('organization.profile.profile', compact('user', 'organization', 'redirectToTab'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $organization = Auth::user()->organizations()->firstOrNew([]);

        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'orgname' => 'nullable|string|max:255',  // Make these fields nullable
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            //dd($validator->errors());
            return redirect()->route('organization.profile.profile')
                ->withErrors($validator)
                ->withInput();
        }

        // Update user data
        if ($request->filled('name')) {
            $user->name = $request->input('name');
        }
        
        if ($request->filled('email')) {
            $user->email = $request->input('email');
        }

        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();
        // Update admin data
        if ($request->filled('orgname')) {
            $organization->orgname = $request->input('orgname');
        }
        if ($request->filled('phone')) {
            $organization->phone = $request->input('phone');
        }
        if ($request->filled('address')) {
            $organization->address = $request->input('address');
        }

        $organization->save();

        // Redirect back to the same tab
        $redirectToTab = $request->input('tab');

        return redirect()->route('organization.profile.profile', ['tab' => $redirectToTab])->with('message', 'Profile updated successfully.');
    }

}
