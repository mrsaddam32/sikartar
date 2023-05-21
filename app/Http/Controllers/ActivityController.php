<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = Activity::all();

        if (Auth::check() && Auth::user()->role_id == 1) {
            return view('admin.activities.index', [
                'title' => 'Activities Management',
                'active' => 'admin/activities',
            ], compact('activities'));
        } else {
            return view('user.activities.index', [
                'title' => 'Activities Management',
                'active' => 'user/activities',
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
        $users = User::where('role_id', '!=', 1)->where('id', '!=', Auth::user()->id)->get();

        if (Auth::check() && Auth::user()->role_id == 1) {
            return view('admin.activities.create', [
                'title' => 'Add New Activity',
                'active' => 'admin/activities',

            ], compact('users'));
        } else {
            return view('user.activities.create', [
                'title' => 'Add New Activity',
                'active' => 'user/activities',
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Activity::create([
            'activity_id' => $request->activity_id,
            'activity_name' => $request->activity_name,
            'responsible_person' => $request->responsible_person,
            'activity_description' => $request->activity_description,
            'activity_budget' => $request->activity_budget,
            'activity_status' => $request->activity_status,
            'activity_location' => $request->activity_location,
            'activity_start_date' => date('Y-m-d', strtotime($request->activity_start_date) + 86400),
            'activity_end_date' => date('Y-m-d', strtotime($request->activity_end_date) + 86400),
        ]);

        return redirect()->route('admin.activity.index')->with('success', 'Activity has been added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Activity $activity)
    {
        $activity = Activity::where('activity_id', $request->input('activities_id'))->first();

        if (Auth::check() && Auth::user()->role_id == 1) {
            return view('admin.activities.show', [
                'title' => 'Activity Detail',
                'active' => 'admin/activities',
            ], compact('activity'));
        } else {
            return view('user.activities.show', [
                'title' => 'Activity Detail',
                'active' => 'user/activities',
            ], compact('activity'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Activity $activity)
    {
        $users = User::where('role_id', '!=', 1)->where('id', '!=', Auth::user()->id)->get();
        $activity = Activity::where('activity_id', $request->input('activities_id'))->first();

        if (Auth::check() && Auth::user()->role_id == 1) {
            return view('admin.activities.edit', [
                'title' => 'Edit Activity',
                'active' => 'admin/activities',
            ], compact('activity', 'users'));
        } else {
            return view('user.activities.edit', [
                'title' => 'Edit Activity',
                'active' => 'user/activities',
            ], compact('activity', 'users'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $activities_id)
    {
        $activity = Activity::where('activity_id', $activities_id)->first();
        $activity->update([
            'activity_name' => $request->activity_name,
            'responsible_person' => $request->responsible_person,
            'activity_description' => $request->activity_description,
            'activity_budget' => $request->activity_budget,
            'activity_status' => $request->activity_status,
            'activity_location' => $request->activity_location,
            'activity_start_date' => date('Y-m-d', strtotime($request->activity_start_date) + 86400),
            'activity_end_date' => date('Y-m-d', strtotime($request->activity_end_date) + 86400),
        ]);

        return redirect()->route('admin.activity.index')->with('success', 'Activity has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy($activity_id)
    {
        $activity = Activity::where('activity_id', $activity_id)->first();
        $activity->delete();

        return redirect()->route('admin.activity.index')->with('success', 'Activity has been deleted successfully!');
    }
}
