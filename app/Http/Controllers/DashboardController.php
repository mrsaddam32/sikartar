<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Activity;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $users = User::all()->count();

        $activity = Activity::whereDate('activity_start_date', '>=', Carbon::now())->orderBy('activity_start_date', 'ASC')->first();
        $startDate = null;
        $now = Carbon::now();
        $remainingDays = null;

        if ($activity) {
            $startDate = Carbon::parse($activity->activity_start_date);
            $remainingDays = $startDate->diffInDays($now);
        }

        $activities = Activity::all()->count();
        $totalIncome = Activity::all()->sum('activity_budget');

        if (Auth::check() && Auth::user()->role_id == 1) {
            return view('admin.dashboard.index', [
                'title' => 'Dashboard Admin',
                'active' => 'dashboard',
                'users' => $users,
                'user' => $user,
                'activity' => $activity,
                'remainingDays' => $remainingDays,
                'activities' => $activities,
                'totalIncome' => $totalIncome,
            ]);
        } else {
            return view('user.dashboard.index', [
                'title' => 'Dashboard User',
                'active' => 'dashboard',
                'user' => $user,
            ]);
        }
    }

    /**
     * Display a user profile detail page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $user = Auth::user();

        if (Auth::check() && Auth::user()->role_id == 1) {
            return view('admin.profile.index', [
                'title' => 'My Profile',
                'active' => 'profile',
                'user' => $user,
            ]);
        } else {
            return view('user.profile.index', [
                'title' => 'My Profile',
                'active' => 'profile',
                'user' => $user,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.profile')
                ->withErrors($validator)
                ->withInput();
        }

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('image')) {
            $oldImagePath = $user->photo_path;
            $imagePath = $request->file('image')->hashName();
            $request->file('image')->storeAs('public/images', $imagePath);

            $user->photo_path = 'storage/images/' . $imagePath;
            $user->photo_name = $request->file('image')->getClientOriginalName();

            // Delete old image
            if ($oldImagePath && Storage::exists($oldImagePath)) {
                Storage::delete($oldImagePath);
            }
        }

        $user->save();

        if (Auth::check() && Auth::user()->role_id == 1) {
            return redirect()->route('admin.profile')->with('success', 'Profile updated successfully');
        } else {
            return redirect()->route('user.profile')->with('success', 'Profile updated successfully');
        }
    }

    /**
     * Update user password.
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function updatePassword(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => ['required', Password::min(8)->letters()->mixedCase()->numbers()],
            'new_password_confirmation' => 'required|same:new_password',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.profile')
                ->withErrors($validator)
                ->withInput();
        }

        if (Auth::check() && Auth::user()->role_id == 1) {
            if (Hash::check($request->current_password, $user->password)) {
                $user->password = Hash::make($request->new_password);
                $user->save();

                return redirect()->route('admin.profile')->with('success', 'Password updated successfully');
            } else {
                return redirect()->route('admin.profile')->with('error', 'Current password is incorrect');
            }
        } else {
            if (Hash::check($request->current_password, $user->password)) {
                $user->password = Hash::make($request->new_password);
                $user->save();

                return redirect()->route('user.profile')->with('success', 'Password updated successfully');
            } else {
                return redirect()->route('user.profile')->with('error', 'Current password is incorrect');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
