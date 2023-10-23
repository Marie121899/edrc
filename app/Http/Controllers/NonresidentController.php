<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Nonresident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NonresidentController extends Controller
{
    public function index()
    {
        return view('nonresident.dashboard');
    }

    public function store(Request $request)
    {
               // Validate the submitted data
               $request->validate([
                'lname' => 'required|string',
                'surname' => 'required|string',
                'dob' => 'required|date',
                'passportnumber' => 'required|string',
                'phone' => 'required|string',
                'address' => 'required|string',
                'gender' => 'required|in:Male,Female,Other',
                'profile' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'city' => 'required|string',
            ]);
    
                        // Get the authenticated user
                        $user = auth()->user();

                        if ($request->hasFile('profile')) {
                            $profileImage = $request->file('profile');
                            $profileImageName = time() . '.' . $profileImage->getClientOriginalExtension();
                            $profileImage->storeAs('public/profiles', $profileImageName);
                    
                            if (!$user->nonresident) {
                                $nonresident = new Nonresident($request->except('profile'));
                                $nonresident->profile = $profileImageName;
                                $user->nonresidents()->save($nonresident);
            
                                // Update the 'status' field in the 'users' table to 'yes'
                                $user->status = 'yes';
                                $user->save();
                            } else {
                                $user->nonresident->update($request->except('profile') + ['profile' => $profileImageName]);
                            }
                        }
           
            // Redirect to the user's dashboard or another appropriate page
            return redirect()->route('nonresident.home');
    }

    public function editProfile(Request $request)
    {
        // Determine the currently active tab or set a default tab
        $redirectToTab = 'timeline'; // Assuming 'timeline' is the default tab
        $user = Auth::user();
        $nonresident = Nonresident::where('user_id', $user->id)->first();


        return view('nonresident.profile.profile', compact('user', 'nonresident', 'redirectToTab'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $nonresident = Auth::user()->nonresidents()->firstOrNew([]);

        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'lname' => 'nullable|string|max:255',  // Make these fields nullable
            'surname' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            //dd($validator->errors());
            return redirect()->route('nonresident.profile.profile')
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
        if ($request->filled('lname')) {
            $nonresident->lname = $request->input('lname');
        }
        if ($request->filled('surname')) {
            $nonresident->surname = $request->input('surname');
        }
        if ($request->filled('phone')) {
            $nonresident->phone = $request->input('phone');
        }
        if ($request->filled('address')) {
            $nonresident->address = $request->input('address');
        }
        if ($request->filled('city')) {
            $nonresident->city = $request->input('city');
        }

        $nonresident->save();

        // Redirect back to the same tab
        $redirectToTab = $request->input('tab');

        return redirect()->route('nonresident.profile.profile', ['tab' => $redirectToTab])->with('message', 'Profile updated successfully.');
    }

}
