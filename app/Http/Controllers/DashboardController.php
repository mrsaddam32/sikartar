<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Activity;
use App\Models\Fund;
use App\Models\Outcome;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DateTime;
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

        $activityStatus = [
            'pendingActivity' => Activity::where('activity_status', 'PENDING')->count(),
            'onProgressActivity' => Activity::where('activity_status', 'APPROVED')->count(),
            'completedActivity' => Activity::where('activity_status', 'COMPLETED')->count(),
        ];

        if ($activity) {
            $startDate = Carbon::parse($activity->activity_start_date);
            $remainingDays = $startDate->diffInDays($now);
        }

        $activities = Activity::all()->count();

        $totalIncome = Fund::all()->sum('jumlah_nominal');

        $monthlyIncome = Fund::selectRaw('SUM(jumlah_nominal) as total_income, MONTH(tanggal_pemasukkan) as month')
            ->whereYear('tanggal_pemasukkan', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        $incomeData = $monthlyIncome->pluck('total_income');
        $monthLabels = $monthlyIncome->pluck('month')->map(function ($month) {
            return DateTime::createFromFormat('!m', $month)->format('F');
        });

        $totalOutcome = Outcome::all()->sum('nominal_pengeluaran');

        $data = [
            'labels' => $monthLabels,
            'datasets' => [
                [
                    'label' => 'Monthly Income',
                    'data' => $incomeData,
                    'borderWidth' => 3,
                    'borderColor' => '#4e73df',
                    'pointBackgroundColor' => '#4e73df',
                    'pointBorderColor' => '#ffffff',
                    'pointHoverBackgroundColor' => '#ffffff',
                    'pointHoverBorderColor' => '#4e73df',
                ]
            ]
        ];

        if (Auth::check() && Auth::user()->role_id == 1) {
            return view('admin.dashboard.index', [
                'title' => 'Dashboard Admin',
                'active' => 'dashboard',
                'users' => $users,
                'user' => $user,
                'activity' => $activity,
                'remainingDays' => $remainingDays,
                'activities' => $activities,
                'activityStatus' => $activityStatus,
                'totalIncome' => $totalIncome,
                'totalOutcome' => $totalOutcome,
                'data' => $data,
            ]);
        } else {
            return view('user.dashboard.index', [
                'title' => 'Dashboard User',
                'active' => 'dashboard',
                'user' => $user,
                'activity' => $activity,
                'remainingDays' => $remainingDays,
                'activities' => $activities,
                'activityStatus' => $activityStatus,
                'totalIncome' => $totalIncome,
                'totalOutcome' => $totalOutcome,
                'data' => $data,
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
        $user = User::findOrFail($id);

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
            $userName = $user->name;

            if (strpos($userName, ' ') !== false) {
                $userName = strtolower(str_replace(' ', '_', $userName));
            } else {
                $userName = strtolower($userName);
            }

            $userImage = $request->file('image');
            $imagePath = $userImage->hashName();

            $userImage->storeAs('public/images/' . $userName . '/', $imagePath);
            $user->photo_path = 'storage/images/' . $userName . '/' . $imagePath;
            $user->photo_name = $userImage->getClientOriginalName();
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
