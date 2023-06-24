<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\User;
use App\Models\Fund;
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
            ], compact('activities'));
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
        $user = Auth::user();

        if (Auth::check() && Auth::user()->role_id == 1) {
            return view('admin.events.create', [
                'title' => 'Add New Event',
                'active' => 'admin/activities',

            ], compact('users'));
        } else {
            return view('user.events.create', [
                'title' => 'Add New Event',
                'active' => 'user/activities',
                'user' => $user,
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
        // // Get the last nominal amount before adding new event
        // $nominalAmountBefore = Fund::sum('jumlah_nominal');

        // // Do the process of deducting the nominal amount from the inputted budget 'activity_budget'
        // $activityBudget = $request->activity_budget;

        Activity::create([
            'activity_name' => $request->activity_name,
            'responsible_person' => $request->responsible_person,
            'activity_description' => $request->activity_description,
            'activity_budget' => $request->activity_budget,
            'activity_status' => $request->activity_status,
            'activity_location' => $request->activity_location,
            'activity_start_date' => date('Y-m-d', strtotime($request->activity_start_date) + 86400),
            'activity_end_date' => date('Y-m-d', strtotime($request->activity_end_date) + 86400),
        ]);

        if (Auth::check() && Auth::user()->role_id == 1) {
            return redirect()->route('admin.event.index')->with('success', 'Event has been added successfully!');
        } else {
            return redirect()->route('user.event.index')->with('success', 'Event has been added successfully!');
        }
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
        if (Auth::check() && Auth::user()->role_id == 1) {
            $users = User::where('role_id', '!=', 1)->where('id', '!=', Auth::user()->id)->get();
            $activity = Activity::where('activity_id', $request->input('activities_id'))->first();

            return view('admin.events.edit', [
                'title' => 'Edit Event',
                'active' => 'admin/activities',
            ], compact('activity', 'users'));
        } else {
            $users = User::where('role_id', '!=', 1)->get();
            $activity = Activity::where('activity_id', $request->input('activities_id'))->first();

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

        if (Auth::check() && Auth::user()->role_id == 1) {
            return redirect()->route('admin.event.index')->with('success', 'Event has been updated successfully!');
        } else {
            return redirect()->route('user.event.index')->with('success', 'Event has been updated successfully!');
        }
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

            // Check the uploaded files
            $currentFileCount = $activity->document_name ? count(explode(',', $activity->document_name)) : 0;
            $allowedFileCount = 5;
            $allowedMimeTypes = ['application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/pdf', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.openxmlformats-officedocument.presentationml.presentation'];

            if (Auth::check() && Auth::user()->role_id != 1) {
                // Non-admin user, perform additional checks
                if (count($files) + $currentFileCount > $allowedFileCount) {
                    return redirect()->route('user.event.show', ['activities_id' => $activity_id])->with('error', 'Maximum 5 files can be uploaded!');
                }

                foreach ($files as $file) {
                    $filename = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();

                    // Check file type
                    if (!in_array($file->getMimeType(), $allowedMimeTypes)) {
                        return redirect()->route('user.event.show', ['activities_id' => $activity_id])->with('error', 'Only .docx, .pdf, .xlsx, .pptx files are allowed!');
                    }

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

                return redirect()->route('user.event.show', ['activities_id' => $activity_id])->with('success', 'Files have been uploaded successfully!');
            }

            // Admin user, perform checks without redirection
            if (count($files) + $currentFileCount > $allowedFileCount) {
                return redirect()->route('admin.event.show', ['activities_id' => $activity_id])->with('error', 'Maximum 5 files can be uploaded!');
            }

            foreach ($files as $file) {
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();

                // Check file type
                if (!in_array($file->getMimeType(), $allowedMimeTypes)) {
                    return redirect()->route('admin.event.show', ['activities_id' => $activity_id])->with('error', 'Only .docx, .pdf, .xlsx, .pptx files are allowed!');
                }

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

            return redirect()->route('admin.event.show', ['activities_id' => $activity_id])->with('success', 'Files have been uploaded successfully!');
        }

        // No files uploaded
        return redirect()->route('admin.event.show', ['activities_id' => $activity_id])->with('error', 'No files uploaded!');
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

        // Jika activity memiliki document_name maka hapus file yang ada di storage
        if ($activity->document_name != null) {
            $files = explode(',', $activity->document_name);

            foreach ($files as $file) {
                Storage::delete('public/events/' . $activity->activity_name . '/' . $file);
            }

            Storage::deleteDirectory('public/events/' . $activity->activity_name);
        }

        $activity->delete();

        return redirect()->route('admin.event.index')->with('success', 'Event has been deleted successfully!');
    }
}
