<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use App\Models\Outcome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $funds = Fund::orderBy('tanggal_pemasukkan', 'desc')->paginate(10);
        $totalPemasukkan = Fund::sum('jumlah_nominal');
        $latestAmount = Fund::where('id', Fund::max('id'))->first();

        $sisaPemasukkan = 0;

        if ($latestAmount) {
            $totalOutcome = Outcome::sum('nominal_pengeluaran');

            if ($totalOutcome === null) {
                $totalOutcome = 0;
            }

            $sisaPemasukkan = $totalPemasukkan - $totalOutcome;

            if ($sisaPemasukkan === 0) {
                $sisaPemasukkan = $latestAmount->total_pemasukkan;
            }
        }

        if (Auth::check() && Auth::user()->role_id == 1) {
            return view('admin.funds.index', [
                'title' => 'Keuangan',
                'active' => 'admin/keuangan',
            ], compact('funds', 'sisaPemasukkan', 'totalPemasukkan'));
        } else {
            return view('user.funds.index', [
                'title' => 'Keuangan',
                'active' => 'user/keuangan',
            ], compact('funds', 'sisaPemasukkan', 'totalPemasukkan'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check() && Auth::user()->role_id == 1) {
            return view('admin.funds.create', [
                'title' => 'Input Pemasukkan Baru',
                'active' => 'admin/keuangan',
            ]);
        } else {
            return view('user.funds.create', [
                'title' => 'Input Pemasukkan Baru',
                'active' => 'user/keuangan',
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
        $totalPemasukkan = Fund::sum('jumlah_nominal');

        if ($totalPemasukkan === null) {
            $totalPemasukkan = 0;
        }

        $sisaPemasukkan = $totalPemasukkan - Outcome::sum('nominal_pengeluaran');

        if ($sisaPemasukkan == 0) {
            $sisaPemasukkan = $totalPemasukkan;
        }

        $fund = Fund::create([
            'sumber_dana' => $request->sumber_dana,
            'jumlah_nominal' => $request->jumlah_nominal,
            'tanggal_pemasukkan' => date('Y-m-d', strtotime($request->tanggal_pemasukkan)),
            'total_pemasukkan' => $sisaPemasukkan + $request->jumlah_nominal,
        ]);

        if (Auth::check() && Auth::user()->role_id == 1) {
            return redirect()->route('admin.keuangan.index')->with('success', 'New Data Has Been Added!');
        } else {
            return redirect()->route('user.keuangan.index')->with('success', 'New Data Has Been Added!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function show(Fund $fund)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function edit(Fund $fund)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fund $fund)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fund $fund)
    {
        //
    }
}
