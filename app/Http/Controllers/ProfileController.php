<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Exception;

class ProfileController extends Controller
{
    protected $paginationLimit = 10;

    public function __construct()
    {
        $this->middleware('auth');
    }
    // Display the user's profile
    public function show()
    {
        $user = auth()->user();
        return view('profile.show', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();

        if ($user) {
            return response()->json(['user' => $user]);
        }

        return response()->json(['error' => 'User not found'], 404);
    }

    public function update(Request $request)
    {
        $userId = auth()->id();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . ($userId ?? ''),
            'nik_name' => 'nullable|string|max:255',
            'mobile' => 'nullable|string|max:15',
            'old_password' => 'nullable|string',
            'password' => 'nullable|string|min:8',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
    
        try {
            $user = auth()->user();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->nik_name = $request->nik_name;
            $user->mobile = $request->mobile;
    
            if ($request->filled('old_password') && Hash::check($request->old_password, $user->password)) {
                if ($request->filled('password')) {
                    $user->password = Hash::make($request->password);
                }
            }
    
            if ($request->hasFile('image')) {
                if ($user->image && file_exists(public_path('uploads/user_image/' . $user->image))) {
                    unlink(public_path('uploads/user_image/' . $user->image));
                }
    
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $imageName = time() . '_' . mt_rand(100000, 999999) . '.' . $extension;
                $file->move(public_path('uploads/user_image'), $imageName);
            } else {
                $imageName = $user->image;
            }
    
            $user->image = $imageName;
            $user->save();
    
            return response()->json(['success' => 'Profile updated successfully', 'user' => $user]);
    
        } catch (Exception $e) {
            Log::error('Error updating profile: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to update profile. Please try again later.'], 500);
        }
    }

}
