<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
//        $request->user()->fill($request->validated([
//            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
//        ]));
        $request->validate([
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2048KB = 2MB
        ]);

        $request->user()->name = $request->name;
        $request->user()->gender = $request->gender;
        $request->user()->university = $request->university;
        $request->user()->degree = $request->degree;
        $request->user()->year = $request->year;
        $request->user()->dob = $request->birthday;
        $request->user()->skills = implode(';', $request->skills);
        $request->user()->personal_description = $request->personal_description;
        $request->user()->hobbies = $request->hobbies;
        $request->user()->enrollment_type = $request->enrollment_type;

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if ($request->hasFile('profile_photo')) {

            $file = $request->file('profile_photo');
            $path = $file->store('profile_photos', 'public'); // Store file in 'storage/app/public/profile_photos'

            // Delete old profile photo if it exists
            if ($request->user()->profile_photo) {
                Storage::disk('public')->delete($request->user()->profile_photo);
            }

            $request->user()->photo = $path; // Save the new file path
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
