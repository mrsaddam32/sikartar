<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

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
            return view('admin.events.index', [
                'title' => 'Events Management',
                'active' => 'admin/activities',
            ], compact('activities'));
        } else {
            return view('user.events.index', [
                'title' => 'Events Management',
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
            return view('admin.events.create', [
                'title' => 'Add New Event',
                'active' => 'admin/activities',

            ], compact('users'));
        } else {
            return view('user.events.create', [
                'title' => 'Add New Event',
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

        return redirect()->route('admin.event.index')->with('success', 'Activity has been added successfully!');
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
            return view('admin.events.show', [
                'title' => 'Event Detail',
                'active' => 'admin/activities',
            ], compact('activity'));
        } else {
            return view('user.events.show', [
                'title' => 'Event Detail',
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
            return view('admin.events.edit', [
                'title' => 'Edit Event',
                'active' => 'admin/activities',
            ], compact('activity', 'users'));
        } else {
            return view('user.events.edit', [
                'title' => 'Edit Event',
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

        return redirect()->route('admin.event.index')->with('success', 'Activity has been updated successfully!');
    }

    /**
     * Upload files to storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadFiles(Request $request)
    {
        $activity_id = $request->input('activity_id');
        $activity = Activity::where('activity_id', $activity_id)->first();

        if (!$activity) {
            return redirect()->route('admin.event.index')->with('error', 'Activity not found!');
        }

        if ($request->hasFile('files')) {
            $files = $request->file('files');

            foreach ($files as $file) {
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();

                // Mengganti nama file dengan format "namafile_ekstensi"
                $filename = pathinfo($filename, PATHINFO_FILENAME) . '_' . time() . '.' . $extension;

                // Menyimpan file ke folder yang sesuai
                $file->storeAs('public/events/' . $activity->activity_name, $filename);

                // Update kolom document_name pada table activity dengan nama file
                if ($activity->document_name == null) {
                    $activity->update([
                        'document_name' => $filename,
                    ]);
                } else {
                    $activity->update([
                        'document_name' => $activity->document_name . ',' . $filename,
                    ]);
                }
            }
        }

        return redirect()->route('admin.event.index')->with('success', 'Files have been uploaded successfully!');
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

        return redirect()->route('admin.event.index')->with('success', 'Activity has been deleted successfully!');
    }
}
