<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BusinessController extends Controller
{
    public function index()
    {
        return view('business.dashboard');
    }

    public function store(Request $request)
    {
               // Validate the submitted data
               $request->validate([
                'businessname' => 'required|string',
                'dateofregistration' => 'required|date',
                'businessnumber' => 'required|string',
                'phone' => 'required|string',
                'address' => 'required|string',
                'profile' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'industry' => 'required|string',
            ]);
                        // Get the authenticated user
                        $user = auth()->user();

                        if ($request->hasFile('profile')) {
                            $profileImage = $request->file('profile');
                            $profileImageName = time() . '.' . $profileImage->getClientOriginalExtension();
                            $profileImage->storeAs('public/profiles', $profileImageName);
                    
                            if (!$user->business) {
                                $business = new Business($request->except('profile'));
                                $business->profile = $profileImageName;
                                $user->businesses()->save($business);
            
                                // Update the 'status' field in the 'users' table to 'yes'
                                $user->status = 'yes';
                                $user->save();
                            } else {
                                $user->business->update($request->except('profile') + ['profile' => $profileImageName]);
                            }
                        }
            // Redirect to the user's dashboard or another appropriate page
            return redirect()->route('business.home');
    }
    public function editProfile(Request $request)
    {
        // Determine the currently active tab or set a default tab
        $redirectToTab = 'timeline'; // Assuming 'timeline' is the default tab
        $user = Auth::user();
        $business = Business::where('user_id', $user->id)->first();


        return view('business.profile.profile', compact('user', 'business', 'redirectToTab'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $business = Auth::user()->businesses()->firstOrNew([]);

        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'businessname' => 'nullable|string|max:255',  // Make these fields nullable
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            //dd($validator->errors());
            return redirect()->route('business.profile.profile')
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
        if ($request->filled('businessname')) {
            $business->businessname = $request->input('businessname');
        }
        if ($request->filled('phone')) {
            $business->phone = $request->input('phone');
        }
        if ($request->filled('address')) {
            $business->address = $request->input('address');
        }
        if ($request->filled('industry')) {
            $business->industry = $request->input('industry');
        }

        $business->save();

        // Redirect back to the same tab
        $redirectToTab = $request->input('tab');

        return redirect()->route('business.profile.profile', ['tab' => $redirectToTab])->with('message', 'Profile updated successfully.');
    }

}
