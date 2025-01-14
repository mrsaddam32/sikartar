<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Activity;

use PDF;

class ReportController extends Controller
{
    /**
     * Display a event report index page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function event_report()
    {
        if (Auth::check() && Auth::user()->role_id == 1) {
            return view('admin.reports.event.index', [
                'title' => 'Event Report',
                'active' => 'admin/report/event_report',
            ]);
        }
    }

    /**
     * Display a preview of event report.
     * 
     */
    public function preview_pdf(Request $request)
    {
        $user = Auth::user();

        $fromDate = $request->from_date;
        $toDate = $request->to_date;

        if (empty($fromDate) && empty($toDate)) {
            return redirect()->back()->with('error', 'Please select a date range!');
        }

        $reportID = $this->generateReportID();

        $activities = Activity::whereMonth('activity_start_date', '>=', $fromDate)
            ->whereMonth('activity_start_date', '<=', $toDate)
            ->get();

        if ($activities->isEmpty()) {
            return redirect()->back()->with('error', 'There is no data between ' . $fromDate . ' and ' . $toDate . '!');
        } else {
            return view('admin.reports.event.event_report_print', [
                'title' => 'Event Report',
                'active' => 'admin/report/event_report',
                'activities' => $activities,
                'user' => $user,
                'fromDate' => $fromDate,
                'toDate' => $toDate,
                'reportID' => $reportID,
            ]);
        }
    }

    /**
     * Display a print of event report.
     * 
     */
    public function print_event_report(Request $request)
    {
        $user = Auth::user();

        $fromDate = $request->from_date;
        $toDate = $request->to_date;

        if (empty($fromDate) && empty($toDate)) {
            return redirect()->back()->with('error', 'Please select a date range!');
        }

        $reportID = $this->generateReportID();

        $activities = Activity::whereMonth('activity_start_date', '>=', $fromDate)
            ->whereMonth('activity_start_date', '<=', $toDate)
            ->get();

        if ($activities->isEmpty()) {
            return redirect()->back()->with('error', 'There is no data between ' . $fromDate . ' and ' . $toDate . '!');
        } else {
            $pdf = PDF::loadView('admin.reports.event.event_report_print', [
                'title' => 'Event Report',
                'active' => 'admin/report/event_report',
                'activities' => $activities,
                'user' => $user,
                'fromDate' => $fromDate,
                'toDate' => $toDate,
                'reportID' => $reportID,
            ]);

            return $pdf->download('LAPORAN EVENT ' . $fromDate . ' - ' . $toDate . ' (#' . $reportID . ').pdf');
        }
    }

    private function generateReportID()
    {
        $reportID = 'RPT' . mt_rand(10000000, 99999999);
        return $reportID;
    }
}
